<?php
	$id=$_GET['del'];
	if($id){
 if(file_exists('tranz.dat')){
		 $f = file_get_contents('tranz.dat');
		  $str=explode("\n", $f);
		 $newstring='';
		 $num=0;
         foreach ($str as $key => $value) {
			// echo $value;
			
			
			 $arrval='';
			 $arrval=explode("|", $value);
			 if($arrval[0]!=$id&&$arrval[0]!=""){
				$num++;
				$newstring.=$num."|".$arrval[1]."|".$arrval[2]."|".$arrval[3]."\n";

			}
			 
		 }
		 file_put_contents('tranz.dat', $newstring);
		 }
		 echo "true";
	}
?>