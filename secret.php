<?php
$EMAIL = $_POST['EMAIL'];
$PASSWORD = $_POST['PASSWORD'];
//Visitor needs to enter a name and password
if ((!isset($EMAIL)) || (!isset($PASSWORD)))
{
?>
 <!DOCTYPE html>
<html>
    <head>
    <title>Group 10 - Homepage</title>
    <link href="group10_style_v2.css" type="text/css" rel="stylesheet" />
    </head>

<body>
    
    <h1>People of Data Science</h1>
    <header>
        <div class="nav">
            <ul>
                <li><a href="http://iia02.ci.unt.edu/5717/group10/group10_index.php">Home</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_Search.html">Search Database</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_TableView.html">Table View</a></li>
				<li><a href="http://iia02.ci.unt.edu/5717/group10/group10_AboutUs.html">About Us</a></li>
			</ul>
        </div>
<br>
<br>
	<!-- LoginPortal Box -->
        <div id="loginDiv">
			<form name="loginForm" action="group10_Reporting.php" method="post">
                <fieldset>
                    <legend>Admin Login Portal</legend>
                    <label for="EMAIL">Email:</label><br>
                    <INPUT type="text" id="emailId" name="EMAIL" required><br>
                    <label for="PASSWORD">Password:</label><br>
                    <INPUT type="password" id="password" name="PASSWORD" required><br>
                    <span class="error"> <?php echo $Err;?></span><br>
                    <input id="submit_button" type="submit" value="Login"><br>
                </fieldset>
            </form>
        </div>
	<!-- Welcome Div -->
        <div id="welcomeDiv">
			<h3>This website is a direct connection to our database which provides information about people who have positively impacted 
	the field of Data Science, in particular: <br/><br/>Text Mining<br/>Data Mining<br/>Data Analytics<br/>Visualization<br/>
	Machine Learning<br/><br/>The website allows you, the user, to search the database using keywords, display full table views, 
	generate administrative reports (Admin rights required), and insert information directly into the database. </h3>
        </div>
</body>
</html>
<?php
} else {
// connect to mysql
$mysql = mysqli_connect("localhost", "5717G10", "group10");
if(!$mysql) {
echo "Cannot connect to database.";
exit;
}
// select the appropriate database
$selected = mysqli_select_db($mysql, "5717G10");
if(!$selected) {
echo "Cannot select database.";
exit;
}
// query the database to see if there is a record which matches
$query = "select count(*) from USER where
EMAIL = '".$EMAIL."' and
PASSWORD = '".$PASSWORD."'";
$result = mysqli_query($mysql, $query);
if(!$result) {
echo "Cannot run query.";
exit;
}
$row = mysqli_fetch_row($result);
$count = $row[0];
if ($count > 0) {

// visitor's name and password combination are correct
echo "<h1>Here it is!</h1>
<p>I bet you are glad you can see this secret page.</p>";
} else {
// visitor's name and password combination are not correct
echo "<h1>Go Away!</h1>
<p>You are not authorized to use this resource.</p>";
}
}
?>

$query = "select FIRSTNAME, LASTNAME, ROLE from USER where EMAIL = '".$EMAIL."'";
$query += " and PASSWORD = '".$PASSWORD."'";

echo "<p>I'm here</p>";
if(!$userQueryResults = $mysql->query($query)) 
{
echo "Cannot run query.";
exit;
}

$userQueryResults_actor = $userQueryResults->fetch_assoc();
$FIRSTNAME = $userQueryResults_actor['FIRSTNAME'];
$LASTNAME = $userQueryResults_actor['LASTNAME'];
$ROLE = $userQueryResults_actor['ROLE'];

switch ($ROLE) 
 {
    case 'admin':
        header("location:group10_admin.php");
        break;
    case 'guest':
        header("location:group10_guest.html");
        break;
}
  
?>