<?php

namespace PhpGeoMath\Model;

use PhpGeoMath\Exception\ArchitecturalException;

/**
 * Point in polar system
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class Polar3dPoint
{
    const EARTH_RADIUS_IN_METERS = 6371000;
    const EARTH_RADIUS_IN_MILES = 3958.8;

    /** @var float */
    public $lat;

    /** @var float */
    public $lng;

    /** @var float */
    public $radius;

    /**
     * @param float $lat
     * @param float $lng
     * @param float $radius
     * @throws ArchitecturalException
     */
    public function __construct($lat, $lng, $radius)
    {
        if (! is_numeric($lat)) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not numeric', ['lat']));
        }

        if (! is_numeric($lng)) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not numeric', ['lng']));
        }

        if (! is_numeric($radius)) {
            throw new ArchitecturalException(vsprintf('Type of param \'%s\' is not numeric', ['radius']));
        }

        $this->lat = (float) $lat;
        $this->lng = (float) $lng;
        $this->radius = (float) $radius;
    }

    /**
     * Builds cartesian point from polar point
     *
     * @return Cartesian3dPoint
     * @throws ArchitecturalException
     */
    public function buildCartesian3DPoint()
    {
        return new Cartesian3dPoint(
            $this->radius * sin(deg2rad($this->lat)) * cos(deg2rad($this->lng)),
            $this->radius * sin(deg2rad($this->lat)) * sin(deg2rad($this->lng)),
            $this->radius * cos(deg2rad($this->lat))
        );
    }

    /**
     * Calculates GEO distance (by GEO arc) between two polar points
     *
     * @param Polar3dPoint $polarPoint
     * @return float
     */
    public function calcGeoDistanceToPoint($polarPoint)
    {
        $a = 0.5 - cos(deg2rad($polarPoint->lat - $this->lat)) / 2 + cos(deg2rad($this->lat))
            * cos(deg2rad($polarPoint->lat)) * (1-cos(deg2rad($polarPoint->lng - $this->lng))) / 2;

        return $this->radius * 2 * asin(sqrt($a));
    }
}