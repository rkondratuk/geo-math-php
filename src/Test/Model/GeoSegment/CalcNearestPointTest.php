<?php

namespace PhpGeoMath\Test\Model\GeoSegment;

use PhpGeoMath\Exception\ArchitecturalException;
use PhpGeoMath\Model\GeoSegment;
use PhpGeoMath\Model\Polar3dPoint;
use PHPUnit\Framework\TestCase;

/**
 * Test
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class CalcNearestPointTest extends TestCase
{
    /**
     * Test data provider
     *
     * @return array
     * @throws ArchitecturalException
     */
    public function calcNearestPointByArcToProvider()
    {
        return [
            'Case 1' => [
                new GeoSegment(
                    new Polar3dPoint(40.69292984650043, -73.97341873746349, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                    new Polar3dPoint(40.69219928229865, -73.96933336000964, Polar3dPoint::EARTH_RADIUS_IN_METERS)
                ),
                new Polar3dPoint(40.69199645823418, -73.97277004758033, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                40.692756642041,
                -73.972450247133
            ],
            'Case 2' => [
                new GeoSegment(
                    new Polar3dPoint(40.69292984650043, -73.97341873746349, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                    new Polar3dPoint(40.69219928229865, -73.96933336000964, Polar3dPoint::EARTH_RADIUS_IN_METERS)
                ),
                new Polar3dPoint(40.69364019271634, -73.97045703625909, Polar3dPoint::EARTH_RADIUS_IN_METERS),
                40.692486950691,
                -73.970942136858
            ]
        ];
    }

    /**
     * Test
     *
     * @param GeoSegment $arcSegment
     * @param Polar3dPoint $pointPolarTo
     * @return void
     *
     * @throws ArchitecturalException
     * @dataProvider calcNearestPointByArcToProvider
     */
    public function testCalcNearestPoint($arcSegment, $pointPolarTo, $expectedLat, $expectedLng)
    {
        $nearestPointPolar = $arcSegment->calcNearestPoint($pointPolarTo);

        static::assertInstanceOf('\\PhpGeoMath\\Model\\Polar3dPoint', $nearestPointPolar);
        static::assertEquals($expectedLat, $nearestPointPolar->lat);
        static::assertEquals($expectedLng, $nearestPointPolar->lng);
    }
}