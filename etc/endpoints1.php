<?php

const DS = "/";

class endPoints1 {

	private static $_instance;
	
	public static function getInstance() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}		
		return self::$_instance;
	}

	private function readEndPoints(){
		return getenv('NGE_ENV');
	}
	public function getEndPoints(){
		echo $endPointFileName = $this->readEndPoints();
	}
}

?>