<?php

namespace PhpGeoMath\Test\Model\Polar3dPoint;

use PhpGeoMath\Exception\ArchitecturalException;
use PhpGeoMath\Model\Polar3dPoint;
use PHPUnit\Framework\TestCase;

/**
 * Test
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class BuildCartesian3dPointTest extends TestCase
{
    /**
     * Test data provider
     *
     * @return array
     * @throws ArchitecturalException
     */
    public function calcProjectionPointProvider()
    {
        return [
            'Case 1' => [
                new Polar3dPoint(54.735610317245, 45.0, 1732.0508075689), 1000, 1000, 1000
            ],
            'Case 2' => [
                new Polar3dPoint(54.735610317245, 45.0, 173.20508075689), 100, 100, 100
            ]
        ];
    }

    /**
     * Test
     *
     * @param Polar3dPoint $pointPolar3D
     * @param float $expectedX
     * @param float $expectedY
     * @param float $expectedZ
     * @return void
     *
     * @dataProvider calcProjectionPointProvider
     * @throws ArchitecturalException
     */
    public function testBuildCartesian3DPoint($pointPolar3D, $expectedX, $expectedY, $expectedZ)
    {
        $point3D = $pointPolar3D->buildCartesian3DPoint();

        static::assertInstanceOf('\\PhpGeoMath\\Model\\Cartesian3dPoint', $point3D);
        static::assertEquals($expectedX, $point3D->x);
        static::assertEquals($expectedY, $point3D->y);
        static::assertEquals($expectedZ, $point3D->z);
    }
}