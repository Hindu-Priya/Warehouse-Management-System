<html>
<head>
<title >
Dashboard
</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
</head>
<body>
<div class="main">
<h1><b> WholeSale Warehouse Management <br> Dashboard</b></h1>
</div>
<br />
</br>
<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "wholesale management system";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "select * from stockdetails where quantity<10";
$y = $conn->query($sql);
$num =$y->num_rows;
if($num>0){ ?>
<div class="alert warning">
<b id = "warn" >Warning!</b> <?php echo "$num Items quantity is less than 10! Please Refill!" ?>
</div>
<?php
}
?>
<br />
<div class = "body" >
<div class="category">
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from stockdetails">
<input type="hidden" name="header" value="Available Stock Information">
<input id="details" type="submit" value=" Stock Details" class="button1" >
</form>
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from customersdetails">
<input type="hidden" name="header" value="Customers Information">
<input id="details" type="submit" value="Customers Details" class="button1" >
</form>
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from buyersdetails">
<input type="hidden" name="header" value="Buyer's Information">
<input id="details" type="submit" value="Buyers Details" class="button1" >
</form>
</div>
<div class="category">
<form action="customer_Form.html" method="post">
<input id="details" type="submit" value="Add New Customer" class="button1" >
</form>
<form action="buyer_Form.html" method="post">
<input id="details" type="submit" value="Add New Buyer" class="button1" >
</form>
<form action="stock_Form.html" method="post">
<input id="details" type="submit" value="Stock Refill" class="button1" >
</form>
</div>
<div class="category">
<form action="paidCustomersReport.php" method="post">
<input id="details" type="submit" value="customers payment paid" class="button1" >
</form>
<form action="pendingCustomersReport.php" method="post">
<input id="details" type="submit" value="customers payment pending" class="button1" >
</form>
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from stockdetails where quantity<10">
<input type="hidden" name="header" value="Need Stock to Refill (Quantity < 10)">
<input id="details" type="submit" value="stock quantity < 10" class="button1" >
</form>
</div>
<div class="category">
<form action="profit_yearly.html" method="post">
<input type="hidden" name="query" value="">
<input type="hidden" name="header" value="Profit">
<input type="hidden" name="func" value="year">
<input id="details" type="submit" value="Get Profit Yearly" class="button1" >
</form>
<form action="profit_monthly.html" method="post">
<input type="hidden" name="query" value="">
<input type="hidden" name="header" value="Profit">
<input type="hidden" name="func" value="month">
<input id="details"type="submit" value="Get Profit Monthly" class="button1" >
</form>
<form action="profit_daily.html" method="post">
<input type="hidden" name="query" value="">
<input type="hidden" name="header" value="Profit">
<input type="hidden" name="func" value="daily">
<input id="details" type="submit" value="Get Profit Daily" class="button1" >
</form>
</div>
<div class="category">
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from orderdetails where
paymentStatus='pending'">
<input class = "main" type="hidden" name="header" value="List of Payments Pending" >
<input id="details" type="submit" value="payments pending" class="button1" >
</form>
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from orderdetails where
paymentStatus='paid'">
<input class = "main" type="hidden" name="header" value="List of Payments Paid" >
<input id="details" type="submit" value="payments paid" class="button1" >
</form>
<form action="main.php" method="post">
<input type="hidden" name="query" value="select * from orderdetails ">
<input type="hidden" name="header" value="Total Sale" class = "main">
<input id="details" type="submit" value="Total Sale" class="button1" >
</form>
</div>
</div>
<div class="order">
<form action="Order.html" method="post">
<input id="details" type="submit" value="Place Order" class="button1" >
</form>
</div>
</body>
<?php include 'footer.php'?>
</html>