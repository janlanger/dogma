<?php


namespace Dogma\Model;

use Nette\Reflection\ClassType;
use Nette\Database\Table\ActiveRow;
use Dogma\Language\Inflector;


class EntityFactory extends \Dogma\Object
{

    /** @var array ($entityClass => ($propertyName => ($propertyClass, ($paramName => $paramType)))) */
    private $meta = [];

    /** @var \Nette\Reflection\ClassType[] */
    private $reflections;

    /** @var \Nette\DI\Container */
    //private $context;


    //public function __construct(\Nette\DI\Container $context)
    //{
    //    $this->context = $context;
    //}


    /**
     * @param \Nette\Database\Table\ActiveRow
     * @param string
     * @return \Dogma\Model\ActiveEntity
     */
    //public function createEntity(ActiveRow $row, $class)
    //{
    //    return $this->context->createInstance($class, [$row]);
    //}


    /**
     * @return string[]
     */
    public function getMagicProperties($class)
    {
        if (array_key_exists($class, $this->meta)) {
            return array_keys($this->meta[$class]);
        }

        $ns = preg_replace('/[^\\\\]+$/', '', $class);
        $ref = self::getReflection($class);

        $props = [];
        foreach ($ref->getProperties() as $property) {
            if ($property->isPublic()
                && ($meta = $property->getAnnotation('instance'))
                && ($type = $property->getAnnotation('var'))
            ) {
                $type = $this->getClassName($ns, $type);

                if ($meta === true) {
                    $props[$property->getName()] = [$type, [$property->getName() => null]];

                } else {
                    $params = [];
                    foreach ($meta as $param) {
                        @list($a, $b) = explode(' ', $param);
                        $paramName = $b ?: $a;
                        $paramType = $b ? $a : null;
                        $params[str_replace('$', '', $paramName)] = $paramType;
                    }

                    $props[$property->getName()] = [$type, $params];
                }
            }
        }
        $this->meta[$class] = $props;

        return array_keys($props);
    }


    /**
     * @param string
     * @param string
     * @return boolean
     */
    public function hasMagicProperty($class, $property)
    {
        return isset($this->meta[$class][$property]);
    }


    /**
     * @param string
     * @param string
     * @param \Nette\Database\Table\ActiveRow|array
     * @return object
     */
    public function createPropertyInstance($class, $property, $row)
    {
        list($type, $params) = $this->meta[$class][$property];

        $args = [];
        foreach ($params as $paramName => $paramType) {
            $args[] = ($paramType === null)
                ? $row[Inflector::underscore($paramName)]
                : $this->createInstance($paramType, [$row[Inflector::underscore($paramName)]]);
        }

        $instance = $this->createInstance($type, $args);

        return $instance;
    }


    /**
     * @param string
     * @param string
     * @param mixed
     * @param \Nette\Database\Table\ActiveRow|array
     * @return object
     */
    public function updatePropertyInstance($class, $property, $value, $row)
    {
        list($type, $params) = $this->meta[$class][$property];

        if ($value instanceof $type) {
            $instance = $value;

            if ($value instanceof \Dogma\CompoundValueObject) {
                $parts = array_combine(array_keys($params), array_values($value->toArray()));
                if (!$parts) {
                    throw new \LogicException('Count of fields returned by CompoundValueObject does not fit the count of fields in constructor.');
                }

                foreach ($parts as $key => $val) {
                    $row[$key] = $val;
                }
            } else {
                $row[$property] = $value;
            }

        } else {
            $instance = $this->createInstance($type, [$value]);
            $row[$property] = $instance;
        }

        return $instance;
    }


    /**
     * @param object|string
     * @return \Nette\Reflection\ClassType
     */
    public function getReflection($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        if (!isset($this->reflections[$class])) {
            $this->reflections[$class] = new ClassType($class);
        }

        return $this->reflections[$class];
    }


    /**
     * @param string
     * @param string
     * @return string
     */
    public static function getClassName($namespace, $type)
    {
        @list($type) = preg_split('/[\\s|]/', $type);
        if ($type[0] === '\\') {
            return $type;
        }

        return $namespace . $type;
    }


    /**
     * @param string
     * @param mixed[]
     * @return object
     */
    public function createInstance($class, $args)
    {
        $ref = $this->getReflection($class);

        if ($ref->implementsInterface('Dogma\\IndirectInstantiable')) {
            return call_user_func_array([$class, 'getInstance'], $args);

        } else {
            return $ref->newInstanceArgs($args);
        }
    }

}
