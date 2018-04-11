<?php
	// Fichiers nécessaires
	include('includes/haut.inc.php'); // En-tête du site
	include('includes/connexion.inc.php'); // Connexion à la BD
	include('includes/verif_util.inc.php'); // Vérification si un utilisateur est connecté (cookie)
?>
<br>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <span class="name">Le fil</span>
                        <hr class="star-light">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Section -->
    <section>
        <div class="container">
            <div class="row">
				<!-- Formulaire pour l'ajout/modification/suppresion des messages sur le blog -->
                <form method="POST" action="article.php<?php if(isset($_GET['id'])) echo "?a=upd&id=".$_GET['id']; // nécessaire pour la modification ?>">
                    <!-- TEXTAREA pour le message à poster -->
					<div class="col-sm-10">
                        <div class="form-group">
							<!-- le textarea est sur la même ligne pour éviter des espaces sur la page -->
							<textarea id="message" name="message" class="form-control" placeholder="Message"><?php if(isset($_GET['id'])) { $sql="SELECT contenu FROM messages WHERE id=:id";$prep=$pdo->prepare($sql);$prep->bindValue(':id',$_GET['id']);$prep->execute();$data=$prep->fetch();echo $data['contenu']; } // on réaffiche le message à modifier ?></textarea>
                        </div>
                    </div>
					<!-- BOUTON pour soumettre le formulaire -->
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-lg" <?php if(!$connect_util) echo "disabled"; // si pas d'utilisateur connecté on désactive le bouton "Envoyer" ?>>
							<?php if(isset($_GET['id'])) { // si utilisateur connecté on modifie la "value" du bouton ?>
							Modifier
							<?php } else { ?>
							Envoyer
							<?php } ?>
						</button>
                    </div>
                </form>
				<!-- FIN Formulaire -->
            </div>

            <div class="row">
                <div class="col-md-12">
					<?php
						// Sytème de pagination
						$page = (!empty($_GET['page']) ? $_GET['page'] : 1); // on définit à 1 est la page par défaut
						$limite = 5; // limite de message par pages
						$debut = ($page - 1) * $limite; // calcul du numéro du premier enregistrement à afficher pour chaque page
						$sql="SELECT SQL_CALC_FOUND_ROWS * FROM messages ORDER BY date DESC LIMIT :limite OFFSET :debut"; // SQL_CALC_FOUND_ROWS mot-clé qui permet de compter le nombre total de messages
						$prep = $pdo->prepare($sql);
						$prep->bindValue(':limite', $limite, PDO::PARAM_INT);
						$prep->bindValue(':debut', $debut, PDO::PARAM_INT);
						$prep->execute();

						$resultFoundRows = $pdo->query('SELECT found_rows()'); // on récupère le compte de SQL_CALC_FOUND_ROWS de la requête plus haut
						$nombredElementsTotal = $resultFoundRows->fetchColumn(); // on affecte ce résultat à une variable

						$regex = array('/https?:\/\/([a-zA-Z0-9.]+)\/?.*?[^\/\s]*(\s|$)/' => '<a href="$0" target="_blank">$0</a>',
									'/[a-zA-Z0-9_\.-]+@([a-zA-Z0-9\.-]+)/' => '<a href="mailto:$0">$0</a>');
						while($data=$prep->fetch()) { // Boucle
							$lien = preg_replace(array_keys($regex), array_values($regex), $data['contenu']);
					?>
					<!-- Affichage des messages contenus dans la BD -->
					<blockquote>
						<p><?= $lien ?></p>
						<footer><?= date('d/m/Y H:i:s', $data['date']) ?></footer>
						<p>J'aime: <?= $data['votes'] ?></p>
          </blockquote>
					<?php
							if($connect_util) { // Si un utilisateur connecté on affiche des boutons de gestion pour chacun des messages
					?>
					<a href="index.php?id=<?= $data['id'] ?>" class="btn btn-primary btn-xs">Modifier</a>
					<a href="article.php?a=del&id=<?= $data['id'] ?>" class="btn btn-danger btn-xs">Supprimer</a>
					<a href="libs/jaime.php?votes=<?= $data['votes'] ?>&id=<?= $data['id'] ?>" class="plus" data-id="<?= $data['id'] ?>" class="btn btn-info btn-xs">+1</a>
					<?php
							} // FIN Si
					?>
					<hr>
					<?php
						} // FIN Boucle
					?>
                </div>
            </div>
			<div class="row" align="center">
				<!-- Affichage des liens pour la pagination du type ((Page précédente 1 2 3 ... Page suivante)) -->
				<?php
					$nombreDePages = ceil($nombredElementsTotal / $limite);

					if($page>1) {
				?>
				<a href="index.php?page=<?= $page-1; ?>">Page précédente</a> —
				<?php
					}
					for($i=1; $i<=$nombreDePages; $i++) {
				?>
				<a href="index.php?page=<?= $i; ?>"><?= $i; ?></a>
				<?php
					}
					if($page<$nombreDePages) {
				?>
				— <a href="index.php?page=<?= $page+1; ?>">Page suivante</a>
				<?php
					}
				?>
			</div>
        </div>
    </section>
<?php
	include('includes/bas.inc.php');
?>
