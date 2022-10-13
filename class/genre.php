<?php 
require_once('parent.php');

/**
 * 
 */
class Genre extends ParentClass
{
	
	function __construct($server, $userid, $pwd, $db)
	{
		parent::__construct($server, $userid, $pwd, $db);
	}

	public function getGenre()
	{
		$sql = ("SELECT * from genre");
		$res = $this->mysqli->query($sql);

		return $res;
	}
}

?>