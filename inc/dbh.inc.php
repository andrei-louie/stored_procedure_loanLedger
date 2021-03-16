<?php
class Dbh
{
	private $servername,
		$username,
		$password,
		$dbname;

	public function connect()
	{
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "memberloanledger";
		try {
			$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname."";
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			echo "Connection Failed: ".$e->getMessage();
		}
	}
}
