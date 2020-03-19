<?php

	echo "good";
	
	$to = $_GET['to'];
	$subject = $_GET['subject'];
	$msg = $_GET['msg'];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-Type: text/plain; charset=iso-8859-1' . "\r\n";

	mail($to, $subject, $msg, $headers);

?> 