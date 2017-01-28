<?php
$method = 'post';
if(Conf::getDebug()) {
    $method = 'get';
}

?>
    <div class="container">
        <div class="card card-container col-sm-8" style="margin-left:18%; margin-right:18%;">
            <img id="profile-img" class="profile-img-card th" style="max-width:200px; width:40%; margin:5% 35%;" alt⁼"imageProduit" src="image/icone.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="<?php echo "$method";?>" action="index.php">
                    <legend class="col-sm-12" style="text-align:center; color : orange;">Identifiez-vous</legend>
                    <input type="hidden" name="action" value="connected">
                    <input type="hidden" name="controller" value="utilisateur">
                    <p>
                        <input type="text" id="inputText" class="form-control" placeholder="Login" name="login" required autofocus>
                    </p>
                    <p>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required />
                    </p>
                    <p>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Envoyer</button>
                    </p>
            </form>
        </div>
    </div>
