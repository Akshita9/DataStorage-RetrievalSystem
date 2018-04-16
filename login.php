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


$query = "SELECT * FROM USER WHERE EMAIL = '".$EMAIL."' and PASSWORD = '".$PASSWORD."'";

echo "<p>I'm here</p>";
$userQueryResults = $mysql->query($query);
$num_results = $userQueryResults->num_rows;
echo "Number of results ".$num_results;

if($num_results == 0)
{
 header("location:index.html");
 exit;
}
if(!$userQueryResults) 
{
echo "Cannot run query.";
exit;
}
;
$userQueryResults_actor = $userQueryResults->fetch_assoc();
$FIRSTNAME = $userQueryResults_actor['FIRSTNAME'];
$LASTNAME = $userQueryResults_actor['LASTNAME'];
$ROLE = $userQueryResults_actor['ROLE'];

switch ($ROLE) 
 {
    case 'admin':
        header("location:group10_admin.html");
        break;
    case 'guest':
        header("location:group10_guest.html");
        break;
}
?>
</body>
</html>