<?php	

require_once('mailer/class.phpmailer.php');

			if(isset($_FILES['cv'])){
	
		$file_name = $_FILES['cv']['name'];
		$file_size =$_FILES['cv']['size'];
		$file_tmp =$_FILES['cv']['tmp_name'];
		$file_type=$_FILES['cv']['type'];   
		@$file_ext=strtolower(end(explode('.',$_FILES['cv']['name'])));
		
		$expensions= array("doc","docx","pdf","jpg","jpeg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
			$error[]= $lang['CV_ERROR_1'];
		}
		if($file_size > 120000){
		$error[]= $lang['CV_ERROR_2'];
		}		
		
		if(empty($error)==true){
		$destination = "file/".$file_name;
			move_uploaded_file($file_tmp,$destination);
			//echo "Success";
		}
		else {
			echo $lang['CV_ERROR_3'];
			echo '<ol>';
			foreach($error as $error){
			echo '<li style="color: red;">'.$error.'</li>';
			echo '<br/>';
			echo '</ol>';
		}
		
		echo '<a href="careers.html"><='.$lang['CV_1'].'</a>';
			
			
			
		}
	}
		
	


if (@count($error) == 0) {

$email = new PHPMailer();
$email->From      = trim($_POST['Email']);
$email->FromName     = trim($_POST['Name']);
$email->Subject   = 'CV SUBMISSION';
$email->Body      = 'Check Attachment';
$email->AddAddress( 'mail@cyzekglobal.com' );

$file_to_attach = $destination;

$email->AddAttachment( $file_to_attach , $file_name);

if ($email->Send()){echo '<span style="color: green;">Success:Your CV has been sent</span>';}


}








  ?>
