<?php namespace Repositories;

use Contracts\Repositories\BookRepositoryInterface;
use Book;

class DbBookRepository extends DbRepository implements BookRepositoryInterface
{
    public function __construct(Book $model)
    {
        $this->model = $model;
    }
}
