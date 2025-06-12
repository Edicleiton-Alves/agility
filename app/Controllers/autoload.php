<?php
spl_autoload_register(function ($class) {
	$class = explode('\\', $class);
	$path = PATH[$class[0]];
	$fileName = $class[1];

    $file = "$path/$fileName.class.php";

    if (file_exists($file)) {
        require_once $file;
    }
});