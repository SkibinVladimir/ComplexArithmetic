<?php
/**
 * Тестирование ComplexArithmetic
 */

require_once __DIR__ . '/tools/PHPUnit/Framework/TestCase.php';

require_once __DIR__ . '/ComplexArithmetic.php';


class ComplexArithmeticTest extends PHPUnit_Framework_TestCase {

    /** @test */
    public function addTest(){

        $complexArithmetic = new ComplexArithmetic();

        $nom1 = (object) ['x' => 1, 'y' => 2];
        $nom2 = (object) ['x' => 0, 'y' => 0];

        $sum = $complexArithmetic->add($nom1, $nom2);

        $this->assertEquals(1, $sum->x);

        $this->assertEquals(2, $sum->y);
    }

    /** @test */
    public function subTest(){

        $complexArithmetic = new ComplexArithmetic();

        $nom1 = (object) ['x' => 1, 'y' => 2];
        $nom2 = (object) ['x' => 0, 'y' => 0];

        $diff = $complexArithmetic->sub($nom1, $nom2);

        $this->assertEquals(1, $diff->x);

        $this->assertEquals(2, $diff->y);
    }

    /** @test */
    public function multTest(){

        $complexArithmetic = new ComplexArithmetic();

        $nom1 = (object) ['x' => 1, 'y' => 2];
        $nom2 = (object) ['x' => 0, 'y' => 0];

        $prod = $complexArithmetic->mult($nom1, $nom2);

        $this->assertEquals(0, $prod->x);

        $this->assertEquals(0, $prod->y);

    }

    /** @test */
    public function divTest(){

        $complexArithmetic = new ComplexArithmetic();

        $nom1 = (object) ['x' => 0, 'y' => 0];
        $nom2 = (object) ['x' => 2, 'y' => 3];

        $quot = $complexArithmetic->div($nom1, $nom2);

        $this->assertEquals(0, $quot->x);

        $this->assertEquals(0, $quot->y);

    }

    /** @test */
    public function toStrTest() {

        $complexArithmetic = new ComplexArithmetic();

        $nom1 = (object) ['x' => 1, 'y' => 2];
        $nom2 = (object) ['x' => 0, 'y' => 0];

        $sum = $complexArithmetic->add($nom1, $nom2);
        $toStr = $complexArithmetic->toStr($sum);
        $this->assertEquals('1+2i', $toStr);

        $quot = $complexArithmetic->div($nom1, $nom2);
        $toStr = $complexArithmetic->toStr($quot);
        $this->assertEquals('Error code = 1', $toStr);

    }

}