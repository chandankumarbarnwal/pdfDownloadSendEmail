<?php

class Book
{
	private $tableName = 'books';
	protected $dbConn;


	function __construct()
	{
		require_once('Connectdb.php');
		$db = new Connectdb();
		$this->dbConn = $db->connects();
	}

	public function getAllBooks(){
		$stmt = $this->dbConn->prepare("select * from $this->tableName");
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $books;
	}
}

?>
































