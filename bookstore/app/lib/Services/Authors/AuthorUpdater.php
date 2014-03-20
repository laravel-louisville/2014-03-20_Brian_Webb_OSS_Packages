<?php namespace Services\Authors;

use Contracts\Repositories\AuthorRepositoryInterface;
use Contracts\Notification\UpdaterInterface;
use Validators\AuthorValidator;

class AuthorUpdater
{

    protected $validator;

    /**
     * Inject the validator used for updating
     * 
     * @param AuthorValidator $validator
     */
    public function __construct(AuthorValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Attempt to update the author with the given attributes and
     * notify the $listener of the success or failure
     * 
     * @param  AuthorRepositoryInterface $author
     * @param  UpdaterInterface         $listener 
     * @param  mixed                    $identity
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener 
     */
    public function update(AuthorRepositoryInterface $author, UpdaterInterface $listener, $identity, array $attributes = [])
    {
        $instance = $author->find($identity);

        if ($this->validator->validate($attributes)) {

            $instance->update($attributes);

            return $listener->updateSucceeded($instance);

        } else {

            return $listener->updateFailed($instance, $this->validator);
        }
    }
}
