<html>
<head>
<title>
Daily Profit</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
</style>
<script type="text/javascript">
function errorMessage(x) {
var error = document.getElementById("xx")
error.textContent = x
error.style.textAlign = "center"
error.style.color = "red"
}
</script>
</head>
<body>
<div class="main">
<h1><?php
$year = intval($_POST['year']);
$month = intval($_POST['month']);
$date = intval($_POST['day']);
echo "<b>Profit report for Year:$year, Month:$month, Date: $date<b>";
?></h1>
</div>
<br />
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
$sql = "select orderID, count(*) as itemsSold from orderdetails where paymentStatus='paid' and
year(DateOfOrder)=$year and month(dateOfOrder)=$month and day(dateOfOrder) = $date group by
orderID";
$y = $conn->query($sql);
$x=$y->num_rows;
if ($x== 0) {
echo '<script type="text/javascript">
errorMessage("No orders found!!");
</script>';
} else {
$Query_ToJoin = "select x.StockID as stockId, x.Name as stockName, x.profit*x1.itemsSold as profit
from (select s.StockID, s.Name, s.SellingPrice-b.buyingPrice as profit from stockdetails s inner join
buyersdetails b on s.StockID=b.StockID) x inner join ($sql) x1 on x1.orderID=x.StockID";
$y = $conn->query($Query_ToJoin);
$Total_Profit = 0;
$field_Information =$y->fetch_fields();
$num =$y->num_rows; ?>
<table class="tableWithBorder">
<tr>
<?php
foreach ($field_Information as $val) { ?>
<th>
<?php
echo $val->name;
?>
</th>
<?php
}
?>
</tr>
<?php while ($row =$y->fetch_assoc()) { ?>
<tr>
<?php
$Total_Profit = $Total_Profit + $row["profit"];
foreach ($field_Information as $val) { ?>
<td>
<?php
echo $row[$val->name];
?>
</td>
<?php
}}
?>
</tr>
<?php
echo "<h3> Total Profit for the day: $Total_Profit $</h3>";
} ?>
</table>
<form class="homepage" action="index.php" method="post">
<input type="submit" value="Go To Home page" class="button">
</form>
</body>
</html>