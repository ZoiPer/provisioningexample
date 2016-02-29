<?php
	
	function ver_to_int($ver) {
		$arr = explode('.', $ver);
		$f = (int) $arr[0];
		$s = (int) $arr[1];
		return $f * 10000 + $s;
	}


	// iOS URL
	$username = $_GET["u"];
	if ($username == "") 
		$username = $_GET["username"];
	

	$password = $_GET["p"];
	if ($password == "")
		$password = $_GET["password"];

	$version = $_GET["v"]; //Put isset for the version
	if ($version == "")
		$version = $_GET["version"];


	// 1. Validating of the username and password

	$result = $ws->Get_Account_Attribute($key, "uipass", $username);

	$status = $result[1];

	if ($status == "Get_Account_Attribute SUCCESS") {

		
		$secret = $result[0];

		if ($secret == $password && $version == null || ver_to_int($version) === ver_to_int("1.0") ) {

			// 2. If the credentials are correct and the version is 1.0 or doesn't persist send the following config

			$xml = new DOMDocument("1.0", "UTF-8");

			$options = $xml->createElement("options");
			$accounts = $xml->createElement("accounts");
			$account = $xml->createElement("account");
			$element = $xml->createElement("username", $username);
			$account->appendChild($element);
			if ($so == "ios")
			{
				$element = $xml->createElement("password", $password);
				$account->appendChild($element);
			}
			$element = $xml->createElement("tech", 0);
			$account->appendChild($element);
			$element = $xml->createElement("host", "");
			$account->appendChild($element);
			$element = $xml->createElement("port", "5060");
			$account->appendChild($element);
			if ($so == "android")
				$element = $xml->createElement("outbound_proxy", 0);
			else
				$element = $xml->createElement("use_outbound_proxy", 0);
			$account->appendChild($element);
			$element = $xml->createElement("outbound_proxy_port", "5060");
			$account->appendChild($element);
			$element = $xml->createElement("register_on_startup", 1);
			$account->appendChild($element);
			$element = $xml->createElement("context", "");
			$account->appendChild($element);
			$element = $xml->createElement("reregistration_time", 60);
			$account->appendChild($element);
			$element = $xml->createElement("transport_type", 0);
			$account->appendChild($element);
			$element = $xml->createElement("use_stun", 0);
			$account->appendChild($element);
			$element = $xml->createElement("stun_host", "");
			$account->appendChild($element);
			$element = $xml->createElement("stun_port", 3478);
			$account->appendChild($element);
			$element = $xml->createElement("stun_refresh_period", "");
			$account->appendChild($element);
			$element = $xml->createElement("use_rport", 1);
			$account->appendChild($element);
			$element = $xml->createElement("use_rport_media", 0);
			$account->appendChild($element);
			$element = $xml->createElement("dtmf_style", 0);
			$account->appendChild($element);
			$accounts->appendChild($account);
			$options->appendChild($accounts);

			$codecs = $xml->createElement("codecs");
			$codec = $xml->createElement("codec");
			$element = $xml->createElement("codec_id", 27);
			$codec->appendChild($element);
			$element = $xml->createElement("name", "iLBC30");
			$codec->appendChild($element);
			$element = $xml->createElement("priority", 5);
			$codec->appendChild($element);
			$element = $xml->createElement("selected", 1);
			$codec->appendChild($element);
			$codecs->appendChild($codec);
			$options->appendChild($codecs);
			$xml->appendChild($options);

			echo $xml->saveXML($xml, LIBXML_NOEMPTYTAG);
		} 
	
		elseif ($secret == $password && ver_to_int($version) > ver_to_int("1.0") ) {

			// 3. If the credentials are correct and the version is greater than 1.0 send the following config

			$xml = new DOMDocument("1.0", "UTF-8");

			$options = $xml->createElement("options");
			$prov_version = $xml->createElement("prov_version");
			$customer_sid = $xml->createElement("customer_sid");
			$prov_id = $xml->createElement("prov_id");
			$prov_name = $xml->createElement ("prov_name");
			$accounts = $xml->createElement("accounts");
			$account = $xml->createElement("account");
			$ident = $xml->createElement("ident");
			$name = $xml->createElement("name");
			$username = $xml->createElement("username", $username);
			$password = $xml->createElement("password", $password);
			$element = $xml->createElement("tech", 0);
			$account->appendChild($element);
						
			/* Possible values: true, false ; 
			
			Controls startup registration of the account. */
			
			$element = $xml->createElement("register_on_startup", true);
			$account->appendChild($element);

			/* Possible values: true, false ; 
			
			Controls the use of push notifications. */
			
			$element = $xml->createElement("enable_push_notifications", true);
			$account->appendChild($element);
						
			/*Possible values: true, false ;
			
			Optional enabales ring-back tones.*/
			
			$element = $xml->createElement("do_not_play_ringback_tones", true);
			$account->appendChild($element);
			
			/*Possible values: string ;
			
			Optional voice mail extension.*/
			
			$element = $xml->createElement("voicemail_check_extension", "");
			$account->appendChild($element);
			
			/*Possible values: string ;
			
			Optional voice mail transfer extension.*/
			
			$element = $xml->createElement("voicemaile_transfer_extension", "");
			$account->appendChild($element);
			
			/*Possible values: true, false ; 
			
			Optional, forces rfc3264.*/
			
			$element = $xml->createElement("force_rfc3264", true);
			$account->appendChild($element);
			
			$element = $xml->createElement("use_kpml", true);
			$account->appendChild($element);
			
			$element = $xml->createElement("use_overlap_dialing", true);
			$account->appendChild($element);
			
			$element = $xml->createElement("use_custom_ringtone", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("custom_ringtone_location", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("use_custom_certificate", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("custom_certificate_location", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("custom_certificate", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("mwi_subscribe_usage", false);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("use_number_rewriting", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("number_rewriting_country", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("number_rewriting_prefix", false);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("use_strip_dial_chars", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("strip_dial_chars", ".- ()[]{}");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("token", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("balance_url", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("rate_url", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("quality_rating_url", "");
			$account->appendChild($element);
			
			/*Possible values: SIP, IAX2, XMPP, RTSP
			
			Protocol. Controls the presence of configuration blocks: SIP, IAX2*/
			
			$element = $xml->createAttribute("protocol", "SIP");
			$account->appendChild($element);
			
			$element = $xml->createElement("reregistration_time", 600);
			$account->appendChild($element);
			
			//check the provisioning documentation for this one - is it string or ULONG
			
			$element = $xml->createAttribute("resubscription_mode", "default");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("resubscription_time", "1800");
			$account->appendChild($element);
			
			$element = $xml->createElement("SIP_domain", "");
			$account->appendChild($element);
			
			$element = $xml->createElement("port", "5060");
			$account->appendChild($element);
			
			$element = $xml->createElement("SIP_use_outbound_proxy", true);
			$account->appendChild($element);
			
			$element = $xml->createElement("SIP_outbound_proxy", "");
			$account->appendChild($element);
			
			$element = $xml->createElement("SIP_transport_type", "UDP");
			$account->appendChild($element);
			
			$account->appendChild($element);
			$element = $xml->createElement("outbound_proxy_port", "5060");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_use_auth_username", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_auth_username", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_callerid", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_use_rport", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_use_rport_media", false);
			$account->appendChild($element);

			$element = $xml->createAttribute("SIP_srtp_mode", "none");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_dtmf_style", "rfc_2833");
			$account->appendChild($element);

			$element = $xml->createAttribute("SIP_use_blf", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_publish_presence", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_subscribe_presence", true);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("SIP_keep_alive_mode", "disabled");
			$account->appendChild($element);
						
			$element = $xml->createAttribute("SIP_keep_alive_timeout", 90);
			$account->appendChild($element);
			
			$element = $xml->createAttribute("XMPP_Jid", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("XMPP_name", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("XMPP_server", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("XMPP_legacy_tls", false);
			$account->appendChild($element);
			
			$stun = $xml->createAttribute("stun");
			
			$element = $xml->createAttribute("use_stun", "custom");
			$stun->appendChild($element);
										
			$element = $xml->createAttribute("stun_host", "");
			$stun->appendChild($element);
											
			$element = $xml->createAttribute("stun_port", 3478);
			$stun->appendChild($element);
			
			$element = $xml->createAttribute("stun_refresh_period", 40);
			$stun->appendChild($element);
															
			$account->appendChild($stun);
											
			$element = $xml->createAttribute("IAX2_host", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("IAX2_context", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("IAX2_callerid", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("IAX2_callerNumber", "");
			$account->appendChild($element);
			
			$element = $xml->createAttribute("IAX2_dtmf_style", "");
			$account->appendChild($element);
			
			$msrp = $xml->createAttribute("msrp");
			
			$element = $xml->createAttribute("enable_msrp", true);
			$msrp->appendChild($element);
			
			$element = $xml->createAttribute("enable_file_transfer", true);
			$msrp->appendChild($element);
			
			$element = $xml->createAttribute("force_msrp_for_chat", true);
			$msrp->appendChild($element);
			
			$element = $xml->createAttribute("enable_msrp_relay", true);
			$msrp->appendChild($element);

			$element = $xml->createAttribute("relay_uri", "");
			$msrp->appendChild($element);
			
			$element = $xml->createAttribute("relay_usrname", "");
			$msrp->appendChild($element);
			
			$element = $xml->createAttribute("relay_password", true);
			$msrp->appendChild($element);
						
			$account->appendChild($msrp);
										
			/*Possible values: unsigned int
				Internal codec id
				Current list:
				0 - uLaw
				1 - GSM
				6 - aLaw
				7 - g722
				16 - g729
				24 - Speex
				25 - Speex wide
				26 - Speex ultra
				27 - iLBC30
				29 - g726
				30 - H263 Plus
				31 - VP8
				34 - Opus narrow
				35 - Opus wide
				36 - Opus super
				37 - Opus full
			*/
																						
			$codecs = $xml->createElement("codecs");
			$codec = $xml->createElement("codec");
			$element = $xml->createElement("codec_id", 27);
			$codec->appendChild($element);
			$element = $xml->createElement("name", "iLBC30");
			$codec->appendChild($element);
			$element = $xml->createElement("priority", 1);
			$codec->appendChild($element);
			$element = $xml->createElement("enabled", true);
			$codec->appendChild($element);
			$element = $xml->createElement("bps", 0);
			$codec->appendChild($element);
			$element = $xml->createElement("dtx", 0);
			$codec->appendChild($element);
			$element = $xml->createElement("vbr", 0);
			$codec->appendChild($element);
			$codecs->appendChild($codec);
			$options->appendChild($codecs);
			$xml->appendChild($options);
			
			$diagnostics = $xml->createElement("diagnostics");
			
			$element = $xml->createAttribute("enable_debug_log", false);
			$diagnostics->appendChild($element);
			
			$element = $xml->createAttribute("enable_extra_dmp", false);
			$diagnostics->appendChild($element);

			$element = $xml->createAttribute("enable_audio_debug", false);
			$diagnostics->appendChild($element);
			
			$options->appendChild($diagnostics);
			
			echo $xml->saveXML($xml, LIBXML_NOEMPTYTAG);
		} else {
			echo "<error>Wrong username or password.</error>";
		}
	}
	else
		echo "<error>Wrong username or password.</error>";
?>
