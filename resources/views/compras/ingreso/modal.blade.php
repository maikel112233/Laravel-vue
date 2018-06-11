<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ingreso->id}}">
    {{Form::open(array('action'=>array('IngresoController@destroy',$ingreso->id),'method'=>'DELETE'))}}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancelar ingreso <span class="text-success">{{$ingreso->numero_comprobante}}</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirme si desea cancelar el ingreso</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    
    {{Form::close()}}
</div>