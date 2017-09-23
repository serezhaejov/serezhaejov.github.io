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
        header('Location: ./trAdmin.php');
    } else {
        $error = true;
    }
}


   




if (isset($_GET['do']) && $_GET['do'] == 'del' && isset($_GET['id']) && (int) $_GET['id'] != 0)
{
         $tmpstr = '';
         $f = fopen('tranz.dat','r');
         while($str = fgets($f))
         {
             preg_match('/(.*)<p>(.*) - (.*) <font size="5" color="(.*)" face="Arial">(.*)<\/font><\/p>/i',$str,$arr);
             if ($_GET['id'] != $arr[1])
             {
              $tmpstr .= $str;
             }
         }
         fclose($f);
         $f = fopen('tranz.dat','w');
         fwrite($f,$tmpstr);
         fclose($f);
} 
 else if ($_POST)
{
    if (isset($_GET['do']) && $_GET['do'] == 'addnew')
    {
        
		if(file_exists('tranz.dat')){
				$fc = file_get_contents('tranz.dat');
				// $str = fgets($f);
				$strc=explode("\n", $fc);	
		$lastid=count($strc)-1;	 
		}
		else{
		$lastid=0;	
		}
        
        $lastid++;
        $f = fopen('tranz.dat','a');
		
			$string=$lastid.'|'.$_POST['newgamer'].'|'.$_POST['newbalan'].'|'.$_POST['newwin']."\n";
		
		
        fwrite($f, $string);
        fclose($f);
        header('Location: ./trAdmin.php');
        
    } else if (isset($_GET['do']) && $_GET['do'] == 'save') 
    {
        $f = fopen('tranz.dat','w');
        foreach($_POST['tr'] as $k => $v)
        {
            fwrite($f,$v['id']."|".$v['num']."|".$v['bal']."|".$v['win']."");
            
            fwrite($f,$isp."\n");
        
        }
 
        fclose($f);  
        header('Location: ./trAdmin.php');
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
  <title>Кабинет администратора</title>
 

</head>
<body>


<div class="container">




<?php
if (isset($_SESSION['auth']) && $_SESSION['auth'] == true):?>
















<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Кабинет администратора</a>
			 <a class="navbar-brand" href="?p=logout">Выход</a> 
          </div>
          <div id="navbar" class="navbar-collapse collapse">
          
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      
  <div class="jumbotron">
  
		
        <div>
        <h2>Добавить новую</h2>
        <center>
            <form method="POST" action="?do=addnew">
            <div style="padding:2px"><input type="text" name="newgamer" placeholder="Номер грока"> <input type="text" name="newbalan" placeholder="Баланс"> <input type="text" name="newwin" placeholder="Выйгрыш">
            </div>
            <div align="center" style="margin-top:10px;"><input type="submit" value="Добавить"></div>
            </form>
        </center>
        <h2>Победители</h2>
        <center>
        <form id="zakazform"   method="post" action="?do=save">
        <?php 
         //$f = fopen('tranz.dat','r');
		 if(file_exists('tranz.dat')){
		 $f = file_get_contents('tranz.dat');
		  $str=explode("\n", $f);
		 
         foreach ($str as $key => $value) {
			// echo $value;
			
			
			 $arrval='';
			 $arrval=explode("|", $value);
			 if($arrval[0]!=""){
			 echo '<div style="padding:2px;">';
			 echo'<input type="hidden" name="tr['.$arrval[0].'][id]" value="'.$arrval[0].'">';
			 echo '<input type="text" name="tr['.$arrval[0].'][num]" value="'.$arrval[1].'">';
			 echo '<input type="text" name="tr['.$arrval[0].'][bal]" value="'.$arrval[2].'">';
			 echo '<input type="text" name="tr['.$arrval[0].'][win]" value="'.$arrval[3].'">';

			 echo '</div>';
			}
			 
		 }
		 }
        
		 
		/* 
         while($str = fgets($f))
         {
             preg_match('/(.*)<p>(.*) - (.*) <font size="5" color="(.*)" face="Arial">(.*)<\/font><\/p>/i',$str,$arr);
             
             echo('<div style="padding:2px;"><input type="hidden" name="tr['.$arr[1].'][id]" value="'.$arr[1].'"> <input type="text" name="tr['.$arr[1].'][num]" value="'.$arr[2].'"> <input type="text" name="tr['.$arr[1].'][price]" value="'.$arr[3].'">');
             
             if ($arr[5] == 'Исполнено')
             {
              echo('
              <select name="tr['.$arr[1].'][isp]">
              <option value="Исполнено" selected>Исполнено</option>
              <option value="Не исполнено">Не исполнено</option>
              </select>'); 
             
             } else {
              echo('
              <select name="tr['.$arr[1].'][isp]">
              <option value="Исполнено">Исполнено</option>
              <option value="Не исполнено" selected>Не исполнено</option>
              </select>'); 
             
             }
             echo(' <a href="?do=del&id='.$arr[1].'">Удалить</a></div>'); 
             
         }
         fclose($f);*/
        ?>
        <div align="center" style="margin-top:10px;"><input type="submit" value="Сохранить"></div>
        </center>
       </form>
      </div> 
     </div>
	 
	 
<?php else: ?>
    <style>
        .form form {
  width: 300px;
  margin: 0 auto;
  padding-top: 20px;
}
    </style>
    <center>
            <h2>Кабинет админа</h2>
            <?php
            if ($error)
            {
                echo('<div style="color:red">Не правильный логин или пароль!</div>');
            }
            ?>
</center>            
<div class="form">
<form class="form-horizontal" role="form" method="POST">
  <div class="form-group">
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Логин" name="login">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="Пароль" name="password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default btn-sm">Войти</button>
    </div>
  </div>  
</form>
</div><!-- form  -->
<?php endif; ?>	 
	 
	 
	 
	 
	 
	 
	 
	 
   </div>      
      
 </div>
 </body>
 </html>