
<html>
<head>
<title>
Stock Information</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
<script type="text/javascript">

function errorMessage(x) {
var error = document.getElementById("xx")
error.textContent = x
error.style.textAlign = "center"
error.style.color = "red"
}
function successMessage() {
var success = document.getElementById("xx")
success.textContent = "Added new Stock!!"
success.style.textAlign = "center"
success.style.color = "blue"
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
$stockId = $_POST['StockID'];
$Name = $_POST['StockName'];
$quantity = $_POST['quantity'];
$sp = $_POST['SellingPrice'];
$sql = "select * from stockdetails";
$y = $conn->query($sql);
$rows_count_value = mysqli_num_rows($y);
if ($rows_count_value >= $stockId) {
exit("<h3>Please enter Stock ID greater than $rows_count_value</h3>");
}
$sql1 = "insert into stockdetails values($stockId,'$Name',$quantity,$sp)";
$y1 = $conn->query($sql1);
if ($y1 === TRUE) {
echo '<script type="text/javascript">
successMessage();
</script>';
}
else {
echo "Error updating record: " . $conn->error;
}
?>
<form class="homepage" action="index.php" method="post">
<input type="submit" value="Go To Home page" class="button">
</form>
</body>
</html>
