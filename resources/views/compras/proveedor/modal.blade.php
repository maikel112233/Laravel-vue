<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$persona->id}}">
    {{Form::open(array('action'=>array('ProveedorController@destroy',$persona->id),'method'=>'DELETE'))}}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar proveedor <span class="text-success">{{$persona->nombre}}</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirme si desea eliminar el proveedor</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    
    {{Form::close()}}
</div>