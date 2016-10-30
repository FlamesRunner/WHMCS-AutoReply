# Function definition helper - DO NOT REMOVE!
define(){ IFS='\n' read -r -d '' ${1} || true; }

# WHMCS Install URL
WHMCS_URL="https://yourbillingsite.com/clients/admin"

# WHMCS Credentials
USERNAME="username"
PASSWORD="password"

# Time between checks for new tickets (in seconds)
TIME_BETWEEN_CHECKS = 300

# Define the keywords in a support ticket to reply to, one line per phrase
define KEYWORDS <<EOT
server
downtime
down
not online
packet loss
ddos
attacked
packets
slow
loading
bad
EOT