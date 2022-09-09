<?php 
echo '<pre>' , var_dump($_SESSION) , '</pre>';

?>
<div class="container">
	<h2>Récapitulatif</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table">
				<thead>
					<tr>
						<?php
						echo '<th>Envoyé à :</th>';
						echo '<th>Livraison : ' . $_SESSION['delivery'] . '</th>';
						echo '<th>Paiement : ' . $_SESSION['paid'] . '</th>';
						?>
					</tr>
				</thead>
				<tbody>
					<tr><th><?= $_SESSION['address']['title']?></th></tr>
					<tr><th><?= $_SESSION['address']['firstName'] . ' ' . $_SESSION['address']['name']?></th></tr>
					<tr><th><?= $_SESSION['address']['street'] . ' ' . $_SESSION['address']['number']?></th></tr>
					<tr><th><?= $_SESSION['address']['npa'] . ' ' . $_SESSION['address']['locality']?></th></tr>
				</tbody>
			</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Description</th>
						<th>Prix</th>
						<th>Quantité</th>
						<th>Sous-total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$total = 0;
                //var_dump($_SESSION['basket']);
					foreach ($_SESSION['basket'] as $products) {
					//var_dump($products);
						echo '<tr>';
							echo '<td>' . $products[0]['proName'] . '</td>';
							echo '<td>CHF ' . number_format($products[0]['proPrice'], 2) . '</td>';
							echo '<td>' . $products['quantity'] . '</td>';
							echo '<td>CHF ' . number_format($products['quantity'] * $products[0]['proPrice'], 2) . '</td>';
                        echo '</tr>';
						$total += $products['quantity'] * $products[0]['proPrice'];
					}
                    if ($_SESSION['delivery'] == 'Par la poste') {
                        echo '<tr>';
							echo '<td>' . $_SESSION['delivery'] . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF 7.95</td>';
                        echo '</tr>';
                        $total += 7.95;
                        $poste = $total;
                        echo '<tr>';
							echo '<td>Total</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($total, 2) .'</td>';
                        echo '</tr>';
                    }
                    if ($_SESSION['paid'] == 'Sur facture') {
                        echo '<tr>';
							echo '<td>' . $_SESSION['paid'] . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF 2</td>';
                        echo '</tr>';
                        $total += 2;
                    }else if($_SESSION['paid'] == 'Carte de crédit (+ 2%)'){
                        $credit = 2 * $total / 100;
                        echo '<tr>';
                            echo '<td>' . $_SESSION['paid'] . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($credit, 2) . '</td>';
                        echo '</tr>';
                        $total += number_format($credit, 2);
                    }
				?>
				<tr>
						<th>Total à payer</th>
						<th></th>
						<th></th>
						<th>CHF <?= number_format($total, 2) ?></th>
					</tr>
				</tbody>
			</table>
			<a class="btn btn-default" href="index.php?controller=basket&action=confirmOrder">Envoyer la commande</a>
		</div>
	</div>
</div>
