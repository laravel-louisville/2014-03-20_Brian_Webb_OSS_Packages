@extends('layouts.scaffold')

@section('main')

<h1>All Authors</h1>

<p>{{ link_to_route('authors.create', 'Add new ') }}</p>

@if ($authors->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>name</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>

                    <td>{{ link_to_route('authors.show', 'View', array($author->id), array('class' => 'btn')) }}</td>

                    <td>{{ link_to_route('authors.edit', 'Edit', array($author->id), array('class' => 'btn btn-info')) }}</td>

                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('authors.destroy', $author->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@else
    There are no authors
@endif

@stop
