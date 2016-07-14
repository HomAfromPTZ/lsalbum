<?php
require_once "./phpmailer/phpmailer/PHPMailerAutoload.php";
// require_once "./mail_config.php";

function adopt($text) {
	return '=?UTF-8?B?'.base64_encode($text).'?=';
}

$response = array();
$message = "";

$cyrillic = array(
	'name' => 'Имя:',
	'email' => 'E-mail:',
	'message' => 'Сообщение:'
);

$c = true;	// Table color switcher
foreach ( $_POST as $key => $value ) {
	if ( $value != "" ) {
		$bgcolor = ($c = !$c) ? "background: #00bfa5;" : "background: #01665F;";

		$message .= "<tr style='border-radius: 10px; overflow: hidden'>";
		$message .= "<td style='padding: 10px; width: 30%;".$bgcolor."color: #f0efe9; border: #00bfa5 1px solid;'><b>{$cyrillic[$key]}</b></td>";
		$message .= "<td style='padding: 10px; width: 70%; background: #DFDFDF; border: #00bfa5 1px solid;'>$value</td></tr>";
	}
}

$message = "<table style='width: 100%;'>$message</table>";

$mail = new PHPMailer;
// $mail->isSMTP();
// $mail->SMTPAuth = true;
// $mail->Host = $hm_host;
// $mail->Username = $hm_username;
// $mail->Password = $hm_password;
// $mail->Port = $hm_port;

// ===================================
// !!! SETTINGS !!!
// ===================================
/*
 * string $hm_email - FROM e-mail, example: "ex@mp.le"
 * string $hm_project - project name, example: "Portfolio"
 * string $hm_subject - form subject, example: "Feedback form"
 */

/* Test settings start */
// Uncomment bellow lines, to check
$hm_email = "test@examp.le";
$hm_project = "hm_portfolio";
$hm_subject = "Обратная связь";
/* Test settings end */

$mail->setFrom($hm_email, $hm_project);
$mail->addAddress($hm_email);
$mail->Subject = adopt($hm_subject);

$mail->setLanguage('ru', 'phpmailer/language/');
$mail->CharSet = 'UTF-8';
$mail->isHTML(true);

$mail->Body = $message;

if(!$mail->send()) {
	// $response = 'Ошибка: ' . $mail->ErrorInfo;
	$response["status"] = "error";
	$response["message"] = "При отправке сообщения произошла ошибка. Попробуйте еще раз";
} else {
	$response["status"] = "sent";
	$response["message"] = "Сообщение отправлено";
}

echo json_encode($response);
exit();