<?php
namespace src\DBO {
	use \PDO, \PDOException, src\Logger\Logger, src\endpoints;

	class DB {
		/**
		 * PDO Handler
		 *
		 * @var PDO
		 */
		protected $_dbh;
		
		public function __construct() {
			Logger::log("Construct of DB","DEBUG");
			$host = endPoints::getInstance()->getEndPoints('db.host');
			$user = endPoints::getInstance()->getEndPoints('db.user');
			$pass = endPoints::getInstance()->getEndPoints('db.pass');
			$dbname = endPoints::getInstance()->getEndPoints('db.name');

			try {
				Logger::log("Construct of DB connected","DEBUG");
				$this->_dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			} catch(PDOException $e) {
			
				throw $e;
			}
			
			$this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		public function getDbh() {
			return $this->_dbh;
		}
	}
}