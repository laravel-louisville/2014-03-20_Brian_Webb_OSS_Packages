<?php

use Mockery as m;

class AuthorsTest extends TestCase
{
    public function __construct()
    {
        $this->entity = m::mock('Author');

        $this->repository = m::mock(
            'Contracts\Repositories\AuthorRepositoryInterface',
            [$this->entity]
        );

        $this->collection = m::mock('Illuminate\Database\Eloquent\Collection')
            ->shouldDeferMissing();

        $this->controller = m::mock(
            'AuthorsController[destroySucceeded,destroyFailed,updateSucceeded,updateFailed,creationSucceeded,creationFailed]',
            [$this->repository]
        );

        $this->validator = m::mock(
            'Validators\AuthorValidator[validate]'
        );
    }



    public function setUp()
    {
        parent::setUp();

        $this->attributes = [
            'name' => 'dreamcatcher',
            'id' => 1,
            'created_at' => '2014-03-20 21:00:00',
            'updated_at' => '2014-03-20 21:00:00',
        ];

        $this->app->instance(
            'Author',
            $this->entity
        );

        $this->app->instance(
            'Contracts\Repositories\AuthorRepositoryInterface',
            $this->repository
        );

        $this->app->instance('AuthorsController', $this->controller);

        $this->app->instance('Validators\AuthorValidator', $this->validator);
    }



    public function tearDown()
    {
        m::close();
    }



    public function testIndex()
    {
        $this->repository
            ->shouldReceive('all')
            ->once()
            ->andReturn($this->collection);

        $this->call('GET', 'authors');

        $this->assertViewHas('authors');
    }



    public function testCreate()
    {
        $this->call('GET', 'authors/create');

        $this->assertResponseOk();
    }



    public function testStore()
    {
        $this->validator
            ->shouldReceive('validate')
            ->once()
            ->with($this->attributes)
            ->andReturn(true);

        $this->repository
            ->shouldReceive('create')
            ->once()
            ->with($this->attributes)
            ->andReturn($this->entity);

        $this->controller
            ->shouldReceive('creationSucceeded')
            ->once()
            ->with($this->entity)
            ->andReturn("OK");

        $this->call('POST', 'authors', $this->attributes);
    }



    public function testStoreFails()
    {
        $this->validator
            ->shouldReceive('validate')
            ->once()
            ->with($this->attributes)
            ->andReturn(false);

        $this->controller
            ->shouldReceive('creationFailed')
            ->once()
            ->with($this->validator)
            ->andReturn("OK");

        $this->call('POST', 'authors', $this->attributes);
    }



    public function testShow()
    {
        $this->repository->shouldReceive('find')
                   ->with(1)
                   ->once()
                   ->andReturn((object) $this->attributes);

        $this->call('GET', 'authors/1');

        $this->assertViewHas('author');
    }



    public function testEdit()
    {
        $this->collection->id = 1;

        $this->repository->shouldReceive('find')
                   ->with(1)
                   ->once()
                   ->andReturn($this->collection);

        $this->call('GET', 'authors/1/edit');

        $this->assertViewHas('author');
    }



    public function testUpdate()
    {
        $this->repository
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($this->entity);

        $this->validator
            ->shouldReceive('validate')
            ->once()
            ->with($this->attributes)
            ->andReturn(true);

        $this->entity
            ->shouldReceive('update')
            ->once()
            ->with($this->attributes);

        $this->controller
            ->shouldReceive('updateSucceeded')
            ->once()
            ->with($this->entity)
            ->andReturn("OK");

        $this->call('PATCH', 'authors/1', $this->attributes);
    }



    public function testUpdateFails()
    {
        $this->repository
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($this->entity);

        $this->validator
            ->shouldReceive('validate')
            ->once()
            ->with($this->attributes)
            ->andReturn(false);

        $this->controller
            ->shouldReceive('updateFailed')
            ->once()
            ->with($this->entity, $this->validator)
            ->andReturn("OK");

        $this->call('PATCH', 'authors/1', $this->attributes);
    }



    public function testDestroy()
    {
        $this->repository
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($this->entity);

        $this->entity
            ->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $this->controller
            ->shouldReceive('destroySucceeded')
            ->once()
            ->with($this->entity)
            ->andReturn("OK");

        $this->call('DELETE', 'authors/1');
    }



    public function testDestroyFails()
    {
        $this->repository
            ->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($this->entity);

        $this->entity
            ->shouldReceive('delete')
            ->once()
            ->andReturn(false);

        $this->controller
            ->shouldReceive('destroyFailed')
            ->once()
            ->with($this->entity)
            ->andReturn("OK");

        $this->call('DELETE', 'authors/1');
    }
}
