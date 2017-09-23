<?php
	$mailto='dmk0s@yandex.ru';// сюда пишем свой емайл
	$frommail='dmk0s@yandex.ru';// адрес отправителя если что впишите емайл со своим доменом, и создайте сам емайл на хостинге
	
	
	$pole1=$_POST['pole1'];
	$pole2 = $_POST['pole2'];
	$pole3 = $_POST['pole3'];

	

if(!$pole1||!$pole2||!$pole3)
{
	$error=$error.'<p>Введите все поля</p>';
}

if(!$error)
{	
$title='Данные с сайта';	
$mess='';
$mess="Тема: Данные с сайта";
$mess=$mess."\r\nНомер транзакции: ".$pole1;
$mess=$mess."\r\nКуда переводить: ".$pole2;
$mess=$mess."\r\nСумма: ".$pole3;

        // функция, которая отправляет наше письмо. 
        mail($mailto, $title, $mess, 'From:'.$frommail);


echo'true';	
}
else
{
    
echo $error;	
}	

	



?>