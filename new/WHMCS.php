<?php
	class WHMCS {
		public $api_user, $api_url;
		private $api_pass;

		public function __construct($api_user, $api_pass, $api_url) {
			$this->api_user = $api_user;
			$this->api_pass = $api_pass;
			$this->api_url = $api_url;
		}

		private function curlRequest ($postfields) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->api_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_fields($postfields));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec($ch);
			if (curl_error($ch)) {
				return "curl_failiure";
			}
			return json_decode($response, true);
		}

		private function verifyCredentials() {
			$resp = $this->curlRequest(array(
				"action" => "ValidateLogin",
				"username" => $this->api_user,
				"password" => $this->api_pass,
				"responsetype" => "json"
			));
			if (is_array($resp)) {
				if ($resp["result"] == "success") return true; // Authentication success
				return false; // Authentication failed
			} else {
				return false; // cURL issue
			}
		}

		public function getTickets() {
			$resp = $this->curlRequest(array(
				"action" => "GetTickets",
				"username" => $this->api_user,
				"password" => $this->api_pass,
				"status" => "Awaiting Reply",
				"responsetype" => "json"
			));
			if (is_array($resp)) {
				if ($resp["result"] == "success") {
					return $resp;
				}
				return array("result" => "failiure");
			} else {
				return array("result" => "failiure");
			}
		}

		public function fetchTicket($ticketID) {
			$resp = $this->curlRequest(array(
				"action" => "GetTicket",
				"username" => $this->api_user,
				"password" => $this->api_pass,
				"responsetype" => "json"
			));
			if (is_array($resp)) {
				if ($resp["result"] == "success") {
					return $resp;
				} else {
					return array("result" => "failiure");
				}
			} else {
				return array("result" => "failiure");
			}	
		}

		public function ticketReply($ticketID, $message) {
			$resp = $this->curlRequest(array(
				"action" => "AddTicketReply",
				"username" => $this->api_user,
				"password" => $this->api_pass,
				"ticketid" => $ticketID,
				"message" => $message,
				"responsetype" => "json"
			));
			if (is_array($resp)) {
				return ($resp["result"] == "success");
			} else {
				return false; // cURL error
			}	
		}
	}
?>