<?php
session_start();
ob_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
header("Location: index.php");
}
ob_end_flush();
?> 
