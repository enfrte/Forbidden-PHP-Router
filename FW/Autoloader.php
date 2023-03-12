<?php 

//namespace FW;

class Autoloader
{
    protected static $paths = [];

    public static function register(string $dir_path, array $paths)
    {
		foreach ($paths as $key => $path) {
			$optionalDirSeparator = $path[0] !== '/' ? '/' : '';
			$paths[$key] = $dir_path.$optionalDirSeparator.$path;
		}
        self::$paths = $paths;
        spl_autoload_register([__CLASS__, 'loadClass']);
    }

    protected static function loadClass($class)
    {
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

        foreach (self::$paths as $path) {
            $file = $path . DIRECTORY_SEPARATOR . $filename;
            if (file_exists($file)) {
                require_once $file;
                return true;
            }
        }

        return false;
    }
}
