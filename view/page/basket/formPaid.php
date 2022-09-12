<div class="container">
	<h2>Choisir un moyen de paiement</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=formAddress">
            	<?php
					foreach ($paids as $paid) {
						echo '<div class="form-group">';
							echo '<input name="paidMethod" type="radio" class="" id="' . $paid['paiMethod'] . '" value="' . $paid['paiMethod'] . '" />';
							echo '<label for="' . $paid['paiMethod'] . '">' . $paid['paiMethod']; 
							if($paid['paiType'] == 'CHF'){
								echo '(+ CHF ' . number_format($paid['paiExtra'], 2) . ')';
							} elseif ($paid['paiType'] == '%') {
								echo '(+ ' . $paid['paiExtra'] . '%)';
							}
							echo '</label>';
						echo '</div>';
					}
				?>
				<button type="submit" class="btn btn-default">Suivant</button>
			</form>
		</div>
	</div>
</div>