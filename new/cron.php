<?php
	require "WHMCS.php";
	require "config.php";


	$whmcsObject = new WHMCS(WHMCS_APIID, WHMCS_SECRET, WHMCS_LOCATION);
	if (!$whmcsObject->verifyCredentials())
		die("Failed to authenticate.");

	$tickets = $whmcsObject->getTickets();
	if ($tickets["result"] == "failiure") die("Could not obtain tickets.");

	if ($tickets["totalresults"] == "0") die("No tickets need to be replied to at this time.");
	foreach ($tickets["tickets"]["ticket"] as $ticket) {
		$ticketArray = $whmcsObject->fetchTicket($ticket["tid"]);
		$shouldReply = false;
		foreach ($keywords as $word) {
			if (strpos($ticketArray["replies"]["reply"][0], $word)) $shouldReply = true;
		}
		if ($shouldReply) {
			$res = $whmcsObject->ticketReply($ticket["tid"], $cannedMessage);
			if ($res) {
				echo "Successfully replied to ticket " . $ticket["tid"] . ".";
			} else {
				echo "Could not reply to ticket " . $ticket["tid"] . ".";
			}
		}
	}
	echo "Script execution complete.";
?>

