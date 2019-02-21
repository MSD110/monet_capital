<?php
$post = $_POST;

$table = 'message';

if(isset($post['how_much'])){
  $first_name = $post['first_name'];
  $last_name = $post['last_name'];
  $phone_number = $post['phone_number'];
  $email_address = $post['email_address'];
  $business_name = $post['business_name'];

  $how_much = $post['how_much'];
  $how_soon = $post['how_soon'];
  $years_business = $post['years_business'];
  $monthly_revenue = $post['monthly_revenue'];
  $industry = $post['industry'];

  $table = 'request';

  //extract data from the post
  //set POST variables
  // $url = 'https://sheets.googleapis.com/v4/spreadsheets?key=AIzaSyCYRKWBH759HZen9Q6KVvnEwXl74iP9Szg';
  //
  // // A sample PHP Script to POST data using cURL
  // // Data in JSON format
  //
  // $data = array(
  //   'first_name' => $first_name,
  //   'last_name' => $last_name,
  //   'phone_number' => $phone_number,
  //   'email_address' => $email_address,
  //   'business_name' => $business_name,
  //   'how_much' => $how_much,
  //   'how_soon' => $how_soon,
  //   'years_business' => $years_business,
  //   'monthly_revenue' => $monthly_revenue,
  //   'industry' => $industry
  // );
  //
  // $payload = json_encode($data);
  //
  // //var_dump($payload);exit;
  //
  // // Prepare new cURL resource
  // $ch = curl_init($url);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  // curl_setopt($ch, CURLOPT_POST, true);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  //
  // // Set HTTP Header for POST request
  // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  //     'Accept: application/json',
  //     'Content-Type: application/json',
  //     'Content-Length: ' . strlen($payload))
  // );
  //
  // // Submit the POST request
  // $result = curl_exec($ch);
  //
  // var_dump($result);exit;
  //
  // // Close cURL session handle
  // curl_close($ch);

}
else {
  $first_name = $post['first_name'];
  $last_name = $post['last_name'];
  $phone_number = $post['phone_number'];
  $email_address = $post['email_address'];
  $business_name = $post['business_name'];
  $message = $post['message'];
}

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

if($table == 'message')
  $sql = "INSERT INTO " . $table . " (first_name, last_name, phone_number, email_address, business_name, message, date)
  VALUES ('" . $first_name . "', '" . $last_name . "', '" . $phone_number . "', '" . $email_address. "', '" . $business_name . "', '" . $message . "', '" . date("m/d/Y") . "')";

if($table == 'request')
  $sql = "INSERT INTO " . $table . " (first_name, last_name, phone_number, email_address, business_name, how_much, how_soon, years_business, monthly_revenue, industry, date)
  VALUES ('" . $first_name . "', '" . $last_name . "', '" . $phone_number . "', '" . $email_address. "', '" . $business_name . "', '" . $how_much . "', '" . $how_soon. "', '" . $years_business. "', '" . $monthly_revenue. "', '" . $industry . "', '" . date("m/d/Y") . "')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
