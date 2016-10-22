#!/bin/bash

whmcsurl="https://yourbillingsite.com/clients/admin"

# Authenticate
curl -d 'username=yourusernamegoeshere&password=mysupersecurepassword' $whmcsurl/dologin.php -c cookie.txt &>/dev/null

# Get tickets
curl -b cookie.txt "$whmcsurl/supporttickets.php" 2>/dev/null > tickets.txt
