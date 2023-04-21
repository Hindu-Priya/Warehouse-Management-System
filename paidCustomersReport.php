<html>
<head>
<title>
Customers Paid Payments </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
</head>
<body>
<b>
<h1>
Customers Information whose payment is paid!
</h1>
</b>
<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "wholesale management system";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "select distinct X.CustomerID,X.Name,X.Address,X.TelephoneNumber from
customersdetails X inner join orderdetails Y on X.CustomerID=Y.customerID where y.paymentStatus
= 'paid'";
$y = $conn->query($sql);
$fieldinfo =$y->fetch_fields();
$num =$y->num_rows; ?>
<table class="tableWithBorder">
<tr>
<th>Customer_Id</th>
<th>Name</th>
<th> Address </th>
<th>Telephone_number</th>
</tr>
<?php while ($row =$y->fetch_assoc()) { ?>
<tr>
<td>
<?php
echo $row["CustomerID"];
?>
</td>
<td>
<?php
echo $row["Name"];
?>
</td>
<td>
<?php
echo $row["Address"];
?>
</td>
<td>
<?php
echo $row["TelephoneNumber"];
?>
</td>
</tr>
<?php } ?>
</table>
<form class="homepage" action="index.php" method="post">
<input type="submit" value="Go To Home page" class = "button">
</form>
</body>
</html>

