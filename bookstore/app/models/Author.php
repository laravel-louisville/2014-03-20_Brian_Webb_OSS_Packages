<?php

use Contracts\Instances\InstanceInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Author extends Eloquent implements InstanceInterface
{
    protected $guarded = [];

    public function identity()
    {
        return $this->id;
    }
}
