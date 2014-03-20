<?php namespace Services\Books;

use Contracts\Repositories\BookRepositoryInterface;
use Contracts\Notification\DestroyerInterface;
use Validators\BookValidator;

class BookDestroyer
{

    /**
     * Attempt to destroy the book and
     * notify the $listener of the success or failure.  The
     * $attributes are passed in as a convenience in case they
     * are needed
     * 
     * @param  BookRepositoryInterface $book
     * @param  DestroyerInterface       $listener 
     * @param  mixed                    $identity
     * @param  array                    $attributes
     * @return mixed - returned value from the $listener 
     */
    public function destroy(BookRepositoryInterface $book, DestroyerInterface $listener, $identity, array $attributes = [])
    {
        $instance = $book->find($identity);

        if ($instance->delete()) {

            return $listener->destroySucceeded($instance);

        } else {

            return $listener->destroyFailed($instance);
        }
    }
}
