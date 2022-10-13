<?php 

	class ParentClass
	{
		protected $mysqli;

		public function __construct($server, $userid, $pwd, $db )
		{
			$this->mysqli = new mysqli($server, $userid, $pwd, $db);
		}

		function __destruct()
		{
			$this->mysqli->close();
		}
	}	

 ?>