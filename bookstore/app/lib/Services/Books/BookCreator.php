<?php namespace Services\Books;

use Contracts\Repositories\BookRepositoryInterface;
use Contracts\Notification\CreatorInterface;
use Validators\BookValidator;

class BookCreator
{

    protected $validator;


    /**
     * Inject the validator that will be used for
     * creation
     * 
     * @param BookValidator $validator
     */
    public function __construct(BookValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Attempt to create a new book with the given attributes and
     * notify the $listener of the success or failure
     * 
     * @param  BookRepositoryInterface $book     
     * @param  CreatorInterface         $listener  
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener                        
     */
    public function create(BookRepositoryInterface $book, CreatorInterface $listener, array $attributes = [])
    {
        if ($this->validator->validate($attributes)) {

            $instance = $book->create($attributes);
            
            return $listener->creationSucceeded($instance);

        } else {

            return $listener->creationFailed($this->validator);
        }
    }
}
