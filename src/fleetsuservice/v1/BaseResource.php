<?php
namespace src\fleetsuservice\v1 {
	use Tonic\Request,
	Tonic\Application,
	src\DBO\DB,
	Tonic\Resource;

	class BaseResource extends Resource {
		
		/**
		 * 
		 * @var DB
		 */
		protected $_db;
		
		/**
		 * 
		 * @var Config
		 */
		protected $_config;
		
		public function __construct(Application $app, Request $request, array $urlParams) {
			parent::__construct($app, $request, $urlParams);
			
			//$this->_config = Config::getInstance();
			$this->_db = new DB();
		}
		
		public function _checkSourceId(){
			if(getallheaders()['source-appl-id'] <> '23'){
				return false;
			} else {
				return true;
			}
		}
		
	}

}