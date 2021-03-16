<?php include_once "dbh.inc.php"; ?>
<?php
	class ClearTransaction extends Dbh {
		public function __construct()
		{
			$this->clearloantransaction();
		}
		public function clearloantransaction() {
			$stmt = $this->connect()->prepare("CALL emptyLoanBalance();");
			$stmt->execute();
			return $stmt;
		}
	}