<?php

//-----------------------------------------------------------------------------
//				 PHP functions
//-----------------------------------------------------------------------------


// connect to the database
function db_connect()
{
  $username = "5717G10";
  $password_db = "group10";
  $hostname = "localhost";
  $dbh = mysql_connect($hostname, $username, $password_db)
        or die("Unable to connect to MySQL");
  $selected = mysql_select_db("5717G10",$dbh)
        or die("Could not select the right database");
        return $dbh;
  
}

// unpermitted visit and redirect to home

function mysqli_db_connect()
{
      $mysqli = new mysqli('localhost', '5717G10', 'group10', '5717G10');
      if ($mysqli->connect_errno) {
      // The connection failed. What do you want to do? 
      // You could contact yourself (email?), log the error, show a nice page, etc.
      // You do not want to reveal sensitive information
      echo "Sorry, this website is experiencing problems.";
      // You might want to show them something nice, but we will simply exit
      exit;
      }
      else
      {
            return $mysqli;
      }
}

function mysqli_query_fail_check(){
      if (!$result = $mysqli->query($sql)) {
      // Oh no! The query failed. 
      echo "Sorry, the website is experiencing problems.";
      exit;
      }
}

// password hash encryption
function RJUS_pwd_encryption($user_pwd)
{
      $cost = 5;
      $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
      $salt = sprintf("$2a$%02d$", $cost) . $salt;
      $hash = crypt($user_pwd, $salt);
      logConsole("Func_ori_pwd: ", $user_pwd);
      logConsole("Func_hashed_pwd: ", $hash);
      return $hash;
}

// redirect page to destination
 function Page_redirect($destination)
 {
       logConsole("Redirect",$destination);
       echo '\n<script type="text/javascript"> window.location = "'.$destination.'"</script>';
 }

 // check if session is goo, redirect to home if not
 function Check_Session()
 {
       if(isset($_SESSION['GOOD']))
       {
            return 1;
       }
       else
       {
             Page_redirect("group10_Login.php");
             return 0;
       }
 }

// check if page is refreshed or not 
 function refresh_check($page_name)
 {
      if (!isset($_SESSION[$page_name]))
            $_SESSION[$page_name] = 0;
      $_SESSION[$page_name] = $_SESSION[$page_name] + 1;
      if ($_SESSION[$page_name] > 1)
      {
            //you refreshed the page!
            return 1;
      }
      else
      {
            //nothing to do here!
            return 0;
      }
 }



/************************************************
                  Debug Functions
*************************************************/

// output log to a file
function log_file_test($content,$debug_path)
{
      $outFile = fopen ($debug_path, "a+");
      $separation_line = "-----------------------------------------------------------------------------";
      $date = "Date: ".date("Y/m/d");
      fwrite($outFile, $separation_line."\n");
      fwrite($outFile, $date."\n");
      fwrite($outFile, "Error Message:\n");
      fwrite($outFile, $content."\n");
      fclose($outFile);
}

function php_alert($message)
{
      echo "<script>javascript: alert('".json_encode($message)."')></script>";
}

// output log to browser console
function logConsole($name, $data = NULL, $jsEval = FALSE)
 {
      if (! $name) return false;

      $isevaled = false;
      $type = ($data || gettype($data)) ? 'Type: ' . gettype($data) : '';

      if ($jsEval && (is_array($data) || is_object($data)))
      {
           $data = 'eval(' . preg_replace('#[\s\r\n\t\0\x0B]+#', '', json_encode($data)) . ')';
           $isevaled = true;
      }
      else
      {
           $data = json_encode($data);
      }

      # sanitalize
      $data = $data ? $data : '';
      $search_array = array("#'#", '#""#', "#''#", "#\n#", "#\r\n#");
      $replace_array = array('"', '', '', '\\n', '\\n');
      $data = preg_replace($search_array,  $replace_array, $data);
      $data = ltrim(rtrim($data, '"'), '"');
      $data = $isevaled ? $data : ($data[0] === "'") ? $data : "'" . $data . "'";

$js = <<<JSCODE
\n<script>
 // fallback - to deal with IE (or browsers that don't have console)
 if (! window.console) console = {};
 console.log = console.log || function(name, data){};
 // end of fallback

 console.log('$name');
 console.log('------------------------------------------');
 console.log('$type');
 console.log($data);
 console.log('\\n');
</script>
JSCODE;

      echo $js;
 } # end logConsole

?>
