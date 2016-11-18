@extends('layouts.app')

@section('page_title')
    Crear usuario
@endsection

@section('content')
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
        Vue.component('edit-user', {
            template: '#edit-user-template',
            props: ['d_type_users', 'd_user'],
            data: function () {
                return {
                    user_types: [],
                    user: {}
                };
            },
            methods: {
                enviar: function (event) {
                    event.preventDefault();
                    var url = "{{url("/users/create")}}";
                    var data = new FormData($("#userForm")[0]);
                    $.ajax({
                        method: "post",
                        url: url,
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data == "ok") {
                                window.location = "{{url("/users/list")}}";
                            }else{
                                alert("error de registro");
                            }
                        },
                        error: function () {
                            alert("error 500");
                        }
                    });
                }
            },
            created: function () {
                this.user_types = JSON.parse(this.d_type_users);
                if(this.d_user.length>0){
                    this.user = JSON.parse(this.d_user);
                }
            }
        });

        var vm = new Vue({
            el: '#user'
        });
    </script>
@endsection