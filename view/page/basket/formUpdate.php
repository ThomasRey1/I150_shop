<div class="container">

	<h2>Ajouter un article</h2>
	<!-- modify the quantity of a product -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=update&id=<?php echo $id; ?>">
                <div class="form-group">
                <?php
                    echo '<p>Encore : ' . $_SESSION['basket'][$id][0]['proQuantity'] . ' en stock</p>';
                ?>
                </div>
				<div class="form-group">
					<label for="basketQuantity">Quantité</label>
					<input name="basketQuantity" type="text" class="form-control" id="basketQuantity" value="<?= $_SESSION['basket'][$id]['quantity']; ?>" />
				</div>
				<button type="submit" class="btn btn-default">Enregistrer</button>
			</form>
		</div>
	</div>
</div>
