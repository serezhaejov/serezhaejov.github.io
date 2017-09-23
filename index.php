<?php
session_start();



//
$login = 'user341'; //ЛОГИН и пароль для входа
$pass = '454232';
//




$error = false;

if (isset($_GET[p]) && $_GET['p'] == 'logout')
{
    session_destroy();
    session_start();
}

if ($_POST)
{
    if ($_POST['login'] == $login && $_POST['password'] == $pass)
    {
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $login;
        header('Location: ./');
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
	

<head>
  
  <meta charset="utf-8" lang="ru">
   <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Кабинет сотрудника</title>
 

</head>
<body>

<div class="container">

<nav class="navbar navbar-default navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Выйгрыши</a>
          
          </div>
          <div id="navbar" class="navbar-collapse collapse">
          
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      

    
  
   
   

        <?php 
         $f = file_get_contents('tranz.dat');
		// $str = fgets($f);
		 $str=explode("\n", $f);
		 ?>
		 
		 <table class="table">
		 <thead>
    <tr>
      <th>Номер</th>
      <th>Баланс</th>
      <th>Выйгрыш</th>
      <th></th>
    </tr>
  </thead>
		 <?php
         foreach ($str as $key => $value) {
			// echo $value;
			 $arrval='';
			 $arrval=explode("|", $value);
			 if($arrval[0]!=""){
			 echo "<tr>";
			 echo '<td>Номер игрока - '.$arrval[1].'</td>';
			 echo '<td>'.$arrval[2].'</td>';
			 echo '<td><input class="form-control" type="text" name="vig" value="'.$arrval[3].'"</td>';
			 echo '<td><button type="button" data-vivod="'.$arrval[0].'" class="vbutton btn btn-default">Вывод</button></td>';
			 echo "</tr>";
			 }
		 }
   
        ?>
       </table>
   

   </div>
   
   
   <div class="modal fade" id="m_zakaz" role="dialog">
 
    <div class="modal-dialog mini-modal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
		 
        </div>
        <div class="modal-body  text-center">
		<h4>ГОТОВО</h4>
		  
        </div>
       
      </div>
      
    </div>    

 

      


  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
  
</body>
</html>