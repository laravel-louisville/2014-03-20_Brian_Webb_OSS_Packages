<?php

class BookTest extends TestCase
{

    /**
     * Test to ensure that the entity implements
     * the required interfaces
     *
     * @return void
     */
    public function testInterfacesArePresent()
    {
        $refl = new \ReflectionClass("Book");

        $this->assertTrue(
            $refl->implementsInterface('Contracts\Instances\InstanceInterface'),
            'Book does not implement InstanceInterface'
        );
    }
}
