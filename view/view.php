<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php echo $pagetitle; ?>
        </title>
        <link rel="icon" type="image/png" href="image/icone.png" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/perso.css" rel="stylesheet">

    </head>
    
    <body style="margin-bottom:51px; background-color:#14213D; color:orange;">
<header>
        <nav class="navbar navbar-inverse" style="margin-bottom:0px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" style="width:50px;padding:0px;"><img alt="Brand" src="image/icone.png" style="width:90%;margin-top:2px;"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="index.php">Liste des produits</a></li>
                        <li><a href="index.php?action=readAll&controller=utilisateur">Liste des utilisateurs</a></li>
                        <?php
                        $method = 'post';
                        if(Conf::getDebug()) {
                          $method = 'get';
                        }
                        require_once File::build_path(array('lib', 'Session.php'));
                        if (Session::isAdmin()) {
                            echo <<<EOT
                            <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrateur<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="index.php?action=create&controller=produit">Ajouter un produit</a></li>
                                <li><a href="index.php?action=create&controller=utilisateur">Ajouter un utilisateur</a></li>
                                <li><a href="index.php?action=readAll&controller=commande">Voir la liste des commandes</a></li>
                            </ul>
EOT;
                        }
                        ?>
                    </ul>
                    <form method="<?php echo "$method"; ?>" class="navbar-form navbar-left" role="search" action="index.php" style="margin-left:15%;">
                        <div class="form-group">
                            <input type="hidden" name="action" value="search">
                            <input type="hidden" name="controller" value="produit">
                            <input type="text" class="form-control" placeholder="Rechercher un produit" name="libelle" id ="libelle_id" required>
                        </div>
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                    <?php
                    if (isset($_SESSION)) {
                        if (!isset($_SESSION['login'])) {
                            echo <<<EOT
                            <ul class="nav nav-pills navbar-right">
                                <li><a href="index.php?action=afficherPanier&controller=panier" style="padding-top:15px;padding-bottom:15px;"><span class="glyphicon glyphicon-shopping-cart"></span> Panier</a></li>
                                <li><a href="index.php?action=create&controller=utilisateur" style="padding-top:15px;padding-bottom:15px;"><span class="glyphicon glyphicon-user"></span> Créer un compte</a></li>
                                <li><a href="index.php?action=connect&controller=utilisateur" style="padding-top:15px;padding-bottom:15px;"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
                            </ul>
EOT;
                        } else {
                            $tmp = $_SESSION['login'];
                            echo <<<EOT
                            <ul class="nav nav-pills navbar-right">
                                <li><a href="index.php?action=afficherPanier&controller=panier" style="padding-top:15px;padding-bottom:15px;"><span class="glyphicon glyphicon-shopping-cart"></span> Panier</a></li>
                                <li><a href="index.php?action=read&controller=utilisateur&login=$tmp" style="padding-top:15px;padding-bottom:15px;"><span class="glyphicon glyphicon-user"></span> Mon compte</a></li>
                                <li><a href="index.php?action=deconnect&controller=utilisateur" style="padding-top:15px;padding-bottom:15px;"><span class="glyphicon glyphicon-remove"></span>Se déconnecter</a></li>

                            </ul>
EOT;
                        }
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>
        <!-- ********************SLIDER******************** -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner th" role="listbox" style="max-height:300px;">
                <div class="item active">
                    <img src="image/slider/ExcaliburSlider.png" alt="Excalibur" style="margin:auto;">
                    <div class="carousel-caption">
                        <h3 style="margin-bottom:3%;">Excalibur</h3>
                        <a href="index.php?action=readAll">Voir tous les produits</a>
                    </div>      
                </div>

                <div class="item">
                    <img src="image/slider/DentierDeGeorgeWashingtonSlider.png" alt="DentierGW" style="margin:auto;">
                    <div class="carousel-caption">
                        <h3 style="margin-bottom:3%;">Dentier de George Washington</h3>
                        <a href="index.php?action=readAll">Voir tous les produits</a>
                    </div> 
                </div>

                <div class="item">
                    <img src="image/slider/MarteauDeThorSlider.png" alt="MarteauThor" style="margin:auto;">
                    <div class="carousel-caption">
                        <h3 style="margin-bottom:3%;">Marteau de Thor</h3>
                        <a href="index.php?action=readAll">Voir tous les produits</a>
                    </div> 
                </div>

                <div class="item">
                    <img src="image/slider/TridentDePoseidonSlider.png" alt="TridentPoseidon" style="margin:auto;">
                    <div class="carousel-caption">
                        <h3 style="margin-bottom:3%;">Trident de Poséidon</h3>
                        <a href="index.php?action=readAll">Voir tous les produits</a>
                    </div> 
                </div>
            </div>


            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
        $filepath = File::build_path(array("view", static::$controller,"$view.php"));
        require $filepath;
        ?>
        <footer class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container" style="text-align: center;">
                Copyright
            </div>
         </footer>
    </body>

    
</html>
