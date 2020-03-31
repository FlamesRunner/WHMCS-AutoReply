<?php
	/*
		Configuration:
		WHMCS_LOCATION: Enter your WHMCS API URL.

	*/
	DEFINE("WHMCS_LOCATION", "https://example.com/whmcs/includes/api.php");
	DEFINE("WHMCS_APIID", "");
	DEFINE("WHMCS_SECRET", "");

	$keywords = array("server", "downtime", "down", "not online", "packet loss", "ddos", "attacked", "packets", "slow", "loading", "bad");

	// $cannedMessage = "We understand that this is very important to you. We're working on it as we speak and will get back to you shortly.";

	$cannedMessage = "
		Thank you for your ticket. We're working on it at this time and will get back to you shortly.
	";
?>
