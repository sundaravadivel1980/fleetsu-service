<?php
namespace src\fleetsuservice\v1 {

	use Tonic\ConditionException;
	use Tonic\Application;

	use src\Logger\Logger;

	use \Tonic\Request,
	\Tonic\Response,
	\src\DBO\ServiceDBO;

		
	/**
	 * This for PW claim photo ID service
	 * @author sundar
	 * @uri fleetsuservice/v1/listDevice
	 */
	class listDevice extends BaseResource {
	
		/**
		 * @method GET
		 * @return \src\fleetsuservice\v1\BaseResponse
		 * @isfromlocalhost
		 */
		public function get() {
			try {
				return $this->_get();
			} catch(\Exception $e) {
				Logger::log($e->getMessage(),"CRIT");		
				throw $e;
			}
		}
		
		private function _get(){
			$response = new Response();
			$response->contentType = 'application/json';
			$result = null;
			$dbo = new ServiceDBO($this->_db->getDbh());
			$result = $dbo->getDeviceList();
			$response->code = Response::OK;
			$response->body = $result;
			return $response;
		}
	}
}