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
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Listas</h4>
                        </div>
                        <div class="modal-body">
                            Estás seguro de actualizar este usuario llamado <b>{{    $user->name}}</b> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i
                                        class="fa fa-times"></i>
                                Cancelar operación
                            </button>
                            <button type="submit" class="btn btn-success btn-sm"
                                    v-on:click="enviar($event)"><i class="fa fa-floppy-o"></i>
                                Guardar cambios
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                    data-target="#updateModal"><i class="fa fa-floppy-o"></i> Guardar</button>
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