<?php

class File {

    public static function build_path($path_array) {
        // $ROOT_FOLDER (sans slash à la fin) vaut
        // "/home/ann2/votre_login/public_html/TD5" à l'IUT
        $DS = DIRECTORY_SEPARATOR;
        $ROOT_FOLDER = __DIR__ . "$DS..";
        return $ROOT_FOLDER . $DS . join($DS, $path_array);
    }

}
