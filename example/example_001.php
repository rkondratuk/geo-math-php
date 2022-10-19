<?php

use PhpGeoMath\Model\GeoSegment;
use PhpGeoMath\Model\Cartesian3dPoint;
use PhpGeoMath\Model\Polar3dPoint;

/*
 * Create polar point (in polar coordinates)
 */

// Rockefeller center coordinates
$latitude = 40.758742779050706;
$longitude = -73.97855507715238;

$polarPoint1 = new Polar3dPoint(
    $latitude, $longitude, Polar3dPoint::EARTH_RADIUS_IN_METERS
);

// Empire State Building coordinates
$polarPoint2 = new Polar3dPoint(
    40.74843388072615, -73.98566565776102, Polar3dPoint::EARTH_RADIUS_IN_METERS
);

// The Morgan Library & Museum coordinates
$polarPoint3 = new Polar3dPoint(
    40.74919365249446, -73.98133456388013, Polar3dPoint::EARTH_RADIUS_IN_METERS
);

/*
 * Create cartesian point (in cartesian coordinates)
 */
$x = 1001;
$y = 205;
$z = 512;

$cartesianPoint1 = new Cartesian3dPoint($x, $y, $z);

/*
 * Convert coordinates in alternative coordinates system
 */

$convertedCartesianPoint1 = $polarPoint1->buildCartesian3DPoint();
$convertedPolarPoint1 = $cartesianPoint1->buildPolar3dPoint();

/*
 * Calc GEO distance (by GEO arc) between two points
 */
$geoDistance = $polarPoint2->calcGeoDistanceToPoint($polarPoint1);

/*
 * Calc the nearest point from GEO segment to some GEO point
 */

$arcSegmentFirst = new GeoSegment($polarPoint1, $polarPoint2);
$nearestPolarPoint = $arcSegmentFirst->calcNearestPoint($polarPoint3);
$nearest3dPoint = $nearestPolarPoint->buildCartesian3DPoint();

// Nearest distance from point-3 to segment (point-1, point-2)
$nearestGeoDistance = $nearestPolarPoint->calcGeoDistanceToPoint($polarPoint3);

// Use Earth radius in miles for calculations in miles
Polar3dPoint::EARTH_RADIUS_IN_MILES;