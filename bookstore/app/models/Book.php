<?php

use Contracts\Instances\InstanceInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Book extends Eloquent implements InstanceInterface
{
    protected $guarded = [];

    public function identity()
    {
        return $this->id;
    }
}
