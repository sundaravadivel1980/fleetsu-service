<?php
namespace src\logger {
use src\endpoints;
	class Logger {
		const INFO = 'INFO';
		const ERROR = 'ERROR';

		private static $instance;
		private $config = array();
		private $verboseLevel = 0;

		private function __construct()
		{
			$this->verboseLevel =  endPoints::getInstance()->getEndPoints('logs.verbose');
			$this->config = BASE . DS . endPoints::getInstance()->getEndPoints('logs.filepath');;
		}

		private static function getInstance()
		{
			if(!self::$instance)
			{
				self::$instance = new Logger();
			}
			return self::$instance;
		}

		private function writeToFile($message, $level)
		{
			$logError = false;
			if($this->verboseLevel != 0){
				if($this->verboseLevel == 1 && $level == 'CRIT') {
					$logError = true;
				} 
				else if($this->verboseLevel == 2 && ($level == 'CRIT' || $level == 'ERR' )){
					$logError = true;
				}
				else if($this->verboseLevel == 3 && ($level == 'CRIT' || $level == 'ERR' || $level == 'WARN')){
					$logError = true;
				}
				else if($this->verboseLevel == 4 && ($level == 'CRIT' || $level == 'ERR' || $level == 'WARN' || $level == 'INFO')){
					$logError = true;
				}
				else if($this->verboseLevel == 5 && ($level == 'CRIT' || $level == 'ERR' || $level == 'WARN' || $level == 'INFO' || $level == 'DEBUG')){
					$logError = true;
					//$message .= $this->generateCallTrace();
				} 
				else { $logError = false; }
				if($logError){
					file_put_contents($this->config, "$message\n", FILE_APPEND);
				}
			}
		}

		public static function log($message, $level = Logger::INFO, $errorNo = "00000")
		{
			$date = date('Y-m-d H:i:s');
			$severity = "[$level]";
			$message = "$date $severity [$errorNo] ::$message";
			self::getInstance()->writeToFile($message, $level);
		}
		
		/*private static function generateCallTrace()
		{
			$e = new Exception();
			$trace = explode("\n", $e->getTraceAsString());
			// reverse array to make steps line up chronologically
			$trace = array_reverse($trace);
			array_shift($trace); // remove {main}
			array_pop($trace); // remove call to this method
			$length = count($trace);
			$result = array();
			
			for ($i = 0; $i < $length; $i++)
			{
				$result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
			}
			
			return "\t" . implode("\n\t", $result);
		}*/
	}
}
//config.php
/*return array(
    'log_file' => '/tmp/my_log.txt'
);*/

//Logger::log($message);