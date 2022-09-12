<div class="container">
	<h2>Adresse d'envoi</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form method="post" enctype="multipart/form-data" action="index.php?controller=basket&action=sendOrder">
                <div class="form-group">
					<select name="title" type="text" class="form-control" id="addressTitle" placeholder="Titre">
						<option value="">--Choisier une option--</option>
						<option value="Madame">Madame</option>
						<option value="Monsieur">Monsieur</option>
					</select>
				</div>
                <div class="form-group">
					<input name="name" type="text" class="form-control" id="addressName" placeholder="Nom" pattern="([A-ZÀ-ÿ][-,a-z. ']+[ ]*)"/>
				</div>
                <div class="form-group">
					<input name="firstName" type="text" class="form-control" id="addressFirstname" placeholder="Prénom" pattern="([A-ZÀ-ÿ][-,a-z. ']+[ ]*)"/>
				</div>
                <div class="form-group">
					<input name="street" type="text" class="form-control" id="addressStreet" placeholder="Rue" pattern="([a-zA-Z\u0080-\u024F]+(?:. |-| |'))*[a-zA-Z\u0080-\u024F]*"/>
				</div>
                <div class="form-group">
					<input name="number" type="number" class="form-control" id="addressNumber" placeholder="N°"/>
				</div>
                <div class="form-group">
					<input name="npa" type="text" class="form-control" id="addressNPA" placeholder="NPA" pattern="[0-9]{4}"/>
				</div>
                <div class="form-group">
					<input name="locality" type="text" class="form-control" id="addressLocality" placeholder="Localité" pattern="([a-zA-Z\u0080-\u024F]+(?:. |-| |'))*[a-zA-Z\u0080-\u024F]*"/>
				</div>
                <div class="form-group">
					<input name="mail" type="email" class="form-control" id="addressMail" placeholder="Adresse@mail.com" pattern="[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$"/>
				</div>
                <div class="form-group">
					<input name="phone" type="tel" class="form-control" id="addressPhone" placeholder="012 345 67 89 ou +41 23 456 78 90" pattern="(?:(?:\+|00)41|0)\s*[1-9]{2}(?:[\s.-]*\d{3})(?:[\s.-]*\d{2}){2}"/>
				</div>
				<button type="submit" class="btn btn-default">Suivant</button>
			</form>
		</div>
	</div>
</div>