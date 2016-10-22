#!/bin/bash
# Just for the record, I was lazy so you need to put in your credentials twice - once in this file and once in the get_tickets.sh file.

bash get_tickets.sh

mostrecent=$(php most_recent_ticket.php)

whmcsurl="https://yourbillingsite.com/clients/admin"

curl -d 'username=yourusername&password=asupersecurepassword' $whmcsurl/dologin.php -c cookie.txt -s

echo "Newest ticket ID: $mostrecent"

curl -b cookie.txt "$whmcsurl/supporttickets.php?action=view&id=$mostrecent" 2>/dev/null > ticketcontents.txt

echo "Checking if the ticket matches keywords..."

c=`cat ticketcontents.txt`

d=`echo $c | grep -e "127.0.0.1" -e "vps is offline" -e "HKG" -e "downtime" -e "reinstall"`

if [ -z "$d" ]; then

echo "The ticket did not return any results. Will not do anything."

else

echo "The ticket matches a keyword - executing response system..."

csrf=`php get_csrf.php`

curl -b cookie.txt -s --data "token=$csrf&message=Test reply&postreply=1&status=Answered&priority=Medium&flagto=nochange&deptid=nochange&returntolist=1&billingaction=0" "$whmcsurl/supporttickets.php?action=viewticket&id=$mostrecent"

echo "Dropped response."

fi
