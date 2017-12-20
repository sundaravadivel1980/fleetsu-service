<?php
define('BASE', __DIR__);
define('DS', DIRECTORY_SEPARATOR);
use Tonic\NotFoundException, Tonic\Response;
//require_once "src/endpoints.php";
require_once 'lib/Tonic/Autoloader.php';
require_once "src/Autoloader.php";

use src\Logger\Logger;
function my_autoload($class123){
	echo "here";
}
spl_autoload_register('my_autoload');
//print_r($_SERVER['REQUEST_URI']);

$config = array(
	'load' => array('src/fleetsuservice/v1/*.php'), // look for resource classes in here
);

$app = new Tonic\Application($config);
$request = new Tonic\Request();

if($request->method == 'OPTIONS'){
	//$request->method = 'POST';
	$response = new Response();
	$response->code = Response::OK;
	$response->body = "verified";
	return $response;
}
/*if(getallheaders()['source-appl-id'] <> '23'){
	$response = new Response();
	$response->contentType = 'application/json';
	$response->code = Response::METHODNOTALLOWED;
	$response->body = "This request not accepted by server";
	return $response;
}*/
if (in_array(current(explode(';', strtolower($request->contentType))), array('application/json', 'text/json'))) {
	$request->data = json_decode($request->data == '' ? NULL : $request->data);
}
//Logger::log(print_r($request),"DEBUG");
try {
	$resource = $app->getResource($request);
	$response = $resource->exec();
} catch(NotFoundException $e) {
	Logger::log($e->getMessage(),"DEBUG");
	$response = new Response(Response::NOTFOUND, $e->getMessage());
}catch(MethodNotAllowedException $e) {
	Logger::log($e->getMessage(),"WARN");
	$response = new Response(Response::METHODNOTALLOWED, $e->getMessage());
} catch(Exception $e) {
	Logger::log($e->getMessage(),"ERR","123456");	
	$response = new Response(Response::INTERNALSERVERERROR, $e->getMessage());
}

// encode output
if ($response->contentType == 'application/json') {
	$response->body = json_encode($response->body);
}

$response->output();
//use src\enpoints\endPoints;

/*spl_autoload_register( function ($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    echo $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
});

//$main = new \src\logger\Logger();  //Instantiates your 'Main' controller
Logger::log("sundar123","CRIT");
Logger::log("sundar123","ERR");
Logger::log("sundar123","WARN");
Logger::log("sundar123","INFO");
Logger::log("sundar123","DEBUG");*/

//endPoints::getInstance()->getEndPoints();

//Logger::getInstance()->log("Log here");

?>