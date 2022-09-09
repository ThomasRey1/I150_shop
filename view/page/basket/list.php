<div class="container">
	<h2>Votre panier</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php 
			if(isset($_SESSION['basket']) && count($_SESSION['basket']) != 0){
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Description</th>
						<th>Prix</th>
						<th>Quantité</th>
						<th>Sous-total</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$total = 0;
                //var_dump($_SESSION['basket']);
					foreach ($_SESSION['basket'] as $products) {
					//var_dump($products);
						echo '<tr>';
							echo '<td>' . $products[0]['proDescription'] . '</td>';
							echo '<td>' . $products[0]['proPrice'] . '</td>';
							echo '<td>' . $products['quantity'] . '</td>';
							echo '<td>' . $products['quantity'] * $products[0]['proPrice'] . '</td>';
							echo '<td>';
								echo '<a class="btn btn-default" href="index.php?controller=basket&action=formUpdate&id=' . $products[0]['idProduct'] . '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>';
								echo '<a onclick="return confirm(\'Etes-vous sûr ? \')" class="btn btn-default" href="index.php?controller=basket&action=remove&id=' . $products[0]['idProduct'] . '"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
							echo '</td>';
						echo '</tr>';
						$total += $products['quantity'] * $products[0]['proPrice'];
					}
				?>
				<tr>
						<th></th>
						<th></th>
						<th></th>
						<th><?= $total ?></th>
						<th></th>
					</tr>
				</tbody>
			</table>
			<a class="btn btn-default" href="index.php?controller=basket&action=formDelivery">Passer la commande</a>
			<?php
			}else{
				echo 'Le panier est actuellement vide.';
			}
			?>
		</div>
	</div>
</div>
