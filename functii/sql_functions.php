<?php
function conectareBd(
        $host = 'localhost',
        $user = 'root',
        $password = '',
        $database = 'taskorganizer'
        )
{
    return mysqli_connect($host, $user, $password, $database);
}

function clearData ($input, $link)
{
$input = trim($input);
$input = htmlspecialchars($input);
$input = stripslashes($input);
$input = mysqli_real_escape_string($link, $input);

return $input;
}

function inregistrare($nume, $prenume, $email, $pass) 
{
$link = conectareBd();
$nume = clearData($nume, $link);
$prenume = clearData($prenume, $link);
$email = clearData($email, $link);
$pass = clearData($pass, $link);
$pass = md5($pass);
$user = preiaUtilizatorDupaEmail($email);
if ($user) {
    return false;
}
$query = "INSERT INTO utilizator VALUES(NULL, '$nume', '$prenume', '$email', '$pass', NULL)";
return mysqli_query($link, $query);
}

function preiaUtilizatorDupaEmail($adresaEmail)
{
    $link = conectareBd();
    $adresaEmail = clearData($adresaEmail, $link);
    $query = "SELECT * FROM utilizator WHERE  email = '$adresaEmail'";
    $utilizator = mysqli_query($link, $query);
    $utilizatorArray = mysqli_fetch_array($utilizator, MYSQLI_ASSOC);
    
    return $utilizatorArray;
}

function preiaUtilizatori()
{
    $link = conectareBd();
    $query = "SELECT nume, prenume, email FROM utilizator";
    $utilizatori = mysqli_query($link, $query);
    $utilizatoriArray = mysqli_fetch_all($utilizatori, MYSQLI_ASSOC);
    return $utilizatoriArray;
}

function conectare($email, $pass) 
{
  $link = conectareBd();
$email = clearData($email, $link);
$pass = clearData($pass, $link);
$utilizator = preiaUtilizatorDupaEmail($email);
if ($utilizator) {
  if (md5($pass) == $utilizator['parola']) {
      return true;
  }  else {
      return false;
  }
} else {
    return false;
}
}

function adaugaTask($titlu, $data, $tip) 
{
$link = conectareBd();
$titlu = clearData($titlu, $link);
$data = clearData($data, $link);
$tip = clearData($tip, $link);

$query = "INSERT INTO task VALUES(NULL, '$titlu', '$data', '$tip')";
return mysqli_query($link, $query);
}

function adaugaPoza($imagine) 
{
$link = conectareBd();
$imagine = clearData($imagine, $link);

$query = "INSERT INTO utilizator VALUES(NULL, NULL, NULL, NULL, NULL, '$imagine')";
return mysqli_query($link, $query);
}

function preiaTask () 
{
    $link = conectareBd();
            $query = "SELECT * FROM task";
            $taskuri = mysqli_query($link, $query);
            $taskuriArray = mysqli_fetch_all($taskuri, MYSQLI_ASSOC);
            return $taskuriArray;
}

function preiaProfil($email) 
{
    $link = conectareBd();
    $query = "SELECT nume, prenume, email, poza FROM utilizator WHERE email = $email";
    $profiluri = mysqli_query($link, $query);
    $profiluriArray = mysqli_fetch_array($profiluri, MYSQLI_ASSOC);
    return $profiluriArray;
}

function stergeTaskDupaId($id) 
{
    $link = conectareBd();
    $id = clearData($id, $link);
    $query = "DELETE FROM task WHERE id = $id";
    return mysqli_query($link, $query);
}



