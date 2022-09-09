<div class="container">

	<h2>
		<?php
			echo $product[0]['proName'];
		?>
	</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php
			echo '<p>' . $product[0]['proDescription'] . '</p>';
			echo '<p>Encore : ' . $product[0]['proQuantity'] . ' en stock</p><br>';
			echo '<a class="btn btn-default" ';
			if ($product[0]['proQuantity'] == 0){
				echo 'disabled';
			}
			echo' href="index.php?controller=basket&action=add&id=' . $product[0]['idProduct'] . '">Ajouter au panier</a>';

		?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php
			
			echo '<img src="resources/image/' . $product[0]['proImage'] . '"/>';
			?>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php
			echo '<p> CHF : ' . $product[0]['proPrice'] . '</p>';

			if($product[0]['proLike'] > 0) {
				echo '<p>Ce produit est aimée déjà  <strong>' . $product[0]['proLike'] . '</strong> fois ! </p>';
			}
		?>
		</div>
	</div>
</div>