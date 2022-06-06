<?php
require_once 'functii/sql_functions.php';
session_start();
if (isset($_POST['conectare'])) {
    $email = $_POST['email_utilizator'];
    $pass = $_POST['pass'];
    $rezultatConectare = conectare($email, $pass);
    if ($rezultatConectare) {
        if(isset($_SESSION['eroare_login'])) {
            unset($_SESSION['eroare_login']);
        }
        $_SESSION['user'] = $email;
    } else {
        $_SESSION['eroare_login'] = 'Conectare esuata';
}
}

if (isset($_GET['id_task'])) {
    $id = $_GET['id_task'];
    if (isset($_SESSION['task'][$id])) {
        $_SESSION['task'][$id]++;
    } else {
        $_SESSION['task'][$id] = 1;
    }
}
if (isset($_GET['id_stergere'])) {
    $id = $_GET['id_stergere'];
    if ($_SESSION['task'][$id]>1) {
        $_SESSION['task'][$id]--;
    } else {
        unset($_SESSION['task'][$id]);
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>        
    </head>
    <body> 
        <div>
        <header id="banner">Task Organizer</header> 
        </div>         
        <?php
        if(isset($_SESSION['user'])) {
    require_once 'templates/template_conectat.php';
} else {
    require_once 'templates/template_neconectat.php';
}    
        ?>         
<footer id="footer">www.TaskOrganizer.ro</footer>        
    </body>
</html>
