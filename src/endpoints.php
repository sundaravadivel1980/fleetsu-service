<?php
namespace src {
	class endPoints {

		private static $_instance;
		private $_conf;
		
		private function __construct() {
			$this->_conf = $this->readEndPoints();
		}
		
		public static function getInstance() {
			if(is_null(self::$_instance)) {
				self::$_instance = new self();
			}		
			return self::$_instance;
		}

		private function readEndPoints(){
			$env = getenv('NGE_ENV');
			$fileName = sprintf("post" . DS . "endpoints-%s.config.php", $env);
			if(file_exists($fileName)) {
				require($fileName);
				return $endpoints;
			} else {
				die(sprintf("Couldn't read endpoints file %s [NGE_ENV=%s]", $fileName, $env));
			}
		}
		public function getEndPoints($key){
			$parts = preg_split('/\./', $key);
			$res = $this->_conf;
			while ($curr = current($parts)) {
				if(!key_exists($curr, $res)){
					return null;
				}
					
				$res = $res[$curr];
					
				next($parts);
			}		
			if(!is_string($res)) {
				return $res;
			}
			return @vsprintf($res, array_values($params));
		}
	}
}
?>