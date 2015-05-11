<?php
require_once('../../../wp-config.php');
$appointment_email_id = $_POST['appointment_email_id'];
$appointment_name = trim($_POST['appointment_name']);
$appointment_email = $_POST['appointment_email'];
$appointment_message = $_POST['appointment_message'];
$appointment_phone = trim($_POST['appointment_phone']);
$appointment_persons = $_POST['appointment_persons'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$appointment_subject = $_POST['appointment_subject'];
$site_owners_email =trim($appointment_email_id); 
$error = '';
if ($appointment_name=="") {
	$error['appointment_name'] = "Please enter your name";	
}
if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $appointment_email)) {
	$error['appointment_email'] = "Please enter a valid email address";	
}
if ($appointment_message== "") {
	$error['message'] = "Please leave a comment.";
}
if( $appointment_phone == "" ){
	$error['appointment_phone'] = "Enter Valid Phone Number";
}
if( $appointment_persons == "" ) {
	$error['appointment_persons'] = 'Enter Number Persons';
}
if( $appointment_date == "" ) {
	$error['appointment_date'] = 'Enter reservation date';
}
if( $appointment_time == "" ) {
	$error['appointment_time'] = 'Enter reservation Time';
}
if( $appointment_subject == "" ) {
	$error['appointment_subject'] = 'Enter Subject';
}
if (!$error) {
	$message =  "Reservation Details : \r\n";
	$message .=  "------------------------- \r\n";
	$message .= "Name : " .$appointment_name. "\r\n";
	$message .= "Email Id : " .$appointment_email. "\r\n";
	$message .= "Phone : " .$appointment_phone. "\r\n";
	$message .= "Reservation On : "	.$appointment_date. " " .$appointment_time. "\r\n";
	$message .= "Number Of Persons : " .$appointment_persons. "\r\n";
	$headers = "From: ".$appointment_name." <".$appointment_email.">\r\n"
		."Reply-To: ".$appointment_email."\r\n"
		."X-Mailer: PHP/" . phpversion();
		$mail = wp_mail($site_owners_email, $appointment_subject, $message,$headers);
	echo "<div class='success info_box'>" . $appointment_name . ' '; _e("We've received your Details. We'll be in touch with you as soon as possible!","haircare"); echo "</div>";

} # end if no error
else {
$response ="";
echo $response;
} # end if there was an error sending
?>