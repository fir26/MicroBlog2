<?php
	include("includes/connexion.inc.php");
?>

<?php
	// VERIFICATION FORMULAIRE REMPLI
	if(isset($_POST['email'])) {
		$sql="SELECT * FROM utilisateurs";
		$stmt=$pdo->query($sql);
		while($data=$stmt->fetch()) {
			if($_POST['email']==$data['email'] && md5($_POST['password'])==$data['mdp']) {
				$sid = md5($_POST['email'].time());

				$sql="UPDATE utilisateurs SET sid=:sid WHERE email=:email";
				$prep=$pdo->prepare($sql);
				$prep->bindValue(':sid',$sid);
				$prep->bindValue(':email',$_POST['email']);
				$prep->execute();

				setcookie("sid", $sid, time()+15*60);
			}
			header("location:index.php");
		}
	}
	else {
		include("includes/haut.inc.php");
?>
    <script>
       /* $(document).ready(function(){
           $("form").submit(function(event){
               $("input").each(function(){
                    var mail = $("#inputEmail3").val().length;
                    var mdp = $("#inputPassword3").val().length;
                    if(mail==0){
                        $("#mail3").attr("class","form-group has-error has-feedback");  
                                 
                    }
                    if(mdp==0){
                        $("#pass3").attr("class","form-group has-error has-feedback");  
                                 
                    }
                   event.preventDefault();
               });
           });
            
        });*/
    </script>

<br><br><br><br><br><br>
<section>
	<div class="container">
		<p>Connexion:</p>
		<form class="form-horizontal" action="connexion.php" method="POST">
			<div id="mail3" class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
				</div>
			</div>
			<div id="pass3" class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember me </input>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" value="Log in">
				</div>
			</div>
		</form>
	</div>
</section>
<?php
		include("includes/bas.inc.php");
	}
?>
