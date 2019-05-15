<div  class="modal fade popup-main" data-backdrop="static" id="popup_cotiza" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

			<div class="modal-header">
				<div class="logo-popup text-center">
					<img src="images/logo.png" alt="<?php echo $config->info->titulo;?>" class="img-fluid">
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<div class="container">
					<div class="row">
						<div class="col-md-4 col-fondo">
							
						</div>
						<div class="col-md-8">

							<div class="box-popup-content">
								<div class="box-popup-header text-center mb-4">
									<h1>¡Contrata ahora!</h1>
									<h3 class="nombre-producto"></h3>
									<span class="subtitle"></span>
								</div>

								<div class="box-form-popup">

									<?php echo createForm( $config->forms->cotiza ); ?>

								</div>
							</div>
							
						</div>
					</div>
				</div>


			</div>
        </div>

    </div>
</div>