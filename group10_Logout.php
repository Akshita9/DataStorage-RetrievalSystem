<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
include_once('group10_Library.php');

session_destroy();
Page_redirect("group10_index.php");

?>