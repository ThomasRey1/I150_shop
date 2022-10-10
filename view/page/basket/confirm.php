<div class="container">

	<h2>Liste des articles</h2>
	<!-- Show if the produit was add to the basket -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php
			echo "Votre produit a été " . $text;
			if($text != "ajouté au panier") {
				echo "<p><a href='index.php?controller=basket&action=list'>Retour au panier</a></p>";
			} else {
				echo "<p><a href='index.php?controller=shop&action=list'>Retour à la liste des produits</a></p>";
			}
		?>
		
		</div>
</div>
