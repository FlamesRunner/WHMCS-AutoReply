<?php
	/*
		Configuration:
		WHMCS_LOCATION: Enter your WHMCS API URL.

	*/
	DEFINE("WHMCS_LOCATION", "https://example.com/whmcs/includes/api.php");
	DEFINE("WHMCS_APIID", "");
	DEFINE("WHMCS_SECRET", "");

	$keywords = array("server", "downtime", "down", "not online", "packet loss", "ddos", "attacked", "packets", "slow", "loading", "bad");

	$cannedMessage = "
		Thank you for your ticket. We're working on it at this time and will get back to you shortly.
	";
?>
