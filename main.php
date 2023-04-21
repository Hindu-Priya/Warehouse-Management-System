<html>
<head>
<title> BusinessDetails</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" type = "text/css" href = "styleSheet.css">
</head>
<body>
<b>
<h1><?php
echo $_POST['header'];
?></h1>
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
$sql = $_POST['query'];
$y = $conn->query($sql);
$fieldinfo =$y->fetch_fields();
$num =$y->num_rows; ?>
<table class="tableWithBorder">
<tr>
<?php
foreach ($fieldinfo as $val) { ?>
<th>
<?php
echo $val->name;
?>
</th>
<?php } ?>
</tr>
<?php while ($row =$y->fetch_assoc()) { ?>
<tr>
<?php
foreach ($fieldinfo as $val) { ?>
<td>
<?php
echo $row[$val->name];
?>
</td>
<?php
} ?>
</tr>
<?php
} ?>
</table>
<form class="homepage" action="index.php" method="post">
<input type="submit" value="Go To Home page" class="button">
</form>
</body>
</html>
