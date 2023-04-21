<html>
<head>
<title>
Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
<script type="text/javascript">
function successMessage() {
var success = document.getElementById("xx")
success.textContent = "Order has been placed!!"
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
$Customer_ID = intval($_POST['CustomerID']);
$quantity = intval($_POST['quantity']);
$Stockid = intval($_POST['StockID']);
$sql = "select X.CustomerID,X.Name,X.Address,X.TelephoneNumber from customersdetails X
inner join orderdetails Y on X.CustomerID=Y.CustomerID where Y.paymentStatus = 'pending' and
X.CustomerID=$Customer_ID";
$y = $conn->query($sql);
$x =$y->num_rows;
$sql1 = "select * from customersdetails where CustomerID = $Customer_ID";
$customerCount = $conn->query($sql1)->num_rows;
$sql3 = "select quantity from stockdetails where StockID = $Stockid and quantity > $quantity";
$y3 = $conn->query($sql3);
$num =$y3->num_rows;
$sql4 = "SELECT DeliveryTime FROM buyersdetails where StockID = $Stockid";
$result = $conn->query($sql4);
if ($x > 0) {
echo '<script type="text/javascript">
errorMessage("Warning! Please pay the pending payments!");
</script>';
}
elseif($customerCount==0){
echo '<script type="text/javascript">
errorMessage("Error!! Customer ID not found!");
</script>';
}
elseif($num == 0){
if ($result->num_rows > 0)
{
while($row = $result->fetch_assoc())
{
echo "<h3>Warning! required quantity is not present in stock! Delivery time for this stock is ".
$row["DeliveryTime"]. " days</h3>";
}
}
}
else {
$stockId = intval($_POST['StockID']);
$sql1 = "select quantity from stockdetails where StockID=$stockId";
$y = $conn->query($sql1);
if ($y->num_rows == 0) {
echo '<script type="text/javascript">
errorMessage("Error!! Stock ID not found");
</script>';
} else {
$row =$y->fetch_assoc();
if (intval($row["quantity"]) >= intval($_POST["quantity"])) {
$quantity = intval($row["quantity"]) - intval($_POST["quantity"]);
$quan= $_POST["quantity"];
$sql = "update stockdetails set quantity= $quantity where StockID=$stockId";
if ($conn->query($sql) === TRUE) {
echo '<script type="text/javascript">
successMessage();
</script>';
}
else {
echo "Error updating record: " . $conn->error;
}
$status = $_POST["paymentStatus"];
$date=date("Y-m-d");
$ins_Query = "insert into orderdetails values ($stockId,$Customer_ID, $quan,'$status','$date')";
if ($conn->query($ins_Query) === TRUE) {
echo '<script type="text/javascript">
successMessage();
</script>';
}
else {
echo "Error updating record!" . $conn->error;
}
} else {
echo '<script type="text/javascript">
errorMessage("Error! insufficient quantity");
</script>';
}
}
}
?>
<form class="homepage" action="index.php" method="post">
<input type="submit" value="Go To Home page" class="button">
</form>
</body>
</html>
