@extends('layouts.scaffold')

@section('main')

<h1>Edit Author</h1>

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

{{ Form::model($author, array('method' => 'PATCH', 'route' => array('authors.update', $author->id))) }}
    <ul>
        
        @include('authors._form')

        <li>
            {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
            {{ link_to_route('authors.show', 'Cancel', $author->id, array('class' => 'btn')) }}
        </li>

    </ul>
{{ Form::close() }}

@stop
