<?php

namespace PhpGeoMath\Model;

use PhpGeoMath\Exception\ArchitecturalException;

/**
 * Segment on the surface of the sphere (in polar coordinates)
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class GeoSegment
{
    /** @var Polar3dPoint */
    public $firstPoint;

    /** @var Polar3dPoint */
    public $secondPoint;

    /**
     * @param Polar3dPoint $firstPoint
     * @param Polar3dPoint $secondPoint
     * @throws ArchitecturalException
     */
    public function __construct($firstPoint, $secondPoint)
    {
        if (!$firstPoint instanceof Polar3dPoint) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not \'%s\' type', [
                'firstPoint',
                'PhpGeoMath\Model\Polar3dPoint'
            ]));
        }

        if (!$secondPoint instanceof Polar3dPoint) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not \'%s\' type', [
                'secondPoint',
                'PhpGeoMath\Model\Polar3dPoint'
            ]));
        }

        $this->firstPoint = $firstPoint;
        $this->secondPoint = $secondPoint;
    }

    /**
     * Calculates the nearest point from this GEO segment (according to the shortest arc distance)
     *
     * @param Polar3dPoint $targetPolarPoint
     * @return Polar3dPoint
     * @throws ArchitecturalException
     */
    public function calcNearestPoint($targetPolarPoint)
    {
        if (!$targetPolarPoint instanceof Polar3dPoint) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not \'%s\' type', [
                'centerPolarPoint',
                'PhpGeoMath\Model\Polar3dPoint'
            ]));
        }

        $plane = new Cartesian3dPlainViaTwoPointsAndZero(
            $this->firstPoint->buildCartesian3DPoint(),
            $this->secondPoint->buildCartesian3DPoint()
        );

        $projectionPoint = $plane->calcPointProjection($targetPolarPoint->buildCartesian3DPoint());
        $nearestPolarPoint = $projectionPoint->buildPolar3dPoint();
        $nearestPolarPoint->radius = $targetPolarPoint->radius;

        $segmentLength = $this->firstPoint->calcGeoDistanceToPoint($this->secondPoint);

        if ($nearestPolarPoint->calcGeoDistanceToPoint($this->firstPoint) < $segmentLength
            && $nearestPolarPoint->calcGeoDistanceToPoint($this->secondPoint) < $segmentLength) {
            // Nearest point is located between first and second points
            return $nearestPolarPoint;
        }

        return
            $targetPolarPoint->calcGeoDistanceToPoint($this->firstPoint)
            < $targetPolarPoint->calcGeoDistanceToPoint($this->secondPoint)
                ? $this->firstPoint
                : $this->secondPoint
            ;
    }
}