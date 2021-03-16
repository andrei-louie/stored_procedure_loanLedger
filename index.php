<?php 
	include 'header.php';
	$member_loan_transaction = new memberloantransaction;
?>
<section class="section custom-width">
	<div class="row">
		<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
			<h1 class="title">Member Loan Ledger</h1>
			<form action="" method="POST" class="forms" id="form_members">
				<div class="form-group custom-pos">
				    <label for="Member ID List" class="memberID custom-poss">Member ID:</label>
				    <select class="form-control" id="memberList" name="mem_name">
				    	<option selected="select" disabled="disabled">Choose Member ID:</option>
				    	<?php echo $member_loan_transaction->getMemberID(); ?>
				    </select>
			  	</div>
			  	<div class="form-group custom-pos">
			  		<label for="Fullname" class="memberID fullname">Fullname:
			  			<div id="showMembername"></div>
			  		</label>
			  	</div>
			  	<div class="form-group" style="position: relative;left: 13%;width: 32%;">
				    <label for="Member ID List" class="memberID custom-poss" style="margin-left: 0 !important;">Fiscal Year:</label>
				    <input class="date-own form-control" style="width: 235px;" id="fiscal_year" type="text">
			  	</div>
			  	<div class="form-group adjust-pos">
			  		 <button id="displayData" type="submit" class="btn btn-secondary custom-button">Search</button>
			  	</div>
			</form>
			<div class="col-lg-12 col-md-6 custom-width-table">
				<table class="table table-hover custom-design table-bordered" id="tbl_members">
			  		<thead class="thead-light">
			    		<tr>
			      			<th scope="col">Member ID</th>
			      			<th scope="col" style="width: 25%;">Transaction Date</th>
			      			<th scope="col">Loan</th>
			      			<th scope="col">Payment</th>
			      			<th scope="col">Balance</th>
			    		</tr>
			  		</thead>
			  		<tbody id="responseData"></tbody>
				</table>
				<form class="custom-alignment" action="#" method="POST">
					<div class="form-group custom-pos">
				  		 <button type="button" class="btn btn-secondary custom-button" id="print_pdf">Print</button>
				  	</div>
			  	</form>
			</div>
		</div>
	</div>
</section>
<?php include 'footer.php'; ?>