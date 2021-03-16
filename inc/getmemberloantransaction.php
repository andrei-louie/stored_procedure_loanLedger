<?php
include_once "dbh.inc.php";
include "clearloantransaction.php";

class MemberLoanTransaction extends Dbh
{
	private $conn,
	$array = array(),
	$output = '';

	public function __construct()
	{
		$this->conn = $this->connect();
		$this->cleartransaction = new ClearTransaction();
	}

	/**
	 * Get member loan transaction
	 *
	 * @param  int $memberId
	 * @param  int $fiscalYear
	 * @return array
	 */
	public function getMemberLoanTransaction($memberId, $fiscalYear)
	{
		$sql = "CALL memberloanledger($memberId, $fiscalYear);";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$array[] = $row;
		}
		return $array;
	}
	public function displayMembername($memberId)
	{
		$sql = "CALL getMembername($memberId);";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$array[] = $row;
		}
		return $array;
	}
	public function getMemberLoanTransactionOnLoad()
	{
		$sql = "CALL getAllMember();";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$array[] = $row;
		}
		return $array;
	}
	public function getMemberID()
	{
		$sql = "CALL getAllMember();";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$output .='<option value="'.$row["memberid"].'">'.$row["memberid"].'</option>';
		}
		return $output;
	}

}


class HandleAjax
{
	public function __construct()
	{
		$this->loanTransaction = new MemberLoanTransaction();
	}

	public function handle()
	{
		if (isset($_POST['q']) && ! empty($_POST['q'])) {
			switch ($_POST['q']) {
				case 'get-loans':
					echo $this->getLoans();
					break;
				
				default:
					echo json_encode([]);
					break;
			}
		}
	}
	public function handles()
	{
		if (isset($_POST['views']) && ! empty($_POST['views'])) {
			switch ($_POST['views']) {
				case 'get-membername':
					echo $this->getNames();
					break;
				
				default:
					echo json_encode([]);
					break;
			}
		}
	}

	/**
	 * Get the loan transaction
	 *
	 * @return json
	 */
	public function getLoans()
	{
		$memberId = $_POST['member_id'];
		$fiscalYear = $_POST['fiscal_year'];
		$res = $this->loanTransaction->getMemberLoanTransaction($memberId, $fiscalYear);
		return json_encode($res);
	}
	public function getNames()
	{
		$memberId = $_POST['member_id'];
		$res = $this->loanTransaction->displayMembername($memberId);
		return json_encode($res);
	}
}
(new HandleAjax())->handle();
(new HandleAjax())->handles();


