<?php

$spam_ochrana = "sirob";

$name = $_POST['name'];
$email = $_POST['email'];
$ochrana = $_POST['ochrana'];
$message = $_POST['message'];


if ($spam_ochrana == $ochrana) {
	
	$formcontent="Meno a Priezvisko: $name \nEmail: $email \n \nSpráva:\n $message";
	$recipient = "boris.belica2@gmail.com";
	$subject = "Kontatkný formulár - Boris Belica WEB";

	$mailheader = "Od: $email \r\n";

	mail($recipient, $subject, $formcontent, $mailheader) or die("CHYBA! Správa nebola odoslaná!");
	echo "Ďakujeme za Vašu správu!" . " -" . "<a href='index.html' style='text-decoration:none;color:#ff0099;'> Return Home</a>";
	
}

else {
	
	echo "Spam ochrana!" . " -" . "<a href='index.html' style='text-decoration:none;color:#ff0099;'> Return Home</a>";
	
}

?>
