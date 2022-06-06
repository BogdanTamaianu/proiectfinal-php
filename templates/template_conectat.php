<nav id="meniu">
    <ul>
        <li><a href="index.php">Vizualizare Profil</a></li>
        <li><a href="index.php?page=1">Adauga Task</a></li>          
        <li><a href="index.php?page=2">Lista taskuri</a></li>
        <li><a href="index.php?logout">Deconectare, <?php print $_SESSION['user']?></a><li>
    </ul>
</nav>
<section id="continut">
    
    <?php
if (isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php");
}
if (isset($_SESSION['welcome'])) {
    print $_SESSION['welcome'];
    unset($_SESSION['welcome']);
}
if (isset($_GET['page'])) {
  $page = $_GET['page'];
if($page == 1) {
    require_once 'pagini/conectat/adaugare_task.php';
}  else if($page == 2) {
    require_once 'pagini/conectat/lista_taskuri.php';
} else {
    require_once 'pagini/eroare.php';
}
} else {
    require_once 'pagini/conectat/vizualizare_profil.php';
}
?>       
</section>