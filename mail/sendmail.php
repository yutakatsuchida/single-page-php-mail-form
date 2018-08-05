<?php

	require_once("functions.php");
	$errorFlag = false;
	$errorMessages = array();
	$msg = "";

	if(empty($_POST["fullname"])):
		$errorMessages[] = "Full Name is empty";
		$errorFlag = true;
	endif;

	if (empty($_POST["email"])):
		$errorMessages[] = "Email is empty";
		$errorFlag = true;
	elseif (!is_email($_POST["email"])):
		$errorMessages[] = "Invalid Email Address";
		$errorFlag = true;
	endif;

	if (empty($_POST["tel"])):
		$errorMessages[] = "Telephone Number is empty";
		$errorFlag = true;
	elseif(!is_telephonenumber($_POST["tel"])):
		$errorMessages[] = "Invalid Telephone Number";
		$errorFlag = true;
	endif;

	if (empty($_POST["message"])):
		$errorMessages[] = "Message is empty";
		$errorFlag = true;
	endif;

	if (($_POST["province"]) == ""):
		$errorMessages[] = "Province is not choosed";
		$errorFlag = true;
	endif;

	if (empty($_POST["optionsRadios"])):
		$errorMessages[] = "optionsRadios is not choosed";
		$errorFlag = true;
	endif;

	if (empty($_POST["checkbox"])):
		$errorMessages[] = "Checkbox is not choosed";
		$errorFlag = true;
	endif;


	

	// There is no error, send an email
	if (!$errorFlag) {
		require_once("config.php");
		
		if (mb_send_mail(YOUR_EMAIL, QUESTIONER_SUBJECT, $to_you_massage, $to_you_header)) {
			// if the message is sent
			print EMAIL_TO_YOU_SUCCESS;
		} else {
			// if the message is failed to send
			print EMAIL_TO_YOU_FAILED;
		}

		print "<br>";

		//If AUTO_REPLY_EMAIL is enable
		if(EMAIL_TO_QUESTIONER){

			$to_questioner_body = preg_replace("/\x0D\x0A|\x0D|\x0A/", "\n", $to_questioner_body);
			if (mb_send_mail(QUESTIONER_EMAIL, EMAIL_TO_QUESTIONER_SUBJECT, $to_questioner_body, $to_questioner_header)){
				// if the message is sent
				print EMAIL_TO_QUESTIONER_SUCCESS;
			} else {
				// if the message is failed to send
				print MAIL_TO_QUESTIONER_FAILED;
			}
			
		}
	} else {
		// display an error message
		$msg .= "<p>Please confirm the following information.</p>";
		$msg .= "<ul>";
		foreach ($errorMessages as $errorMessage) {
			$msg .= "<li>" . $errorMessage . "</li>";
		}
		$msg .= "</ul>";
		print $msg;
	}

?>