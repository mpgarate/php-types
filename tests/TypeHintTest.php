<?php

class A {}
class B extends A {}

class TypeHintTest extends \PHPUnit\Framework\TestCase {

    // toy functions with hints

    private function acceptsInt(int $n) {
        return $n;
    }

    private function returnsInt($n): int {
        return $n;
    }

    private function acceptsBool(bool $b) {
        return $b;
    }

    private function acceptsNullableBool(?bool $b) {
        return $b;
    }

    private function acceptsFloat(float $n) {
        return $n;
    }

    private function acceptsA(A $a) {
        return $a;
    }

    private function acceptsB(B $b) {
        return $b;
    }

    // tests

    public function testAcceptsInt_int() {
        $this->assertTrue(2 === $this->acceptsInt(2));
    }

    public function testAcceptsInt_intString() {
        $this->assertTrue(2 === $this->acceptsInt("2"));
    }

    public function testAcceptsInt_floatString() {
        $this->assertTrue(2 === $this->acceptsInt("2.7"));
    }

    public function testAcceptsInt_otherString() {
        $this->expectException(TypeError::class);
        $this->assertTrue(2 === $this->acceptsInt("foo"));
    }

    public function testReturnsInt_intString() {
        $this->assertTrue(2 === $this->returnsInt("2"));
    }

    public function testReturnsInt_bool() {
        $this->assertTrue(1 === $this->returnsInt(true));
        $this->assertTrue(0 === $this->returnsInt(false));
    }

    public function testAcceptsBool_string() {
        $this->assertTrue(true === $this->acceptsBool("foo"));
        $this->assertTrue(false === $this->acceptsBool(""));
    }

    public function testAcceptsBool_null() {
        $this->expectException(TypeError::class);

        $this->acceptsBool(null);
    }

    public function testAcceptsNullableBool_null() {
        $this->assertTrue(null === $this->acceptsNullableBool(null));
    }

    public function testAcceptsFloat() {
        $this->assertTrue(3.0 === $this->acceptsFloat(3));
    }

    public function testAcceptsA() {
        $b = new B;
        $this->assertTrue($b === $this->acceptsA($b));
    }

    public function testAcceptsB() {
        $this->expectException(TypeError::class);

        $this->acceptsB(new A());
    }
}
