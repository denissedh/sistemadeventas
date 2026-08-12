<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 17/1/2023
 * Time: 16:19
 */

include ('../../config.php');

session_start ();
if(isset($_SESSION['sesion_email'])){
    session_destroy();
    header('Location: '.$URL.'/index.php');
}