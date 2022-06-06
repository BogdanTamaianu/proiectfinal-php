<h1>Lista Taskuri</h1>
<br>
<?php
if (isset($_GET['kw'])) {
    $keyword = $_GET['kw'];
    $taskuri = preiaProduseDupaConditie($keyword);
    setcookie('keyword', $keyword, time()+24*60*60);
} elseif(isset($_COOKIE['keyword'])) {
    $keyword = $_COOKIE['keyword'];
    $produse = preiaProduseDupaConditie($keyword);
} else {
    $taskuri = preiaTask();
}
if (isset($_GET['reset'])) {
    $taskuri = preiaTaskuri();
    setcookie('keyword', '', time()-1);
}
if (count($taskuri)==0) {
    print "Fara taskuri in lista";
} 
?>
    <table>
    <tr>
        <th>Titlu</th>
        <th>Data</th>
        <th>Tip</th>
        <th>Finalizare task</th>
        <th></th>
    </tr>
    <button> <a href="http://localhost/TemplateProiect/index.php?page=1">Adauga Task</a></button>
<?php
    foreach ($taskuri as $task) {
        
        ?>
    <tr>
        <td><?php print $task['titlu']; ?></td>
        <td><?php print $task['data']; ?></td>
        <td><?php print $task['tip']; ?></td>
        <td><a href="index.php?delete=<?php print $task['id']; ?>">Finalizare task</a></td>
    </tr>
    <?php
    }    
?>
   </table>    
<?php
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $rezultatStergere = stergeTaskDupaId($id);
  if($rezultatStergere) {
      if (isset($_SESSION['task'][$id])) {
       unset($_SESSION['task'][$id]);   
      }
      $_SESSION['task_finalizat'] = 'Task-ul a fost finalizat';
      header('location: index.php');
  }
  }
  ?>
   

