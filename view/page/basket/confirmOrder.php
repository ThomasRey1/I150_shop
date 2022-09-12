<div class="container">
	<h2>Confirmation de commande - Merci de votre achat: Num. <?= $_SESSION['paid'] ?></h2>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- info perso -->
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
					<tr><th><?= $_SESSION['address']['title']?><br>
					<?= $_SESSION['address']['firstName'] . ' ' . $_SESSION['address']['name']?><br>
					<?= $_SESSION['address']['street'] . ' ' . $_SESSION['address']['number']?><br>
					<?= $_SESSION['address']['npa'] . ' ' . $_SESSION['address']['locality']?></th></tr>
				</tbody>
			</table>
			<!-- Total -->
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
					# Panier
					foreach ($_SESSION['basket'] as $products) {
						echo '<tr>';
							echo '<td>' . $products[0]['proName'] . '</td>';
							echo '<td>CHF ' . number_format($products[0]['proPrice'], 2) . '</td>';
							echo '<td>' . $products['quantity'] . '</td>';
							echo '<td>CHF ' . number_format($products['quantity'] * $products[0]['proPrice'], 2) . '</td>';
                        echo '</tr>';
						$total += $products['quantity'] * $products[0]['proPrice'];
					}
					# Moyen de livraison
					if ($delivery[0]['delType'] != NULL) {
						if ($delivery[0]['delType'] == "CHF") {
							echo '<tr>';
								echo '<td>' . $_SESSION['delivery'] . '</td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td>CHF ' . number_format($delivery[0]['delExtra'], 2) . '</td>';
							echo '</tr>';
							$total += $delivery[0]['delExtra'];
						}elseif ($delivery[0]['delType'] == "%") {
							$credit = $delivery[0]['delExtra'] * $total / 100;
							echo '<tr>';
								echo '<td>' . $_SESSION['paid'] . ' (+ ' . $delivery[0]['delExtra'] . '%)</td>';
								echo '<td></td>';
								echo '<td></td>';
								echo '<td>CHF ' . number_format($credit, 2) . '</td>';
							echo '</tr>';
                        $total += number_format($credit, 2);
						}
						echo '<tr>';
							echo '<td>Total</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($total, 2) .'</td>';
                        echo '</tr>';
					}
                    /*if ($_SESSION['delivery'] == 'Par la poste') {
                        echo '<tr>';
							echo '<td>' . $_SESSION['delivery'] . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF 7.95</td>';
                        echo '</tr>';
                        $total += 7.95;
                        echo '<tr>';
							echo '<td>Total</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($total, 2) .'</td>';
                        echo '</tr>';
                    }*/
					# Moyen de payement
					if ($paid[0]['paiType'] == "CHF") {
						echo '<tr>';
							echo '<td>' . $_SESSION['paid'] . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($paid[0]['paiExtra'], 2) . '</td>';
                        echo '</tr>';
						$total += $paid[0]['paiExtra'];
					}elseif ($paid[0]['paiType'] == "%") {
						$credit = $paid[0]['paiExtra'] * $total / 100;
                        echo '<tr>';
                            echo '<td>' . $_SESSION['paid'] . ' (+ ' . $paid[0]['paiExtra'] . '%)</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($credit, 2) . '</td>';
                        echo '</tr>';
                        $total += number_format($credit, 2);
					}
                    /*if ($_SESSION['paid'] == 'Sur facture') {
                        echo '<tr>';
							echo '<td>' . $_SESSION['paid'] . '</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF 2</td>';
                        echo '</tr>';
                        $total += $paid['paiExtra'];
                    }else if($_SESSION['paid'] == 'Carte de crédit'){
                        $credit = 2 * $total / 100;
                        echo '<tr>';
                            echo '<td>' . $_SESSION['paid'] . ' (+ 2%)</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '<td>CHF ' . number_format($credit, 2) . '</td>';
                        echo '</tr>';
                        $total += number_format($credit, 2);
                    }*/
				?>
				<tr>
						<th>Total à payer</th>
						<th></th>
						<th></th>
						<th>CHF <?= number_format($total, 2) ?></th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
