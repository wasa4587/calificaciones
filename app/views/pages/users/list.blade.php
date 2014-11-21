@extends('layouts.default')
@section('content')
      <div class="page-header">
        <h1>Usuarios</h1>
      </div>
      <div class="row">
        <div class="col-md-9">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
@foreach ($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    {{link_to('users/edit/'.$user->id, 'Editar');}}
                    {{link_to('users/delete/'.$user->id, 'Borrar');}}
                  </form>
                </td>
              </tr>
@endforeach
            </tbody>
          </table>
        </div>
      </div>
      </div>
<?php echo $users->links(); ?>


@stop

