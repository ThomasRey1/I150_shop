<div class="container">

	<h2>Choisir un moyen de livraison</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=formPaid">
                <div class="form-group">
					<input name="deliveryMethod" type="radio" class="" id="poste" value="Par la poste" />
					<label for="poste">Par la poste ( + CHF 7.95)</label>
                </div>
				<div class="form-group">
					<input name="deliveryMethod" type="radio" class="" id="pickUp" value="Retrait au magasin" />
					<label for="pickUp">Retrait au magasin</label>
				</div>
				<button type="submit" class="btn btn-default">Suivant</button>
			</form>
		</div>
	</div>
</div>