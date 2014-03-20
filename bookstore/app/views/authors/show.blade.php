@extends('layouts.scaffold')

@section('main')

<h1>Show Author</h1>

<p>{{ link_to_route('authors.index', 'Return to all authors') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>name</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $author->name }}</td>

            <td>{{ link_to_route('authors.edit', 'Edit', array($author->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('authors.destroy', $author->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop
