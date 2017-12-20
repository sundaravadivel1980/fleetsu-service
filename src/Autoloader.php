<?php

namespace src;

/**
 * Autoload
 */
class Autoloader {
	
    /**
     * Handles autoloading of classes
     * @param string $className Name of the class to load
     */
    static public function autoload($className) {
		$className = ltrim($className, '\\');
	    $fileName  = '';
	    $namespace = '';
	    if ($lastNsPos = strrpos($className, '\\')) {
	        $namespace = substr($className, 0, $lastNsPos);
	        $className = substr($className, $lastNsPos + 1);
	        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	    }
	    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		if(!file_exists($fileName)) {
			return false;
		}
	    require $fileName;
    }

}

spl_autoload_register(array(new Autoloader, 'autoload'));