<h1>Inregistrare</h1>
<form method="post">
    <table>
        <tr>
            <td>Nume</td>
            <td>
                <input type="nume" name="nume_utilizator"/>
            </td>
        </tr>
        <tr>
            <td>Prenume</td>
            <td>
                <input type="prenume" name="prenume_utilizator"/>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="email" name="email_utilizator"/>
            </td>
        </tr>
        <tr>
            <td>Parola</td>
            <td>
                <input type="password" name="pass"/>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="submit" name="inregistrare" value="Inregistrare"/>
            </th>
        </tr>
    </table>
</form>
<?php 

if (isset($_POST['inregistrare'])) {
  $nume = $_POST['nume_utilizator'];  
  $prenume = $_POST['prenume_utilizator'];  
  $email = $_POST['email_utilizator'];
  $pass = $_POST['pass'];
  $rezultatInregistrare = inregistrare($nume, $prenume, $email, $pass);
  if ($rezultatInregistrare) {
  //  print '<div style="color:green">Cont creat cu succes</div>';  
      $_SESSION['user'] = $email;
      $_SESSION['welcome'] = 'Contul tau a fost creat cu succes';
      header("location: index.php");
  } else {
      print '<div style="color:red">A aparut o eroare la crearea contului</div>';
  }
}


