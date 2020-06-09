<?php 
require('functions.php');

if(isset($_POST['disconnect']))
{
    $user->disconnect();
    header('Location: index.php');
}

?>