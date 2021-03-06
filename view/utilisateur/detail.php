<?php
require_once File::build_path(array("lib","Session.php"));
$html_l = htmlspecialchars($u->getLogin());
$html_n = htmlspecialchars($u->getNom());
$html_p = htmlspecialchars($u->getPrenom());
$html_m = htmlspecialchars($u->getMail());
$url_l = rawurldecode($u->getLogin());
$u=$u->getLogin(); 
?>

<div class="container" style="margin-top: 5%;">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo "$html_l";?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="image/profile.jpg" class="img-circle img-responsive"> 
                        </div>
                        <div class=" col-md-9 col-lg-9 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Nom :</td>
                                        <td><?php echo"$html_n";?></td>
                                    </tr>
                                    <tr>
                                        <td>Prénom :</td>
                                        <td><?php echo"$html_p";?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><a href="mailto:<?php echo "$html_m"?>"><?php echo "$html_m"?></a></td>
                                    </tr>
                                    <?php 
                                        if(Session::isUser($u)||Session::isAdmin()) {
				                            echo <<<EOT
                                                <tr>
                                                    <td><a href="index.php?action=readAllByUser&controller=commande&login=$">Voir l'historique de vos commandes</a></td>
                                                </tr>
EOT;
    				                    }
    				                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<?php if (Session::isUser($u)){
    echo <<<EOT
        <div class="panel-footer">
            <a data-original-title="Modifier vos informations" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"  href="index.php?action=update&login=$url_l&controller=utilisateur">
                <i class="glyphicon glyphicon-edit"></i>
            </a>
            <span class="pull-right">
                <a data-original-title="Supprimer votre compte" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger" href="index.php?action=delete&login=$url_l&controller=utilisateur">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            </span>
        </div>
EOT;

}
else if (Session::isAdmin()){
    echo <<<EOT
        <div class="panel-footer">
            <a data-original-title="Modifier les informations de cet utilisateur" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"  href="index.php?action=update&login=$url_l&controller=utilisateur">
                <i class="glyphicon glyphicon-edit"></i>
            </a>
            <span class="pull-right">
                <a data-original-title="Supprimer cet utilisateur" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"href="index.php?action=delete&login=$url_l&controller=utilisateur">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            </span>
        </div>
EOT;
}
?>
            </div>
        </div>
    </div>
</div>