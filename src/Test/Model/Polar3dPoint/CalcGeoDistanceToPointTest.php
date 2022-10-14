<?php

namespace PhpGeoMath\Test\Model\Polar3dPoint;

use PhpGeoMath\Exception\ArchitecturalException;
use PhpGeoMath\Model\Polar3dPoint;
use PHPUnit\Framework\TestCase;

/**
 * Test
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class CalcGeoDistanceToPointTest extends TestCase
{
    /**
     * Test data provider
     *
     * @return array
     * @throws ArchitecturalException
     */
    public function calcArcDistanceProvider()
    {
        return [
            'Case 1' => [
                new Polar3dPoint(40.690365191868416, -73.98642030241204, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                new Polar3dPoint(40.69132179906122, -73.84441510683281, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                11973.252830472
            ],
            'Case 2' => [
                new Polar3dPoint(40.69292963642356, -73.97341785342944, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                new Polar3dPoint(40.69219982877872, -73.96933182203897, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                353.92286549717
            ]
        ];
    }

    /**
     * Test
     *
     * @param Polar3dPoint $pointPolar3D1
     * @param Polar3dPoint $pointPolar3D2
     * @param float $expectedArcDistance
     *
     * @return void
     *
     * @dataProvider calcArcDistanceProvider
     */
    public function testCalcGeoDistanceToPoint($pointPolar3D1, $pointPolar3D2, $expectedArcDistance)
    {
        $arcDistance = $pointPolar3D1->calcGeoDistanceToPoint($pointPolar3D2);

        static::assertEquals($expectedArcDistance, $arcDistance);
    }
}