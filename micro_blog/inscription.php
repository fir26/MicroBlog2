<?php
	include("includes/connexion.inc.php");
?>


<?php
	// VERIFICATION FORMULAIRE REMPLI ET CASE COCHER
	if(isset($_POST['email']) && isset($_POST['checkbox'])) {
		// VERIFICATION NOMBRE DE LIGNE POUR EMAIL DANS FORMULAIRE AFIN D'EVITER DOUBLON
		$stmt = $pdo->prepare('SELECT COUNT(*) FROM utilisateurs WHERE email = ?');
		$stmt->execute(array($_POST['email']));
			if ($stmt->fetchColumn() != 0) {
				// JE N'AI PAS REUSSI A BIEN FAIRE FONCTIONNER LES ALERTES
				// DONC J'AI UTILISE UN SIMPLE ECHO POUR PREVENIR L'UTILISATEUR
				echo "Email déjà inscrit (Vous allez être redirigé...)";
				// ET UNE REDIRECTION
				echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>";
			}else{
				//REQUETE INSERTION SI AUCUN DOUBLON TROUVER
				$sql="INSERT INTO utilisateurs (email,mdp) VALUES (:email,:mdp)";
				$prep=$pdo->prepare($sql);
				$prep->bindValue(':email',$_POST['email']);
				$prep->bindValue(':mdp',md5($_POST['password']));
				$prep->execute();


			header("location:index.php");
		}
	}
	else {
		include("includes/haut.inc.php");
?>
<br><br><br><br><br><br>
<section>
	<div class="container">
		<p>Inscription:</p>
		<form class="form-horizontal" action="inscription.php" method="POST">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="checkbox"> Valider Inscription </input>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" value="Inscription">
				</div>
			</div>
		</form>
	</div>
</section>
<?php
		include("includes/bas.inc.php");
	}
?>
