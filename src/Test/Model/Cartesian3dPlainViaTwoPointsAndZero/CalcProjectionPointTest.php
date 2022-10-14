<?php

namespace PhpGeoMath\Test\Model\Cartesian3dPlainViaTwoPointsAndZero;

use PhpGeoMath\Exception\ArchitecturalException;
use PhpGeoMath\Model\Cartesian3dPlainViaTwoPointsAndZero;
use PhpGeoMath\Model\Cartesian3dPoint;
use PHPUnit\Framework\TestCase;

/**
 * Test
 * @author R. Kondratiuk rkondratuk@gmail.com
 */
class CalcProjectionPointTest extends TestCase
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
            'Orthogonal projection point +z in zero' => [
                new Cartesian3dPoint(5, 5, 0), new Cartesian3dPoint(7, 7, 0), new Cartesian3dPoint(0, 0, 15), 0, 0, 0
            ],
            'Orthogonal projection point -z in zero' => [
                new Cartesian3dPoint(5, 5, 0), new Cartesian3dPoint(7, 7, 0), new Cartesian3dPoint(0, 0, -15), 0, 0, 0
            ],
            'Orthogonal projection point +x in zero' => [
                new Cartesian3dPoint(0, 5, 5), new Cartesian3dPoint(0, 7, 7), new Cartesian3dPoint(15, 0, 0), 0, 0, 0
            ],
            'Orthogonal projection point -x in zero' => [
                new Cartesian3dPoint(0, 5, 5), new Cartesian3dPoint(0, 7, 7), new Cartesian3dPoint(-15, 0, 0), 0, 0, 0
            ],
            'Orthogonal projection point +y in zero' => [
                new Cartesian3dPoint(5, 0, 5), new Cartesian3dPoint(7, 0, 7), new Cartesian3dPoint(0, 15, 0), 0, 0, 0
            ],
            'Orthogonal projection point -y in zero' => [
                new Cartesian3dPoint(5, 0, 5), new Cartesian3dPoint(7, 0, 7), new Cartesian3dPoint(0, -15, 0), 0, 0, 0
            ],
            'Orthogonal projection point +z on plane O+x+y' => [
                new Cartesian3dPoint(3, 0, 0), new Cartesian3dPoint(0, 3, 0), new Cartesian3dPoint(3, 3, 3), 3, 3, 0
            ],
            'Orthogonal projection point -z on plane O+x+y' => [
                new Cartesian3dPoint(3, 0, 0), new Cartesian3dPoint(0, 3, 0), new Cartesian3dPoint(3, 3, -3), 3, 3, 0
            ],
            'Orthogonal projection point +y on plane O+x+z' => [
                new Cartesian3dPoint(3, 0, 0), new Cartesian3dPoint(0, 0, 3), new Cartesian3dPoint(3, 3, 3), 3, 0, 3
            ],
            'Orthogonal projection point -y on plane O+x+z' => [
                new Cartesian3dPoint(3, 0, 0), new Cartesian3dPoint(0, 0, 3), new Cartesian3dPoint(3, -3, 3), 3, 0, 3
            ],
            'Orthogonal projection point +x on plane O+y+z' => [
                new Cartesian3dPoint(0, 3, 0), new Cartesian3dPoint(0, 0, 3), new Cartesian3dPoint(3, 3, 3), 0, 3, 3
            ],
            'Orthogonal projection point -x on plane O+y+z' => [
                new Cartesian3dPoint(0, 3, 0), new Cartesian3dPoint(0, 0, 3), new Cartesian3dPoint(-3, 3, 3), 0, 3, 3
            ],
            'Projection on inclined plane' => [
                new Cartesian3dPoint(3, 0, 3), new Cartesian3dPoint(0, 3, 3), new Cartesian3dPoint(0, 0, 3), 1, 1, 2
            ]
        ];
    }

    /**
     * Test
     *
     * @param $firstPoint
     * @param $secondPoint
     * @param $targetPoint
     * @param $expectedPoint
     *
     * @return void
     *
     * @dataProvider calcProjectionPointProvider
     * @throws ArchitecturalException
     */
    public function testCalcProjectionPoint($firstPoint, $secondPoint, $targetPoint, $expectedX, $expectedY, $expectedZ)
    {
        $plain = new Cartesian3dPlainViaTwoPointsAndZero($firstPoint, $secondPoint);
        $projectedPoint = $plain->calcPointProjection($targetPoint);

        static::assertInstanceOf('\\PhpGeoMath\\Model\\Cartesian3dPoint', $projectedPoint);
        self::assertEquals($expectedX, $projectedPoint->x);
        self::assertEquals($expectedY, $projectedPoint->y);
        self::assertEquals($expectedZ, $projectedPoint->z);
    }
}