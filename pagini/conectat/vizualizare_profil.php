<h1>Vizualizare profil</h1>
<br>
</table> 
<form method="post" enctype="multipart/form-data">
    <table>        
        <tr>
            <td><label for="img">Imagine</label></td>
            <td><input type="file" id="img" name="img"/></td>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="adauga" value="Adauga"/></th>
        </tr>
    </table>
</form>
<?php
$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',);
if(isset($_POST['adauga'])) {        
    if(isset($_FILES['img'])) {
      if ($_FILES['img']['error']==0) {
         switch ($_FILES['img']['type']) {
             case 'image/jpg':
             case 'image/jpeg':
             case 'image/png':
             case 'image/bitmap':
             case 'image/gif':
                 $numeImagine = uniqid() . $_FILES['img']['name'];
                 $salvareServer = move_uploaded_file($_FILES['img']['tmp_name'], 'imagini/' . $numeImagine);
                 if ($salvareServer) {
                   $salvareBd = adaugaPOZA($numeImagine);
                   if ($salvareBd) {
                       print "POZA adaugata cu succes";
                   } else {
                       unlink('imagini/' . $numeImagine);
                       print "Eroare la salvarea in baza de date";
                   }
                 } else {
                     print "Eroare la salvarea pe server";
                 }
                 break;
             default:
                 print 'Fisierul adaugat nu este o imagine';
                 break;
         } 
      }  else {
          if ($_FILES['img']['error']==4) {
              
                $rezultatAdaugarePoza = adaugaPoza(NULL, NULL, NULL, NULL, NULL, NULL);
                if ($rezultatAdaugarePOZA) {
                    print 'Fara poza de profil';
                } else {
                    print 'Eroare la salvarea in baza de date';
                }
      } else {
          print "A aparut o eroare: ".$phpFileUploadErrors[$_FILES['img']['error']];
      }
      }
    }
}
?>
<?php
if (isset($_GET['user'])) {    
    $profiluri = preiaProfil($email);
}
?>
    <table>
    <tr>
        <th>Imagine</th>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Email</th>
        <th></th>
    </tr>
<?php
    foreach ((array)$profiluri as $profil) {        
        ?>
    <tr>
        <td><img src="imagini/<?php print $profil['imagine']; ?>" width="50px" /></td>
        <td><?php print $profil['nume']; ?></td>
        <td><?php print $profil['prenume']; ?></td>
        <td><?php print $profil['email']; ?></td>
    </tr>
    <?php
    }    
?>
   
   