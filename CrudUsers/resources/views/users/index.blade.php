@extends('layouts.app')

@section('page_title')
    Usuarios
@endsection

@section('content')
    <h3>Usuarios</h3>
    <form action="{{url("/users/list")}}" method="get">
        <div class="row">
            <div class="form-group col-sm-1">
                <a href="{{url("/users/create")}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                    Crear</a>
            </div>
            <div class="form-group col-sm-3">
                <input type="text" id="name" name="name" class="form-control input-sm"
                       placeholder="Buscar por nombre"
                       value="{{Request::get('name')}}"/>
            </div>
            <div class="form-group col-sm-3">
                <input type="text" id="email" name="email" class="form-control input-sm"
                       placeholder="Buscar por correo"
                       value="{{Request::get('email')}}"/>
            </div>
            <div class="form-group col-sm-3">
                <input type="text" id="type" name="type" class="form-control input-sm"
                       placeholder="Buscar por tipo"
                       value="{{Request::get('type')}}"/>
            </div>
            <div class="form-group col-sm-1" style="margin-left:-2.7%;">
                <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-responsive">
        <tr class="success">
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->type}}</td>
                <td width="15%"><a href="{{url("/users/edit/".$user->id)}}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i> Editar</a></td>
            </tr>
        @endforeach
    </table>
    <div class="text-center">
        {{$users->appends(Request::only(['name','email','type']))->links()}}
    </div>
@endsection

@section('scripts')
@endsection