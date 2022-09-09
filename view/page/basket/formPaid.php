<div class="container">
	<h2>Choisir un moyen de paiement</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=formAddress">
                <div class="form-group">
					<input name="paidMethod" type="radio" class="" id="invoice" value="Sur facture" />
					<label for="invoice">Sur facture (+ CHF 2.-)</label>
                </div>
				<div class="form-group">
					<input name="paidMethod" type="radio" class="" id="advance" value="Paiement par avance" />
					<label for="advance">Paiement par avance</label>
				</div>
                <div class="form-group">
					<input name="paidMethod" type="radio" class="" id="card" value="Carte de crédit (+ 2%)" />
					<label for="card">Carte de crédit (+ 2%)</label>
				</div>
				<button type="submit" class="btn btn-default">Suivant</button>
			</form>
		</div>
	</div>
</div>