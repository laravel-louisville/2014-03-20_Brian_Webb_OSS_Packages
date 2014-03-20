<?php namespace Services\Authors;

use Contracts\Repositories\AuthorRepositoryInterface;
use Contracts\Notification\CreatorInterface;
use Validators\AuthorValidator;

class AuthorCreator
{

    protected $validator;


    /**
     * Inject the validator that will be used for
     * creation
     * 
     * @param AuthorValidator $validator
     */
    public function __construct(AuthorValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Attempt to create a new author with the given attributes and
     * notify the $listener of the success or failure
     * 
     * @param  AuthorRepositoryInterface $author     
     * @param  CreatorInterface         $listener  
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener                        
     */
    public function create(AuthorRepositoryInterface $author, CreatorInterface $listener, array $attributes = [])
    {
        if ($this->validator->validate($attributes)) {

            $instance = $author->create($attributes);
            
            return $listener->creationSucceeded($instance);

        } else {

            return $listener->creationFailed($this->validator);
        }
    }
}
