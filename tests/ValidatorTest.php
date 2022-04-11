<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{

    /**
     * @covers Validator::__constructor
     */
    public function testConstructor(): void
    {

        $validator = new \RegForm\Validator(
            'test@example.com',
            'abc123',
            'abc123');

        $this->assertInstanceOf(
            \RegForm\Validator::class,
            $validator);

    }


    /**
     * @covers Validator::isEmail
     */
    public function testValidEmail(): void
    {
        $validator = new \RegForm\Validator(
            'test@example.com',
            'abc123',
            'abc123');
        $this->assertEquals('test@example.com', $validator->isEmail());
    }


    /**
     * @covers Validator::isEmail
     */
    public function testNotValidEmail1(): void
    {
        $validator = new \RegForm\Validator(
            'testexample.com',
            'abc123',
            'abc123');
        $this->assertNotTrue($validator->isEmail());
    }


    /**
     * @covers Validator::isEmail
     */
    public function testNotValidEmail2(): void
    {
        $validator = new \RegForm\Validator(
            'test@examplecom',
            'abc123',
            'abc123');
        $this->assertNotTrue($validator->isEmail());
    }


    /**
     * @covers Validator::isEmail
     */
    public function testNotValidEmail3(): void
    {
        $validator = new \RegForm\Validator(
            'test@example.com123',
            'abc123',
            'abc123');
        $this->assertNotTrue($validator->isEmail());
    }


    /**
     * @covers Validator::isPassword
     */
    public function testTheSamePasswords(): void
    {
        $validator = new \RegForm\Validator(
            'test@example.com',
            'abc123',
            'abc123');
        $this->assertTrue($validator->isPassword());
    }


    /**
     * @covers Validator::isPassword
     */
    public function testNotTheSamePasswords(): void
    {
        $validator = new \RegForm\Validator(
            'test@example.com123',
            'abc123',
            'abc12');
        $this->assertNotTrue($validator->isPassword());
    }


}