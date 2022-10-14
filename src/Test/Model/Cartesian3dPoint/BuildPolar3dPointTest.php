<?php

namespace PhpGeoMath\Test\Model\Cartesian3dPoint;

use PhpGeoMath\Exception\ArchitecturalException;
use PhpGeoMath\Model\Cartesian3dPoint;
use PHPUnit\Framework\TestCase;

/**
 * Test
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class BuildPolar3dPointTest extends TestCase
{
    /**
     * Test data provider
     *
     * @return array
     * @throws ArchitecturalException
     */
    public function getPointPolar3DProvider()
    {
        return [
            'Case 1' => [
                new Cartesian3dPoint(1000, 1000, 1000), 54.735610317245, 45.0, 1732.0508075689
            ],
            'Case 2' => [
                new Cartesian3dPoint(100, 100, 100), 54.735610317245, 45.0, 173.20508075689
            ]
        ];
    }

    /**
     * Test
     *
     * @param Cartesian3dPoint $point3D
     * @param float $expectedLat
     * @param float $expectedLng
     * @param float $expectedRadius
     * @return void
     *
     * @throws ArchitecturalException
     * @dataProvider getPointPolar3DProvider
     */
    public function testBuildPolar3dPoint($point3D, $expectedLat, $expectedLng, $expectedRadius)
    {
        $pointPolar3D = $point3D->buildPolar3dPoint();

        static::assertInstanceOf('\\PhpGeoMath\\Model\\Polar3dPoint', $pointPolar3D);
        static::assertEquals($expectedLat, $pointPolar3D->lat);
        static::assertEquals($expectedLng, $pointPolar3D->lng);
        static::assertEquals($expectedRadius, $pointPolar3D->radius);
    }
}