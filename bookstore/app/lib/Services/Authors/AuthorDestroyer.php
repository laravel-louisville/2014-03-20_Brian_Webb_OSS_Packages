<?php namespace Services\Authors;

use Contracts\Repositories\AuthorRepositoryInterface;
use Contracts\Notification\DestroyerInterface;
use Validators\AuthorValidator;

class AuthorDestroyer
{

    /**
     * Attempt to destroy the author and
     * notify the $listener of the success or failure.  The
     * $attributes are passed in as a convenience in case they
     * are needed
     * 
     * @param  AuthorRepositoryInterface $author
     * @param  DestroyerInterface       $listener 
     * @param  mixed                    $identity
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener 
     */
    public function destroy(AuthorRepositoryInterface $author, DestroyerInterface $listener, $identity, array $attributes = [])
    {
        $instance = $author->find($identity);

        if ($instance->delete()) {

            return $listener->destroySucceeded($instance);

        } else {

            return $listener->destroyFailed($instance);
        }
    }
}
