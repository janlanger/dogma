<?php

namespace Dogma\Xml;


class Element extends \Dogma\Object {
    
    /** @var QueryEngine */
    private $engine;
    
    /** @var \DOMElement */
    private $element;
    
    
    public function __construct(\DOMElement $element, QueryEngine $engine) {
        $this->element = $element;
        $this->engine = $engine;
    }
    
    
    /**
     * @param string
     * @return \DOMNode
     */
    public function find($xpath) {
        return $this->engine->find($xpath, $this->element);
    }


    /**
     * @param string
     * @return \DOMNode
     */
    public function findOne($xpath) {
        return $this->engine->findOne($xpath, $this->element);
    }


    /**
     * @param string
     * @return string|int|float
     */
    public function evaluate($xpath) {
        return $this->engine->evaluate($xpath, $this->element);
    }


    /**
     * @param string|string[]
     * @return string|string[]
     */
    public function extract($target) {
        return $this->engine->extract($target, $this->element);
    }
    
    
    /**
     * @return \DOMElement
     */
    public function getElement() {
        return $this->element;
    }
    
    
    /**
     * @return bool
     */
    public function remove() {
        $this->element->parentNode->removeChild($this->element);
        return TRUE;
    }
    
    
    public function &__get($name) {
        $val = $this->element->$name;
        return $val;
    }
    
    
    public function __call($name, $arg) {
        $args = func_get_args();
        return call_user_func(array($this->element, $name), array_shift($args));
    }
    
}