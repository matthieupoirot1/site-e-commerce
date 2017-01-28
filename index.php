<?php
session_start();
setcookie(session_name(),'',time()+3600); 
$DS = DIRECTORY_SEPARATOR;
require_once __DIR__."$DS"."lib"."$DS"."File.php";
require_once (File::build_path(array("controller","routeur.php")));
require_once (File::build_path(array("lib","Session.php")));
