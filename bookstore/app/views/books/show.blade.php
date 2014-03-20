@extends('layouts.scaffold')

@section('main')

<h1>Show Book</h1>

<p>{{ link_to_route('books.index', 'Return to all books') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>title</th>
            <th>author</th>
            <th>price</th>
            <th>published_on</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->published_on }}</td>

            <td>{{ link_to_route('books.edit', 'Edit', array($book->id), array('class' => 'btn btn-info')) }}</td>
            <td>
                {{ Form::open(array('method' => 'DELETE', 'route' => array('books.destroy', $book->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}
            </td>
        </tr>
    </tbody>
</table>

@stop
