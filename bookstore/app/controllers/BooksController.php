<?php

use Services\BookCreator;
use Contracts\Repositories\BookRepositoryInterface;
use Contracts\Instances\InstanceInterface;
use Contracts\Notification\CreatorInterface;
use Contracts\Notification\UpdaterInterface;
use Contracts\Notification\DestroyerInterface;
use Validators\Validator as Validator;

class BooksController extends BaseController implements CreatorInterface, UpdaterInterface, DestroyerInterface
{

    /**
     * Book Repository
     *
     * @var BookRepositoryInterface
     */
    protected $book;

    public function __construct(BookRepositoryInterface $book)
    {
        $this->book = $book;
    }

    /**
     * Display a listing of the books.
     *
     * @return Response
     */
    public function index()
    {
        $books = $this->book->all();

        return View::make('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('books.create');
    }

    /**
     * Store a newly created book in storage.
     *
     * @return Response
     */
    public function store()
    {
        $book_creator = App::make('Services\Books\BookCreator');

        return $book_creator->create($this->book, $this, Input::except('_token'));
    }

    /**
     * Handle successful book creation
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function creationSucceeded(InstanceInterface $instance)
    {
        return Redirect::route('books.index')->with('message', 'Book was successfully created');
    }

    /**
     * Handle an error with book creation
     *
     * @param  Validator\Validator      $validator
     * @return Redirect::route
     */
    public function creationFailed(Validator $validator)
    {
        return Redirect::route('books.create')
            ->withInput()
            ->withErrors($validator->errors())
            ->with('message', 'Oops, there was an error');
    }

    /**
     * Display the specified book.
     *
     * @param  int      $id
     * @return Response
     */
    public function show($id)
    {
        $book = $this->book->find($id);

        return View::make('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->book->find($id);

        return View::make('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function update($id)
    {
        $book_updater = App::make('Services\Books\BookUpdater');

        return $book_updater->update($this->book, $this, $id, Input::except('_method'));
    }

    /**
     * Handle successful book update
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function updateSucceeded(InstanceInterface $instance)
    {
        return Redirect::route('books.show', $instance->identity());
    }

    /**
     * Handle an error with book update
     *
     * @param  InstanceInterface $instance
     * @param  Validator\Validator      $validator
     * @return Redirect::route
     */
    public function updateFailed(InstanceInterface $instance, Validator $validator)
    {
        return Redirect::route('books.edit', $instance->identity())
            ->withInput()
            ->withErrors($validator->errors())
            ->with('message', 'Oops, there was an error');
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        $book_destroyer = App::make('Services\Books\BookDestroyer');

        return $book_destroyer->destroy($this->book, $this, $id, Input::except('_method'));
    }

    /**
     * Handle successful book destroy
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function destroySucceeded(InstanceInterface $instance)
    {
        return Redirect::route('books.index')->with('message', 'Book was successfully deleted');
    }

    /**
     * Handle an error with book destroy
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function destroyFailed(InstanceInterface $instance)
    {
        return Redirect::route('books.index')->with('message', 'Oops, couldn\'t delete that book');
    }
}
