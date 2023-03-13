<?php 

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function($class)
		{
			$filename = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

            $file = __DIR__ . DIRECTORY_SEPARATOR . $filename;

            if (!file_exists($file)) {
				return false;
			}

			require_once $file;
		});
    }
}
