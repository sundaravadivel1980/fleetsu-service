<?php
namespace src\DBO {
	use \PDO, \PDOException, src\Logger\Logger, src\endpoints;

	class ServiceDBO {
	
		const QUERY_LOADALL_DEVICELIST = 'SELECT device_id, device_label, device_reported_datetime, device_status FROM devices';
		
		private $_dbh;

		public function __construct($dbh) {
			$this->_dbh = $dbh;
		}
		
		public function getDeviceList(){
			$stm = $this->_dbh->prepare(self::QUERY_LOADALL_DEVICELIST);
			$stm->execute();
			Logger::log("Query Executed","DEBUG");
			return $stm->fetchAll(PDO::FETCH_CLASS);
		}
		
	}
}