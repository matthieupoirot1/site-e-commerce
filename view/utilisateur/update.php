<?php
if($type=='update'){
    $html_l = htmlspecialchars($u->getLogin());
    $html_n = htmlspecialchars($u->getNom());
    $html_p = htmlspecialchars($u->getPrenom());
    $html_m = htmlspecialchars($u->getMail());
    $prochaine_action="updated";
    $legend = "Modifier vos données";
}
else if($type=='create') {
    $html_l="";
    $html_n="";
    $html_p="";
    $html_m="";
    $html_pwd="";
    $prochaine_action = "created";
    $legend = "Créer un compte";
}
$method = 'post';
if(Conf::getDebug()) {
    $method = 'get';
}

?>
 <div class="container">
        <div class="card card-container col-sm-8" style="margin-left:18%; margin-right:18%;">
            <img id="profile-img" class="profile-img-card th" style="max-width:200px; width:40%; margin:5% 35%;" src="image/icone.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="<?php $method?>" action="index.php">
                <fieldset>
                    <legend class="col-sm-12" style="text-align:center; color : orange;"><?php echo "$legend"?></legend>
                    <input type="hidden" name="action" value="<?php echo $prochaine_action;?>">
                    <input type="hidden" name="controller" value="utilisateur">
                    <p style="position:relative; margin: 1.3% 10%;">
                        <input type="text" class="form-control" id="inputText" placeholder="Login" value="<?php echo $html_l;?>" name="login" required <?php if($type == "update"){echo "readonly";}?>/>
                    </p>
            
                    <p style="position:relative; margin: 1.3% 10%;">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="mdp"<?php if($type=="create"){echo "required";}?>/>
                    </p>
            
                    <p style="position:relative; margin: 1.3% 10%;">
                        <input type="text" class="form-control" id="inputText" placeholder="Nom" value="<?php echo $html_n;?>" name="nom" required/>
                    </p>
            
                    <p style="position:relative; margin: 1.3% 10%;">
                        <input type="text" class="form-control" id="inputText" placeholder="Prénom" value="<?php echo $html_p;?>" name="prenom" required/>
                    </p>
            
                    <p style="position:relative; margin: 1.3% 10%;">
                        <input type="email" class="form-control" placeholder="Email" value="<?php echo $html_m;?>" name="mail" required/>
                    </p>
                    <?php 
                        if($type=='update' && Session::isAdmin()) {
                            echo <<<EOT
                            <p style="position:relative; margin: 1.3% 10%;">
                                <label style="margin-left:46%;" for="admin_id">Admin :</label>
                                <input type="checkbox" class="form-control" id="inputCheckBox" name="admin"/>
                            </p>
EOT;
                        }
                    ?>
                    <p style="position:relative; margin: 1.3% 10%;">
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Envoyer</button>
                    </p>
            
                </fieldset>
            </form>
        </div>
    </div>
