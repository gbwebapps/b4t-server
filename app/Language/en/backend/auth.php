<?php

return [
	'title' => [
		'login' => 'Login', 
		'recovery' => 'Recovery password', 
		'setPassword' => 'Set password', 
	], 
	'form' => [
		'passwordField' => 'Password', 
		'passwordPlaceholder' => 'Enter here your password...', 
		'remeberMeCheckBox' => 'Remember me', 
		'emailField' => 'Email', 
		'emailPlaceholder' => 'Enter here your email...', 
		'authCodeField' => 'Auth code', 
		'authCodePlaceholder' => 'Enter here your auth code...', 
		'newPasswordField' => 'New password', 
		'newPasswordPlaceholder' => 'Enter here your new password...', 
		'confirmationPasswordField' => 'Confirmation new password', 
		'confirmationPasswordPlaceholder' => 'Enter again your new password...', 
	], 
	'messages' => [
		'loginSuccess' => '', 
		'loginFail' => 'Invalid login!', 
		'recoverySuccess' => 'The user <b>{0}</b>, with ID <b>{1}</b>, has been resetted the password successfully!', 
		'recoveryNoMailSuccess' => 'The user <b>{0}</b>, with ID <b>{1}</b>, has been resetted the password successfully, 
								  but there were some problems with email recovery sending. Please, contact the administrator!', 
		'recoveryFail' => 'There was an error in attempting to reset the password!', 
		'setPasswordSuccess' => '<b>{0} {1}</b>, your new password has been setted successfully! Now you can log in!', 
		'setPasswordFail' => 'There was an error in attempting to set the new password!', 
		'errorActivationCode' => 'The Activation code it is not valid.',
		'errorCheckEmail' => 'Email address doesn\'t exist!', 
	], 
	'links' => [
		'login' => 'Login', 
		'recovery' => 'Recovery password', 
		'setPassword' => 'Set password', 
	]
];