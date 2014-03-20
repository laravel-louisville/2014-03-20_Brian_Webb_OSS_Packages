<?php namespace Services\Books;

use Contracts\Repositories\BookRepositoryInterface;
use Contracts\Notification\UpdaterInterface;
use Validators\BookValidator;

class BookUpdater
{

    protected $validator;

    /**
     * Inject the validator used for updating
     * 
     * @param BookValidator $validator
     */
    public function __construct(BookValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Attempt to update the book with the given attributes and
     * notify the $listener of the success or failure
     * 
     * @param  BookRepositoryInterface $book
     * @param  UpdaterInterface         $listener 
     * @param  mixed                    $identity
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener 
     */
    public function update(BookRepositoryInterface $book, UpdaterInterface $listener, $identity, array $attributes = [])
    {
        $instance = $book->find($identity);

        if ($this->validator->validate($attributes)) {

            $instance->update($attributes);

            return $listener->updateSucceeded($instance);

        } else {

            return $listener->updateFailed($instance, $this->validator);
        }
    }
}
