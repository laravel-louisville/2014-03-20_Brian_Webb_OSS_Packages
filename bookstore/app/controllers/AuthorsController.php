<?php

use Services\AuthorCreator;
use Contracts\Repositories\AuthorRepositoryInterface;
use Contracts\Instances\InstanceInterface;
use Contracts\Notification\CreatorInterface;
use Contracts\Notification\UpdaterInterface;
use Contracts\Notification\DestroyerInterface;
use Validators\Validator as Validator;

class AuthorsController extends BaseController implements CreatorInterface, UpdaterInterface, DestroyerInterface
{

    /**
     * Author Repository
     *
     * @var AuthorRepositoryInterface
     */
    protected $author;

    public function __construct(AuthorRepositoryInterface $author)
    {
        $this->author = $author;
    }

    /**
     * Display a listing of the authors.
     *
     * @return Response
     */
    public function index()
    {
        $authors = $this->author->all();

        return $authors->toJson();
    }

    /**
     * Show the form for creating a new author.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('authors.create');
    }

    /**
     * Store a newly created author in storage.
     *
     * @return Response
     */
    public function store()
    {
        $author_creator = App::make('Services\Authors\AuthorCreator');

        return $author_creator->create($this->author, $this, Input::except('_token'));
    }

    /**
     * Handle successful author creation
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function creationSucceeded(InstanceInterface $instance)
    {
        return $instance->toJson();
    }

    /**
     * Handle an error with author creation
     *
     * @param  Validator\Validator      $validator
     * @return Redirect::route
     */
    public function creationFailed(Validator $validator)
    {
        return Response::json($validator->errors(), 422);
    }

    /**
     * Display the specified author.
     *
     * @param  int      $id
     * @return Response
     */
    public function show($id)
    {
        $author = $this->author->find($id);

        return $author->toJson();
    }

    /**
     * Show the form for editing the specified author.
     *
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        $author = $this->author->find($id);

        return View::make('authors.edit', compact(‘author’));
    }

    /**
     * Update the specified author in storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function update($id)
    {
        $author_updater = App::make('Services\Authors\AuthorUpdater');

        return $author_updater->update($this->author, $this, $id, Input::except('_method'));
    }

    /**
     * Handle successful author update
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function updateSucceeded(InstanceInterface $instance)
    {
        return $instance->toJson();
    }

    /**
     * Handle an error with author update
     *
     * @param  InstanceInterface $instance
     * @param  Validator\Validator      $validator
     * @return Redirect::route
     */
    public function updateFailed(InstanceInterface $instance, Validator $validator)
    {
        return Response::json($validator->errors(), 422);
    }

    /**
     * Remove the specified author from storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        $author_destroyer = App::make('Services\Authors\AuthorDestroyer');

        return $author_destroyer->destroy($this->author, $this, $id, Input::except('_method'));
    }

    /**
     * Handle successful author destroy
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function destroySucceeded(InstanceInterface $instance)
    {
        return Response::json([], 200);
    }

    /**
     * Handle an error with author destroy
     *
     * @param  InstanceInterface $instance
     * @return Redirect::route
     */
    public function destroyFailed(InstanceInterface $instance)
    {
        return Response::json(['errors' => ['Oops, couldn\'t delete that author']], 422);
    }
}
