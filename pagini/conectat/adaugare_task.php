<h1>Adauga Task</h1>
<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label for="titlu">Titlu</label></td>
            <td><input type="text" id="titlu" name="titlu"/></td>
        </tr>
        <tr>
            <td><label for="data">Data</label></td>
            <td><input type="date" id="data" name="data"/></td>
        </tr>
        <tr>
            <td><label for="tip">Tip</label></td>
            <td><select id="tip" name="tip">
                        <option value="task">Task</option>
                        <option value="eveniment">Eveniment</option>
                        <option value="reminder">Reminder</option></select></td>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="adauga" value="Adauga"/></th>
        </tr>
    </table>
</form>
<?php
if(isset($_POST['adauga'])) {
    $titlu = $_POST['titlu'];
    $data = $_POST['data'];
    $tip = $_POST['tip'];
                    $salvareBd = adaugaTask($titlu, $data, $tip);
                   if ($salvareBd) {
                       print "Task adaugat cu succes";
                   } else {
                     print "Eroare la salvarea pe server";
                 }
                         
         } 
    

