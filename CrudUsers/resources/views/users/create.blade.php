@extends('layouts.app')

@section('page_title')
    Crear usuario
@endsection

@section('content')
    <a class="btn btn-warning btn-sm" href="{{url("/users/list")}}"><i class="fa fa-backward"></i>
        Regresar</a>
    <h3>Crear usuario</h3>
    <div id="user">
        <edit-user d_type_users="{{$userTypes}}" d_user="">
        </edit-user>
    </div>
    <template id="edit-user-template">
        <form id="userForm">
            {{csrf_field()}}
            @include('users.partials.inputs')
            <button type="submit" id="btnGuardar" class="btn btn-success btn-sm" v-on:click="enviar($event)"><i class="fa fa-floppy-o"></i> Guardar
            </button>
        </form>
    </template>
@endsection

@section('scripts')
    <script type="text/javascript">
        var urlIndex = "{{url("/users/list")}}";
        var urlGeneral = "{{url("/users/create")}}";
        var urlValidation = "{{url("/users/create")}}";
    </script>
    <script src="{{asset("/js/users.js")}}"></script>
@endsection