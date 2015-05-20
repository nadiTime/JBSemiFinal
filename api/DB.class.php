<?php          //singleton
	class DB {
		private static $instance = NULL;

		public static function getInstance(){
			if(!self::$instance){
				self::$instance = new mysqli("localhost","root","","jbsemifinal");
			}
			return self::$instance;
		}

		private function __construct(){}
	}
	

	