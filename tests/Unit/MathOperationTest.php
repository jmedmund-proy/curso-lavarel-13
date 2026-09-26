<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class MathOperations{
    function add($a, $b){
        return $a+$b;
    }

    function subtract($a, $b){
        return $a-$b;
    }

    function multiply($a, $b){
        return $a*$b;
    }

    function divide($a, $b){
        return $a/$b;
    }
}

class MathOperationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function testAdd(): void {
        $mathOperations = new MathOperations();
        $result = $mathOperations->add(2,3);

        $this->assertEquals(5, $result);
    }

    public function testSubtract(): void {
        $mathOperations = new MathOperations();
        $result = $mathOperations->subtract(8,3);

        $this->assertEquals(5, $result);
    }
    // Para realizar la prueba
    /*  php artisan test tests/Unit/MathOperationTest.php  */
}
