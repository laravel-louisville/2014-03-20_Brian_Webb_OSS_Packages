@extends('layouts.scaffold')

@section('main')

<h1>Edit Book</h1>

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

{{ Form::model($book, array('method' => 'PATCH', 'route' => array('books.update', $book->id))) }}
    <ul>
        
        @include('books._form')

        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('books.show', 'Cancel', $book->id, array('class' => 'btn')) }}
        </li>

    </ul>
{{ Form::close() }}

@stop
