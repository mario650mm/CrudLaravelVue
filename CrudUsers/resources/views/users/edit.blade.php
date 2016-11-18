@extends('layouts.app')

@section('page_title')
    Editar usuario
@endsection

@section('content')
    <a class="btn btn-warning btn-sm" href="{{url("/users/list")}}"><i class="fa fa-backward"></i>
        Regresar</a>
    <div class="col-lg-2 pull-right">
        @include('users.partials.delete')
    </div>
    <hr>
    <h3>Editar usuario</h3>
    <div id="user">
        <edit-user d_type_users="{{$userTypes}}" d_user="{{$user}}">
        </edit-user>
    </div>
    <template id="edit-user-template">
        <form id="userForm">
            <input type="hidden" id="_method" name="_method" value="PUT" />
            {{csrf_field()}}
            @section('user_image')
                @if(Storage::disk('images')->has($user->image))
                    <label for="imgUser">Imagen actual de usuario</label>
                    <br>
                    <img id="imgUser" src="{{url("/users/showImagen/".$user->image)}}" width="120px" height="150px"/>
                @endif
            @endsection
            @include('users.partials.inputs')
            <input type="hidden" id="imgHidden" name="imgHidden" value="{{$user->image}}" />
            <button type="submit" id="btnGuardar" class="btn btn-success btn-sm" v-on:click="enviar($event)"><i
                        class="fa fa-floppy-o"></i> Guardar
            </button>
        </form>
    </template>
@endsection

@section('scripts')
    <script type="text/javascript">
        var urlIndex = "{{url("/users/list")}}";
        var urlGeneral = "{{url("/users/update")}}"+"/"+"{{$user->id}}";
        var urlValidation="";
    </script>
    <script src="{{asset("/js/users.js")}}"></script>
@endsection