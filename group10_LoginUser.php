<html>
<head>
<title> login </title>
</head>
<body>
<p> Welcome to the database </p>

<?php
$EMAIL = $_POST['EMAIL'];
$PASSWORD = $_POST['PASSWORD'];
//Visitor needs to enter a name and password
@ $mysql = new mysqli('localhost', '5717G10', 'group10', '5717G10');
// = mysqli_connect("localhost", "5717G10", "group10");
if (mysqli_connect_errno()) 
{
echo "Error: Could not connect to database. Please try again later.";
exit;
}
else 
   echo "Connected to the database";
// select the appropriate database
//$selected = mysqli_select_db($mysql, "5717G10");
//if(!$selected) {
//echo "Cannot select database.";
//exit;
//}
// query the database to see if there is a record which matches
?>
</body>
</html>