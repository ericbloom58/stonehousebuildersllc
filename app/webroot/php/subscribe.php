<?php	
	require_once 'MCAPI.class.php';
	$api = new MCAPI('a5016a73d68a81c5a764e990d741284b-us10');	
	$merge_vars = array();
	
	// Submit subscriber data to MailChimp
	// For parameters doc, refer to: http://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php
	$retval = $api->listSubscribe( 'ec11379951', $_POST["subscribe-mail"], $merge_vars, 'html', true, true );
	
	if ($api->errorCode){
		echo "<h4>An <strong>unexpected error</strong> occured. Please Try Again later.</h4>";
	} else {
		echo "<h4>Thank you, you have been added to our mailing list.</h4>";
	}
?>
