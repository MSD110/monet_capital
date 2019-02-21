<?php
//Database Connect
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monetcap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['date']))
	$date = $_POST['date'];
else
	$date = date('m/d/Y');
	
$table = 'request';
$result = array();

if($table == 'request'){
	$sql = "SELECT * FROM `request` WHERE `date` = '" . $date . "'";
	$result = $conn->query($sql);
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Table</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
					<form id="date_form" name="date_form" method="post" action="table.php">
					<div style="height: 55px;">
						<p style="float: left;"><input name="date" style="text-align: center; height: 50px; padding: 10px; background: yellowgreen;" type="text" id="datepicker" value="<?php echo $date;?>"></p>
						<button id="export" data-export="export" style="height: 50px; padding: 10px; background: yellowgreen; float: right;">Export</button>
					</div>
					</form>
					<div class="table" id="export_table">

						<div class="row header">
							<div class="cell">First Name</div>
							<div class="cell">Name</div>
							<div class="cell">Email</div>
							<div class="cell">Phone</div>
							<div class="cell">Business Name</div>
							<div class="cell">How Much?</div>
							<div class="cell">How Soon?</div>
							<div class="cell">Years in busienss</div>
							<div class="cell">Monthly Revenue</div>
							<div class="cell">Industry</div>
						</div>
						<?php
						 	if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
										echo '
										<div class="row">
											<div class="cell" data-title="First Name">'
												. $row['first_name']
											.'</div>
											<div class="cell" data-title="Last Name">'
												. $row['last_name']
											.'</div>
											<div class="cell" data-title="Email">'
												. $row['email_address']
											.'</div>
											<div class="cell" data-title="Phone">'
												. $row['phone_number']
											.'</div>
											<div class="cell" data-title="Business Name">'
												. $row['business_name']
											.'</div>
											<div class="cell" data-title="How Much?">'
												. $row['how_much']
											.'</div>
											<div class="cell" data-title="How Soon?">'
												. $row['how_soon']
											.'</div>
											<div class="cell" data-title="Years in Business">'
												. $row['years_business']
											.'</div>
											<div class="cell" data-title="Monthly Revenue">'
												. $row['monthly_revenue']
											.'</div>
											<div class="cell" data-title="Industry">'
												. $row['industry']
											.'</div>
											</div>';
							    }
							}
						?>
					</div>
			</div>
		</div>
	</div>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
		$( function() {
			$( "#datepicker" ).datepicker();
		} );
		$("#datepicker").datepicker({
		  onSelect: function(dateText) {
		    $('#date_form').submit();
		  }
		});
	</script>

	<script src="./jquery.tabletoCSV.js" type="text/javascript" charset="utf-8"></script>
	<script>
			$(function(){
					$("#export").click(function(){
							$("#export_table").tableToCSV();
					});
			});
	</script>

</body>
</html>
