<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Mapping\Naming;

use Dogma\Language\Inflector;

class ShortUnderscoreFieldNamingStrategy implements \Dogma\Mapping\Naming\NamingStrategy
{
    use \Dogma\StrictBehaviorMixin;

    public function translateName(string $localName, string $path, string $fieldSeparator): string
    {
        $parts = explode($fieldSeparator, $localName);

        return Inflector::underscore(end($parts));
    }

}
