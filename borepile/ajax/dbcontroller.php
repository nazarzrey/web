<?php
class DBController
{
	private $host = "127.0.0.1";
	private $user = "support";
	private $password = "GileluNdr0";
	private $database = "helpdesk";

	function __construct()
	{
		$conn = $this->connectDB();
		if (!empty($conn)) {
			$this->selectDB($conn);
		}
	}

	function connectDB()
	{
		$conn = mysql_connect($this->host, $this->user, $this->password);
		return $conn;
	}

	function selectDB($conn)
	{
		mysql_select_db($this->database, $conn);
	}

	function runQuery($query)
	{
		$result = $db->select($query);
		while ($row = mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if (!empty($resultset))
			return $resultset;
	}

	function numRows($query)
	{
		$result  = $db->select($query);
		$rowcount = count($result);
		return $rowcount;
	}
}
