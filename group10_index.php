<?php

session_start();
include_once('group10_Login.php');
//echo 'Current PHP version: ' . phpversion();
// define variables and set to empty values
$Err = "";
$user_pwd = $user_email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (empty($_POST["EMAIL"])|empty($_POST["PASSWORD"])) 
    {
        // this shouldn't appear normally, field is checked by javascript first
        $Err = "Error: Empty field found (PHP74)";
    }
    else 
    {
        $user_email = $_POST["EMAIL"];
        $user_pwd = $_POST["PASSWORD"];
        $validation_code = user_login_validation($user_email,$user_pwd);
        if($validation_code!=1)
        {
            switch ($validation_code)
            {
                case 201: $Err = "Error: User not found";break;
                case 202: $Err = "Error: Password Incorrect";break;
                case 203: $Err = "Error: User status not good,please contact admin";break;
            }
        }
        else // A good user
        {
            $_SESSION['GOOD'] = "Good";
             // go to different page depend on the user role
            switch ($_SESSION['ROLE']) {
                case 'admin':{
                    Page_redirect("group10_admin.html");
                    break;
                }
                case 'guest':{
                    Page_redirect("group10_guest.html");
                    break;
                }
            }

        }

    }
}
unset($_POST);

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
			<form name="loginForm" action="group10_Login.php" method="post">
                <fieldset>
                    <legend>Admin Login Portal</legend>
                    <label for="EMAIL">Email:</label><br>
                    <INPUT type="text" id="emailId" name="EMAIL" required><br>
                    <label for="PASSWORD">Password:</label><br>
                    <INPUT type="password" id="password" name="PASSWORD" required><br>
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
