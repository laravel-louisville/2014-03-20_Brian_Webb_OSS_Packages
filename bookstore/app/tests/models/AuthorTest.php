<?php

class AuthorTest extends TestCase
{

    /**
     * Test to ensure that the entity implements
     * the required interfaces
     *
     * @return void
     */
    public function testInterfacesArePresent()
    {
        $refl = new \ReflectionClass("Author");

        $this->assertTrue(
            $refl->implementsInterface('Contracts\Instances\InstanceInterface'),
            'Author does not implement InstanceInterface'
        );
    }
}
