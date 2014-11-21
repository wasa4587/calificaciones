@extends('layouts.default')
@section('content')

<h1>Editar Usuario</h1>

<div class="row">
  <div class="span7">
        <div class="container">
<!-- if there are creation errors, they will show here -->
@foreach ($errors->all() as $error)
  <div class="alert alert-danger" role="alert">
    {{$error}}.
  </div>
@endforeach


{{ Form::model($user, array('url' => 'users/update/'.$user->id , 'method' => 'put')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'span4 form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', Input::old('username'), array('class' => 'span4 form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

        </div>
    </div>
</div>



@stop

