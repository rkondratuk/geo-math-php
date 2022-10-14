<?php

namespace PhpGeoMath\Model;

use PhpGeoMath\Exception\ArchitecturalException;

/**
 * Point in cartesian system
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class Cartesian3dPoint
{
    /** @var float */
    public $x;

    /** @var float */
    public $y;

    /** @var float */
    public $z;

    /**
     * @param float $x
     * @param float $y
     * @param float $z
     * @throws ArchitecturalException
     */
    public function __construct($x, $y, $z)
    {
        if (! is_numeric($x)) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not numeric', ['x']));
        }

        if (! is_numeric($y)) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not numeric', ['y']));
        }

        if (! is_numeric($z)) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not numeric', ['z']));
        }

        $this->x = (float)$x;
        $this->y = (float)$y;
        $this->z = (float)$z;
    }

    /**
     * Builds polar point from cartesian point
     *
     * @return Polar3dPoint
     * @throws ArchitecturalException
     */
    public function buildPolar3dPoint()
    {
        $radius = (float) (sqrt(pow($this->x, 2) + pow($this->y, 2) + pow($this->z, 2)));

        if ($radius === 0.0) {
            return new Polar3dPoint(0, 0, 0);
        }

        $lng = $this->x === 0.0 && $this->y === 0.0
            ? 0.0
            : rad2deg(asin($this->y / sqrt(pow($this->x, 2) + pow($this->y, 2))));

        $lat = rad2deg(acos($this->z / $radius));

        return new Polar3dPoint($lat, $lng, $radius);
    }
}