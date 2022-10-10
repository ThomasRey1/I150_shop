<div class="container">

	<h2>Choisir un moyen de livraison</h2>
	<!-- choose a delivery method -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=formPaid">
				<?php
					foreach ($deliveries as $delivery) {
						echo '<div class="form-group">';
							echo '<input name="deliveryMethod" type="radio" class="" id="' . $delivery['delMethod'] . '" value="' . $delivery['delMethod'] . '" />';
							echo '<label for="' . $delivery['delMethod'] . '">' . $delivery['delMethod']; 
							if($delivery['delType'] == 'CHF'){
								echo '(+ CHF ' . number_format($delivery['delExtra'], 2) . ')';
							} elseif ($delivery['delType'] == '%') {
								echo '(+ ' . $delivery['delExtra'] . '%)';
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