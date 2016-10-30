#!/bin/bash

echo <<EOT
__        ___   _ __  __  ____ ____  
\ \      / / | | |  \/  |/ ___/ ___| 
 \ \ /\ / /| |_| | |\/| | |   \___ \ 
  \ V  V / |  _  | |  | | |___ ___) |
   \_/\_/  |_| |_|_|  |_|\____|____/ 
    _   _   _ _____ ___  ____  _____ ____  _  __   __
   / \ | | | |_   _/ _ \|  _ \| ____|  _ \| | \ \ / /
  / _ \| | | | | || | | | |_) |  _| | |_) | |  \ V / 
 / ___ \ |_| | | || |_| |  _ <| |___|  __/| |___| |  
/_/   \_\___/  |_| \___/|_| \_\_____|_|   |_____|_|
=========================================================
EOT

# Grab configuration from config.sh
source config.sh

while true;
do
	# Save the WHMCS cookies in a file... (login process)
	echo "Logging into WHMCS admin..."
	curl -d "username=$USERNAME&password=$PASSWORD" $WHMCS_URL/dologin.php -c .tmp/cookie.txt -s

	# Use the WHMCS cookies retrieved
	echo "Getting support tickets..."
	curl -b .tmp/cookie.txt "$WHMCS_URL/supporttickets.php" 2>/dev/null > .tmp/tickets.txt

	# Retrieve the latest ticket ID and output
	LATEST_TICKET_ID=$(php scripts/getLatestTicket.php)
	echo "Latest ticket ID: $LATEST_TICKET_ID"

	echo "Getting ticket contents..."
	curl -b .tmp/cookie.txt "$WHMCS_URL/supporttickets.php?action=view&id=$LATEST_TICKET_ID" 2>/dev/null > .tmp/ticketcontents.txt

	echo "Checking if the ticket contains the preset keywords..."
	TICKET_CONTENTS=`cat .tmp/ticketcontents.txt`

	REPLY=false

	for i in $KEYWORDS; do
		if [[ -z "$(echo $TICKET_CONTENTS | grep -e $i)" ]]; then
			$REPLY=true
			break
		fi
	done

	if [ $REPLY == 'false' ];
	then
		echo "The ticket did not return any results. Will not do anything."

	else
		echo "The ticket matches a keyword - executing response system..."

		CSRF_TOKEN=$(php scripts/getCSRFtoken.php)
		curl -b cookie.txt -s --data "token=$CSRF_TOKEN&message=Test reply&postreply=1&status=Answered&priority=Medium&flagto=nochange&deptid=nochange&returntolist=1&billingaction=0" "$WHMCS_URL/supporttickets.php?action=viewticket&id=$LATEST_TICKET_ID"

		echo "Dropped response."
	fi

	echo "========================================================="
	echo ""
	echo "Sleeping for $(expr $TIME_BETWEEN_CHECKS/60) minutes..."
	sleep TIME_BETWEEN_CHECKS
done