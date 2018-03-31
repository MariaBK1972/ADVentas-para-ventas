<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$usu->id}}">

	{{Form::Open(array('action'=>array('UsuarioController@destroy',$usu->id),'method'=>'delete'))}}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="model-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
						<h4 class="modal-title">Eliminar Usuario</h4>
						
					</button>
					
				</div>
				<div class="model-body">
					<p>Confirme si desea eliminar el Usuario</p>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
				</div>

			</div>
		</div>
	{{Form::close()}}
	
</div>