<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$categoria->id}}">
    {{Form::open(array('action'=>array('CategoriaController@destroy',$categoria->id),'method'=>'DELETE'))}}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar categoria <span class="text-success">{{$categoria->nombre}}</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirme si desea eliminar la categoria</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    
    {{Form::close()}}
</div>