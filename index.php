<?php
	
	require("config.php");
	require("functions.php");


	if (!isset($_GET["u"])) 
		error('No username');
	$username = $_GET["u"];
	
	if (!isset($_GET["p"])) 
		error('No password');
	$password = $_GET["p"];
	
	if (!isset($_GET["v"]))  {
		$version = '1.0';
	} else {
		$version = $_GET["v"];
	}


	// 1. Check the username and password

	$res = validate_user($username, $password);

	if (!$res)
		error("Wrong username or password");

		if (ver_to_int($version) === ver_to_int("1.0") ) {

			// 2. If the credentials are correct and the version is 1.0 send the following config

			$xml = new DOMDocument("1.0", "UTF-8");

			$options = $xml->createElement("options");
			$accounts = $xml->createElement("accounts");
			$account = $xml->createElement("account");
			$element = $xml->createElement("username", $username);
			$account->appendChild($element);
			$element = $xml->createElement("password", $password);
			$account->appendChild($element);	
			$element = $xml->createElement("tech", 0);
			$account->appendChild($element);
			$element = $xml->createElement("host", SIP_DOMAIN);
			$account->appendChild($element);
			$element = $xml->createElement("port", "5060");
			$account->appendChild($element);
			$element = $xml->createElement("outbound_proxy", 0);
			$account->appendChild($element);
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
	
		elseif (ver_to_int($version) > ver_to_int("1.0") ) {

		// 3. If the credentials are correct and the version is greater than 1.0 send the following config

			$xml = new DOMDocument("1.0", "UTF-8");

			$options = $xml->createElement("options");
			$element = $xml->createElement("prov_version");
			$element = $xml->createElement("customer_sid");
			$element = $xml->createElement("prov_id");
			$element = $xml->createElement ("prov_name");
			$accounts = $xml->createElement("accounts");
			$account = $xml->createElement("account");
			$element = $xml->createElement("ident");
			$account->appendChild($element);
			$element = $xml->createElement("name");
			$account->appendChild($element);
			$element = $xml->createElement("username", $username);
			$account->appendChild($element);
			$element = $xml->createElement("password", $password);
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
		
			/*Possible values: true, false;
 
			Optional enables kpml.*/
	
			$element = $xml->createElement("use_kpml", true);
			$account->appendChild($element);
			

			/*Possible values: true, false

			Optional enables overlap dialing.*/

			$element = $xml->createElement("use_overlap_dialing", true);
			$account->appendChild($element);
			
			/*Possible values: true, false

			Optional enables custom ringtone.*/

			$element = $xml->createElement("use_custom_ringtone", true);
			$account->appendChild($element);

			/*Possible values: string

			Optional custom ring-tone uri*/
			
			$element = $xml->createAttribute("custom_ringtone_location", "");
			$account->appendChild($element);

			/*Possible values: none, common, location, configuration, self_signed

			Optional custom certificate usage.*/
			
			$element = $xml->createAttribute("use_custom_certificate", "");
			$account->appendChild($element);

			/*Possible values: string

			Optional custom certificate uri.*/
			
			$element = $xml->createAttribute("custom_certificate_location", "");
			$account->appendChild($element);

			/*Possible values: string

			Optional custom certificate data.*/
			
			$element = $xml->createAttribute("custom_certificate", "");
			$account->appendChild($element);

			/*Possible values: disabled, before, after, both

			Optional message waiting indication subscription.*/ 
			
			$element = $xml->createAttribute("mwi_subscribe_usage", "disabled");
			$account->appendChild($element);
			
			/*Possible values: true, false

			Optional enables number rewriting.*/

			$element = $xml->createAttribute("use_number_rewriting", true);
			$account->appendChild($element);

			/*Possible values: string, auto-detect

			Optional specifies country code to be applied to numbers without such one.*/ 
			
			$element = $xml->createAttribute("number_rewriting_country", "");
			$account->appendChild($element);

			/*Possible values: string

			Optional enables number rewriting with custom dialout prefix.*/
			
			$element = $xml->createAttribute("number_rewriting_prefix", "");
			$account->appendChild($element);

			/*Possible values: true, false

			Optional enables the striping of characters from the dial string.*/
			
			$element = $xml->createAttribute("use_strip_dial_chars", true);
			$account->appendChild($element);

			/*Possible values: string

			Optional. The characters that going to be stripped from the dial string.*/
			
			$element = $xml->createAttribute("strip_dial_chars", ".- ()[]{}");
			$account->appendChild($element);
			
			/*Possible values: string

			Optional.*/

			$element = $xml->createAttribute("token", "");
			$account->appendChild($element);

			/*Possible values: string

			Optional.*/
			
			$element =$xml->createAttribute("token_url", "");

			/*Possible values: string

			Optional.*/
			
			$element = $xml->createAttribute("balance_url", "https://example.com/script.php?username=${USERNAME}&amp;password=${PASSWORD}&amp;currency=${CURRENCY}");
			$account->appendChild($element);

			/*Possible values: string

			Optional.*/
			
			$element = $xml->createAttribute("rate_url", "https://example.com/script.php?destination=${DESTINATION}&amp;currency=${CURRENCY}&amp;username=${USERNAME}&amp;password=${PASSWORD}");
			$account->appendChild($element);

			/*Possible values: string

			Optional.*/
			
			$element = $xml->createAttribute("quality_rating_url", "https://example.com/script.php?id=${CALL_IDENTIFIER}&amp;rating=${RATING}");
			$account->appendChild($element);
			
			/*Possible values: SIP, IAX2, XMPP, RTSP
			
			Protocol. Controls the presence of configuration blocks: SIP, IAX2*/
			
			$element = $xml->createAttribute("protocol", "SIP");
			$account->appendChild($element);

			/*Possible values: default, custom

			The default registration refresh should be 600s for TCP and 30s for UDP. 
			Note that the server might enforce different (shorter) refresh time. The stack
			will not wait for the full period to refresh the registration. It will
			try to refresh it after 90% of the negotiated time has elapsed.*/
			
			$element = $xml->createAttribute("registration_mode", "default");
			$account->appendChild($element);
	
			/*Possible values: unsigned long
			
			Use this to specify the reregistration time when the mode selected is custom.*/

			$element = $xml->createElement("reregistration_time", 600);
			$account->appendChild($element);
			
			/*Possible values: default, custom 

			The default subscription refresh should be 1800s for TCP and UDP.*/
			
			$element = $xml->createAttribute("resubscription_mode", "default");
			$account->appendChild($element);

			/*Possible values: unsigned long

			Optional.*/
			
			$element = $xml->createAttribute("resubscription_time", "1800");
			$account->appendChild($element);
			
			/*Possible values: string

			Configures the user domain.*/
			
			$element = $xml->createElement("SIP_domain", SIP_DOMAIN);
			$account->appendChild($element);
			
			/*Possible values: true, false
			
			Optional use outbound proxy.*/
			
			$element = $xml->createElement("SIP_use_outbound_proxy", true);
			$account->appendChild($element);
			
			/*Possible values: string

			Optional SIP proxy server to force instead of the automatically detected one.*/

			$element = $xml->createElement("SIP_outbound_proxy", "");
			$account->appendChild($element);

			/*Possible values: UDP, TCP, TLS

			The signalling protocol.*/ 
			
			$element = $xml->createElement("SIP_transport_type", "UDP");
			$account->appendChild($element);
			
			/*Possible values: true, false

			Optional use authentication username.*/
	
			$element = $xml->createAttribute("SIP_use_auth_username", true);
			$account->appendChild($element);
	
			/*Possible values: string

			Optional username to be used when repsonding to a SIP authentication challenge.*/
		
			$element = $xml->createAttribute("SIP_auth_username", "");
			$account->appendChild($element);

			/*Possible values: string

			Optional display name.*/
			
			$element = $xml->createAttribute("SIP_callerid", "");
			$account->appendChild($element);
			
			/*Possible values: true, false

			This function can be used to discover the public address and port in case
			there is a NAT between the user and the server. It also helps for normal
			unfirewalled TCP and TLS connections (highly recommended for these two protocols).*/

			$element = $xml->createAttribute("SIP_use_rport", true);
			$account->appendChild($element);

			/*Possible values: true, false

			Enables usage of rport discovered public address for media negotiations.
			Can help in some firewall/NAT/VPN setups where the port is not changed,
			only the private address is replaced with a public one. When both rport
			and STUN are enabled, STUN will be preferred.
			This option is not recommended. Enable it only if you absolutely know
			what you're doing.*/
			
			$element = $xml->createAttribute("SIP_use_rport_media", false);
			$account->appendChild($element);

			/*Possible values: none, SDES

			Select the user's SRTP mode.*/

			$element = $xml->createAttribute("SIP_srtp_mode", "none");
			$account->appendChild($element);
			
			/*Possible values: inband, rfc+2833, SIP_info_numeric, SIP_info_ascii, disabled

			Select the DTMF band for the user.*/

			$element = $xml->createAttribute("SIP_dtmf_style", "rfc_2833");
			$account->appendChild($element);

			/*Possible values: true, false
			
			Optional enable busy line field.*/

			$element = $xml->createAttribute("SIP_use_blf", true);
			$account->appendChild($element);

			/*Possible values: true, false

			Optional publish user presence.*/
			
			$element = $xml->createAttribute("SIP_publish_presence", true);
			$account->appendChild($element);

			/*Possible values: true, false

			Optional subscribe for other users presence.*/
			
			$element = $xml->createAttribute("SIP_subscribe_presence", true);
			$account->appendChild($element);
			
			/*Possible values: disabled, default, custom

			Optional.*/

			$element = $xml->createAttribute("SIP_keep_alive_mode", "disabled");
			$account->appendChild($element);
				
			/*Possible values: unsigned long

			Optional.*/
		
			$element = $xml->createAttribute("SIP_keep_alive_timeout", 90);
			$account->appendChild($element);
			
			/*Possible values: string
			
			The Jabber Id of the user.*/

			$element = $xml->createAttribute("XMPP_Jid", "");
			$account->appendChild($element);
			
			/*Possible values: string
			
			Optional full name of the XMPP user.*/

			$element = $xml->createAttribute("XMPP_name", "");
			$account->appendChild($element);
			
			/*Possible values: string

			Optional XMPP connect server.*/

			$element = $xml->createAttribute("XMPP_server", "");
			$account->appendChild($element);

			/*Possible values: true, false

			It governs the usage of the legacy TLS mode for XMPP.*/
			
			$element = $xml->createAttribute("XMPP_legacy_tls", false);
			$account->appendChild($element);

			// stun holds stun related settings.
			
			$stun = $xml->createAttribute("stun");
			
			/*Possible values: disabled, custom, default

			In most cases only disabled and custom are used
			Controls the use of STUN.*/

			$element = $xml->createAttribute("use_stun", "custom");
			$stun->appendChild($element);

			/*Possible values: string
			
			Configures the address of the STUN server.*/
										
			$element = $xml->createAttribute("stun_host", "");
			$stun->appendChild($element);

			/*Possible values: unsigned int
			
			Configures the port of the STUN server.*/
											
			$element = $xml->createAttribute("stun_port", 3478);
			$stun->appendChild($element);

			/*Possible values: unsigned int
			
			Sets the refresh period of the STUN server
			Use this function to specify how often to refresh the STUN server.
			The default is 30 seconds. The refresh can be used to keep the
			NAT mapping alive.*/
			
			$element = $xml->createAttribute("stun_refresh_period", 40);
			$stun->appendChild($element);
															
			$account->appendChild($stun);
			
			/*Possible values: string

			Configures the server address.*/
								
			$element = $xml->createAttribute("IAX2_host", "");
			$account->appendChild($element);
			
			/*Possible values: string
			
			Configures the context to be used.*/

			$element = $xml->createAttribute("IAX2_context", "");
			$account->appendChild($element);
			
			/*Possible values: string

			Optional the display name.*/

			$element = $xml->createAttribute("IAX2_callerid", "");
			$account->appendChild($element);
			
			/*Possible values: string
			
			Configures the user name used for identification.*/

			$element = $xml->createAttribute("IAX2_callerNumber", "");
			$account->appendChild($element);

			/*Possible values: inband, disabled, outband
			
			Select the DTMF band for the user.*/
			
			$element = $xml->createAttribute("IAX2_dtmf_style", "");
			$account->appendChild($element);
			
			/*msrp holds msrp related settings.*/

			$msrp = $xml->createAttribute("msrp");
			
			/*Possible values: true, false
			
			Enable msrp for the user.*/

			$element = $xml->createAttribute("enable_msrp", true);
			$msrp->appendChild($element);
			
			/*Possible values: true, false

			Enable file transfer for the user.*/

			$element = $xml->createAttribute("enable_file_transfer", true);
			$msrp->appendChild($element);
			
			/*Possible values: true, false

			ce user to use msrp for chat messages.*/

			$element = $xml->createAttribute("force_msrp_for_chat", true);
			$msrp->appendChild($element);
			
			/*Possible values: true, false

			ble msrp relay for the user.*/

			$element = $xml->createAttribute("enable_msrp_relay", true);
			$msrp->appendChild($element);

			/*Possible values: string

			MSRP relay uri.*/

			$element = $xml->createAttribute("relay_uri", "");
			$msrp->appendChild($element);

			/*Possible values: string

			Msrp relay username.*/

			$element = $xml->createAttribute("relay_username", "");
			$msrp->appendChild($element);
			
			/*Possible values: string
	
			MSRP relay password.*/

			$element = $xml->createAttribute("relay_password", "");
			$msrp->appendChild($element);
						
			$account->appendChild($msrp);
			
			 /*Codecs holds codec nodes for each supported codec for that.
                        
                        Only one per provisioning xml.*/

			$codecs = $xml->createElement("codecs");
							
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
																			
			$codec = $xml->createElement("codec");
			$element = $xml->createElement("codec_id", 27);
			$codec->appendChild($element);

			/*Possible values: unsigned int

			Codec priority in media negotiations.*/

			$element = $xml->createElement("priority", 1);
			$codec->appendChild($element);

			/*Possible values: true, false

			Controls if the codec is enabled*/

			$element = $xml->createElement("enabled", true);
			$codec->appendChild($element);

			/*Possible values: long

			Optional.*/

			$element = $xml->createElement("bps", 0);
			$codec->appendChild($element);

			/*Possible values: long

			Optional.*/

			$element = $xml->createElement("dtx", 0);
			$codec->appendChild($element);

			/*Possible values: long

			Optional.*/

			$element = $xml->createElement("vbr", 0);
			$codec->appendChild($element);

			$codecs->appendChild($codec);

			$accounts->appendChild($codecs);

			$options->appendChild($accounts);
			
			$diagnostics = $xml->createElement("diagnostics");
			
			/*Possible values: true, false

			Optional enables the debug logging into a file.*/

			$element = $xml->createAttribute("enable_debug_log", false);
			$diagnostics->appendChild($element);
			
			/*Possible values: true, false

			Optional enables the extended crash dump file. Avialable only on Windows.*/

			$element = $xml->createAttribute("enable_extra_dmp", false);
			$diagnostics->appendChild($element);

			/*Possible values: true, false

			Optional enables the audio log files.*/

			$element = $xml->createAttribute("enable_audio_debug", false);
			$diagnostics->appendChild($element);
			
			$options->appendChild($diagnostics);
			
			$xml->appendChild($options);

			echo $xml->saveXML($xml, LIBXML_NOEMPTYTAG);
		} else {
			error("Unknown version");
		}

?>
