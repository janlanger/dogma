<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Math\Decimal;

use Dogma\StrictBehaviorMixin;

class Fraction
{
    use StrictBehaviorMixin;

    /** @var \Dogma\Math\Decimal\Decimal */
    private $numerator;

    /** @var \Dogma\Math\Decimal\Decimal */
    private $denominator;

    public function __construct(Decimal $numerator, Decimal $denominator)
    {
        if (!$numerator->isInteger()) {
            throw new DecimalArithmeticException('Numerator must be an integer', $numerator);
        }
        if (!$denominator->isInteger()) {
            throw new DecimalArithmeticException('Denominator must be an integer', $denominator);
        }
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }

    public function __toString(): string
    {
        return sprintf('Fraction: %d/%d', $this->numerator->getValue(), $this->denominator->getValue());
    }

    public function getNumerator(): Decimal
    {
        return $this->numerator;
    }

    public function getDenominator(): Decimal
    {
        return $this->denominator;
    }

}
