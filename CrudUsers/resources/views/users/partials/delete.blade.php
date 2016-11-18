<form action="{{url("/users/delete/".$user->id)}}" method="post">
    <input type="hidden" id="_method" name="_method" value="DELETE" />
    {{ csrf_field() }}
    <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
        <i class="fa fa-trash"></i>
        Eliminar
    </button>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Usuarios</h4>
                </div>
                <div class="modal-body">
                    ¿ Estás seguro de eliminar este usuario llamado   <b>{{$user->name}}</b> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>   Eliminar</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>   Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>