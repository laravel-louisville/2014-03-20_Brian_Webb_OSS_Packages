<?php namespace Repositories;

use Contracts\Repositories\AuthorRepositoryInterface;
use Author;

class DbAuthorRepository extends DbRepository implements AuthorRepositoryInterface
{
    public function __construct(Author $model)
    {
        $this->model = $model;
    }
}
