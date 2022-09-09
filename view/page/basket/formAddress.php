<div class="container">
	<h2>Adresse d'envoi</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=sendOrder">
                <div class="form-group">
					<input name="title" type="text" class="form-control" id="addressTitle" placeholder="Titre"/>
				</div>
                <div class="form-group">
					<input name="name" type="text" class="form-control" id="addressName" placeholder="Nom"/>
				</div>
                <div class="form-group">
					<input name="firstName" type="text" class="form-control" id="addressFirstname" placeholder="Prénom"/>
				</div>
                <div class="form-group">
					<input name="street" type="text" class="form-control" id="addressStreet" placeholder="Rue"/>
				</div>
                <div class="form-group">
					<input name="number" type="text" class="form-control" id="addressNumber" placeholder="N°"/>
				</div>
                <div class="form-group">
					<input name="npa" type="text" class="form-control" id="addressNPA" placeholder="NPA"/>
				</div>
                <div class="form-group">
					<input name="locality" type="text" class="form-control" id="addressLocality" placeholder="Localité"/>
				</div>
                <div class="form-group">
					<input name="mail" type="text" class="form-control" id="addressMail" placeholder="Adresse mail"/>
				</div>
                <div class="form-group">
					<input name="phone" type="text" class="form-control" id="addressPhone" placeholder="Téléphone"/>
				</div>
				<button type="submit" class="btn btn-default">Suivant</button>
			</form>
		</div>
	</div>
</div>