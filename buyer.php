<html>
<head>
<title>
Buyer</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
<script type="text/javascript">
function successMessage() {
var success = document.getElementById("xx")
success.textContent = "Added New Buyer!"
success.style.textAlign = "center"
success.style.color = "blue"
}
</script>
<script type="text/javascript">
function errorMessage(x) {
var error = document.getElementById("xx")
error.textContent = x
error.style.color = "red"
error.style.textAlign = "center"
}
</script>
</head>
<body>
<h1 id="xx"></h1>
<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "wholesale management system";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$buyer_Id = $_POST['BuyerId'];
$buyer_name = $_POST['BuyerName'];
$buyer_address = $_POST['BuyerAddress'];
$productid = $_POST['ProductID'];
$PriceFromBuyer = $_POST['BuyingPrice'];
$delivery_Time = $_POST['deliveryTimeReq'];
$sql = "select * from buyersdetails";
$y = $conn->query($sql);
$rows_count_value = mysqli_num_rows($y);
$sql1 = "insert into buyersdetails
values($buyer_Id,'$buyer_name','$buyer_address',$productid,$PriceFromBuyer,$delivery_Time)";
$y = $conn->query($sql1);
if($rows_count_value >= $buyer_Id){
exit("<h3>Please enter buyer ID greater than $rows_count_value</h3>");
} else if ($y === TRUE) {
echo '<script type="text/javascript">
successMessage();
</script>';
}
else {
echo "Error! Please recheck BuyerID " . $conn->error;
}
?>
<form class="homepage" action="index.php" method="post">
<input type="submit" value="Go To Home page" class="button">
</form>
</body>
</html>