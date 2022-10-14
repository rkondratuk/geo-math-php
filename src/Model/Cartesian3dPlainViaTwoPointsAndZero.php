<?php

namespace PhpGeoMath\Model;

use PhpGeoMath\Exception\ArchitecturalException;

/**
 * 3D Plane, based on two points and coordinate origin (0, 0, 0)
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class Cartesian3dPlainViaTwoPointsAndZero
{
    /** @var Cartesian3dPoint */
    public $firstPoint;

    /** @var Cartesian3dPoint */
    public $secondPoint;

    /**
     * @param Cartesian3dPoint $firstPoint
     * @param Cartesian3dPoint $secondPoint
     * @throws ArchitecturalException
     */
    public function __construct($firstPoint, $secondPoint)
    {
        if (!$firstPoint instanceof Cartesian3dPoint) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not \'%s\' type', [
                'firstPoint',
                'PhpGeoMath\Model\Cartesian3dPoint'
            ]));
        }

        if (!$secondPoint instanceof Cartesian3dPoint) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not \'%s\' type', [
                'secondPoint',
                'PhpGeoMath\Model\Cartesian3dPoint'
            ]));
        }

        $this->firstPoint = $firstPoint;
        $this->secondPoint = $secondPoint;
    }

    /**
     * @param Cartesian3dPoint $point
     * @return Cartesian3dPoint
     * @throws ArchitecturalException
     */
    public function calcPointProjection($point)
    {
        if (!$point instanceof Cartesian3dPoint) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not \'%s\' type', [
                'point',
                'PhpGeoMath\Model\Cartesian3dPoint'
            ]));
        }

        $a = $this->firstPoint->y * $this->secondPoint->z - $this->firstPoint->z * $this->secondPoint->y;
        $b = -1 * ($this->firstPoint->x * $this->secondPoint->z - $this->firstPoint->z * $this->secondPoint->x);
        $c = $this->firstPoint->x * $this->secondPoint->y - $this->firstPoint->y * $this->secondPoint->x;
        $t = (float) (pow($a, 2) + pow($b, 2) + pow($c, 2));

        if ($t === 0.0) {
            return new Cartesian3dPoint(0, 0, 0);
        }

        $t = ($a * $point->x + $b * $point->y + $c * $point->z) / $t;

        return new Cartesian3dPoint(
            $point->x - $a * $t,
            $point->y - $b * $t,
            $point->z - $c * $t
        );
    }
}