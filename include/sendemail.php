<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$toemails = array();

$toemails[] = array(
				'email' => 'wilsonafs@hotmail.com', // Your Email Address
				'name' => 'Formulário de Contato UnicaIP' // Your Name
			);

// Form Processing Messages
$message_success = 'Nós<strong> recebemos</strong> com sucesso, entraremos em contato o mais breve possível.';

// Add this only if you use reCaptcha with your Contact Forms
$recaptcha_secret = ''; // Your reCaptcha Secret

$mail = new PHPMailer();

// If you intend you use SMTP, add your SMTP Code after this Line


if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	if( $_POST['template-contactform-email'] != '' ) {

		$name = isset( $_POST['template-contactform-name'] ) ? $_POST['template-contactform-name'] : '';
		$email = isset( $_POST['template-contactform-email'] ) ? $_POST['template-contactform-email'] : '';
		$phone = isset( $_POST['template-contactform-phone'] ) ? $_POST['template-contactform-phone'] : '';
		$message = isset( $_POST['template-contactform-message'] ) ? $_POST['template-contactform-message'] : '';
		$operadora = isset( $_POST['template-contactform-operadora'] ) ? $_POST['template-contactform-operadora'] : '';
		$faixa = isset( $_POST['template-contactform-faixa'] ) ? $_POST['template-contactform-faixa'] : '';

		if ($faixa=="template-contactform-faixa") {
			echo "<p>Minha faixa de ganho é de até 1500</p>";
		}

		$subject = $subject ? $subject : 'New Message From Contact Form';

		$botcheck = $_POST['template-contactform-botcheck'];

		if( $botcheck == '' ) {

			$mail->SetFrom( $email , $name );
			$mail->AddReplyTo( $email , $name );
			foreach( $toemails as $toemail ) {
				$mail->AddAddress( $toemail['email'] , $toemail['name'] );
			}
			$mail->Subject = $subject;

			$name = isset($name) ? "Nome: $name<br><br>" : '';
			$email = isset($email) ? "E-mail: $email<br><br>" : '';
			$phone = isset($phone) ? "Telefone: $phone<br><br>" : '';
			$message = isset($message) ? "Mensagem: $message<br><br>" : '';
			$operadora = isset($operadora) ? "Operadora: $operadora<br><br>" : '';
			$faixa = isset($faixa) ? "Faixa de ganho: $faixa<br><br>" : '';


			$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Essa mensagem foi enviada pelo site: ' . $_SERVER['HTTP_REFERER'] : '';

			$body = "$name $email $phone $message $operadora $faixa $referrer";

			// Runs only when File Field is present in the Contact Form
			if ( isset( $_FILES['template-contactform-file'] ) && $_FILES['template-contactform-file']['error'] == UPLOAD_ERR_OK ) {
				$mail->IsHTML(true);
				$mail->AddAttachment( $_FILES['template-contactform-file']['tmp_name'], $_FILES['template-contactform-file']['name'] );
			}

			// Runs only when reCaptcha is present in the Contact Form
			if( isset( $_POST['g-recaptcha-response'] ) ) {

				$recaptcha_data = array(
					'secret' => $recaptcha_secret,
					'response' => $_POST['g-recaptcha-response']
				);

				$recap_verify = curl_init();
				curl_setopt( $recap_verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
				curl_setopt( $recap_verify, CURLOPT_POST, true );
				curl_setopt( $recap_verify, CURLOPT_POSTFIELDS, http_build_query( $recaptcha_data ) );
				curl_setopt( $recap_verify, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $recap_verify, CURLOPT_RETURNTRANSFER, true );
				$recap_response = curl_exec( $recap_verify );

				$g_response = json_decode( $recap_response );

				if ( $g_response->success !== true ) {
					echo '{ "alert": "error", "message": "Captcha not Validated! Please Try Again." }';
					die;
				}
			}

			// Uncomment the following Lines of Code if you want to Force reCaptcha Validation

			// if( !isset( $_POST['g-recaptcha-response'] ) ) {
			// 	echo '{ "alert": "error", "message": "Captcha not Submitted! Please Try Again." }';
			// 	die;
			// }

			$mail->MsgHTML( $body );
			$sendEmail = $mail->Send();

			if( $sendEmail == true ):
				echo '{ "alert": "success", "message": "' . $message_success . '" }';
			else:
				echo '{ "alert": "error", "message": "Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />' . $mail->ErrorInfo . '" }';
			endif;
		} else {
			echo '{ "alert": "error", "message": "Bot <strong>Detected</strong>.! Clean yourself Botster.!" }';
		}
	} else {
		echo '{ "alert": "error", "message": "Please <strong>Fill up</strong> all the Fields and Try Again." }';
	}
} else {
	echo '{ "alert": "error", "message": "An <strong>unexpected error</strong> occured. Please Try Again later." }';
}

?>