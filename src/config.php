<?php
	/*
		Configuration:
		WHMCS_LOCATION: Enter your WHMCS API URL.
		WHMCS_APIID: Enter your WHMCS API username.
		WHMCS_SECRET: Enter your WHMCS API secret.
		$keywords: The array of 'keywords' to look for to determine whether or not to automatically reply.
		$keywordsFoundUntilReply: The number of keywords we're looking for in a message before we send the canned reply.
		$cannedMessage: The canned message to send.
	*/

	DEFINE("WHMCS_LOCATION", "https://example.com/whmcs/includes/api.php");
	DEFINE("WHMCS_APIID", "");
	DEFINE("WHMCS_SECRET", "");

	$keywords = array("server", "downtime", "down", "not online", "packet loss", "ddos", "attacked", "packets", "slow", "loading", "bad");
	$keywordsFoundUntilReply = 3;

	// $cannedMessage = "We understand that this is very important to you. We're working on it as we speak and will get back to you shortly.";

	$cannedMessage = "
		Thank you for your ticket. We're working on it at this time and will get back to you shortly.
	";
?>
