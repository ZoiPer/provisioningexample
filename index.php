<?php
	
	/* THIS IS JUST AN EXAMPLE */	

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

		/* NOTE: This example is prepared according to the latest provisioning configuration implemented in Zoiper,

		In case the application has implemented an older version than the one in this example, then it will skip the newly added 
		parameters and provision only these that are supported.*/

		$xml = new DOMDocument("1.0", "UTF-8");

		$options = $xml->createElement("options");

		/* Possible values: string,

		Version of the provisioning XML.*/

		$element = $xml->createElement("prov_version", "1.12");
		$options->appendChild($element);

		/* Possible values: string,

		Optional unique customer ID.*/

		$element = $xml->createElement("customer_sid", "");
		$options->appendChild($element);

		/* Possible values: string,

		Optional unique provisioning ID.*/

		$element = $xml->createElement("prov_id", "");
		$options->appendChild($element);

		/* Possile values: string,

		Optional name of the provisioning profile.*/

		$element = $xml->createElement ("prov_name", "");
		$options->appendChild($element);

		/* Accounts holds account nodes for each provisioned account.
		Only one per provisionin xml.*/

		$accounts = $xml->createElement("accounts");

		/* Account contains a complete account configuration.*/

		$account = $xml->createElement("account");		

		/* Identifier of the account. Unique and not changeble.*/

		$element = $xml->createElement("ident");
		$account->appendChild($element);

		/* Possible values: string,

		Account display name.*/

		$element = $xml->createElement("name");
		$account->appendChild($element);

		/* Possible values: string,

		Username.*/

		$element = $xml->createElement("username", $username);
		$account->appendChild($element);

		/* Possible values: string,

		Password.*/

		$element = $xml->createElement("password", $password);
		$account->appendChild($element);

		/* Possible values: true, false ; 

		Controls startup registration of the account. */

		$element = $xml->createElement("register_on_startup", true);
		$account->appendChild($element);

		/* Possible values: true, false ; 

		Controls the use of push notifications. */

		$element = $xml->createElement("enable_push_notifications", true);
		$account->appendChild($element);

		/* Possible values: true, false ;

		Optional enabales ring-back tones.*/

		$element = $xml->createElement("do_not_play_ringback_tones", true);
		$account->appendChild($element);

		/* Possible values: string ;

		Optional voice mail extension.*/

		$element = $xml->createElement("voicemail_check_extension", "");
		$account->appendChild($element);

		/* Possible values: string ;

		Optional voice mail transfer extension.*/

		$element = $xml->createElement("voicemaile_transfer_extension", "");
		$account->appendChild($element);

		/* Possible values: true, false ; 

		Optional, forces rfc3264.*/

		$element = $xml->createElement("force_rfc3264", true);
		$account->appendChild($element);

		/* Possible values: true, false;

		Optional enables kpml.*/

		$element = $xml->createElement("use_kpml", true);
		$account->appendChild($element);

		/* Possible values: true, false

		Optional enables overlap dialing.*/

		$element = $xml->createElement("use_overlap_dialing", true);
		$account->appendChild($element);

		/* Possible values: true, false

		Optional enables custom ringtone.*/

		$element = $xml->createElement("use_custom_ringtone", true);
		$account->appendChild($element);

		/* Possible values: string

		Optional custom ring-tone uri*/

		$element = $xml->createElement("custom_ringtone_location", "");
		$account->appendChild($element);

		/* Possible values: none, common, location, configuration, self_signed

		Optional custom certificate usage.*/

		$element = $xml->createElement("use_custom_certificate", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional custom certificate uri.*/

		$element = $xml->createElement("custom_certificate_location", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional custom certificate data.*/

		$element = $xml->createElement("custom_certificate", "");
		$account->appendChild($element);

		/* Possible values: disabled, before, after, both

		Optional message waiting indication subscription.*/ 

		$element = $xml->createElement("mwi_subscribe_usage", "disabled");
		$account->appendChild($element);

		/* Possible values: true, false

		Optional enables number rewriting.*/

		$element = $xml->createElement("use_number_rewriting", true);
		$account->appendChild($element);

		/* Possible values: string, auto-detect

		Optional specifies country code to be applied to numbers without such one.*/ 

		$element = $xml->createElement("number_rewriting_country", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional enables number rewriting with custom dialout prefix.*/

		$element = $xml->createElement("number_rewriting_prefix", "");
		$account->appendChild($element);

		/* Implemented in XML Configuration v1.6

		Possible values: true, false

		Optional enables the striping of characters from the dial string.*/

		$element = $xml->createElement("use_strip_dial_chars", true);
		$account->appendChild($element);

		/* Implemented in XML Configuration v1.6

		Possible values: string

		Optional. The characters that going to be stripped from the dial string.*/

		$element = $xml->createElement("strip_dial_chars", ".- ()[]{}");
		$account->appendChild($element);

		/* Possible values: string

		Optional.*/

		$element = $xml->createElement("token", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional.*/

		$element =$xml->createElement("token_url", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional.*/

		$element = $xml->createElement("balance_url", xml_url ('https://example.com/script.php?username=${USERNAME}&password=${PASSWORD}&currency=${CURRENCY}'));
		$account->appendChild($element);

		/* Possible values: string

		Optional.*/

		$element = $xml->createElement("rate_url", xml_url ('https://example.com/script.php?destination=${DESTINATION}&currency=${CURRENCY}&username=${USERNAME}&password=${PASSWORD}'));
		$account->appendChild($element);

		/* Implemented in XML Configuration v1.7

		Possible values: string

		Optional.*/

		$element = $xml->createElement("quality_rating_url", xml_url ('https://example.com/script.php?id=${CALL_IDENTIFIER}&rating=${RATING}'));
		$account->appendChild($element);

		/* Possible values: SIP, IAX2, XMPP, RTSP

		Protocol. Controls the presence of configuration blocks: SIP, IAX2*/

		$element = $xml->createElement("protocol", "SIP");
		$account->appendChild($element);

		/* Possible values: default, custom

		The default registration refresh should be 600s for TCP and 30s for UDP. 
		Note that the server might enforce different (shorter) refresh time. The stack
		will not wait for the full period to refresh the registration. It will
		try to refresh it after 90% of the negotiated time has elapsed.*/

		$element = $xml->createElement("registration_mode", "default");
		$account->appendChild($element);

		/* Possible values: unsigned long

		Use this to specify the reregistration time when the mode selected is custom.*/

		$element = $xml->createElement("reregistration_time", 600);
		$account->appendChild($element);

		/* Possible values: default, custom 

		The default subscription refresh should be 1800s for TCP and UDP.*/

		$element = $xml->createElement("resubscription_mode", "default");
		$account->appendChild($element);

		/* Possible values: unsigned long

		Optional.*/

		$element = $xml->createElement("resubscription_time", "1800");
		$account->appendChild($element);

		/* Possible values: string

		Configures the user domain.*/

		$element = $xml->createElement("SIP_domain", SIP_DOMAIN);
		$account->appendChild($element);

		/* Possible values: true, false

		Optional use outbound proxy.*/

		$element = $xml->createElement("SIP_use_outbound_proxy", true);
		$account->appendChild($element);

		/* Possible values: string

		Optional SIP proxy server to force instead of the automatically detected one.*/

		$element = $xml->createElement("SIP_outbound_proxy", "");
		$account->appendChild($element);

		/* Possible values: UDP, TCP, TLS

		The signalling protocol.*/ 

		$element = $xml->createElement("SIP_transport_type", "UDP");
		$account->appendChild($element);

		/* Possible values: true, false

		Optional use authentication username.*/

		$element = $xml->createElement("SIP_use_auth_username", true);
		$account->appendChild($element);

		/* Possible values: string

		Optional username to be used when repsonding to a SIP authentication challenge.*/

		$element = $xml->createElement("SIP_auth_username", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional display name.*/

		$element = $xml->createElement("SIP_callerid", "");
		$account->appendChild($element);

		/* Possible values: true, false

		This function can be used to discover the public address and port in case
		there is a NAT between the user and the server. It also helps for normal
		unfirewalled TCP and TLS connections (highly recommended for these two protocols).*/

		$element = $xml->createElement("SIP_use_rport", true);
		$account->appendChild($element);

		/* Possible values: true, false

		Enables usage of rport discovered public address for media negotiations.
		Can help in some firewall/NAT/VPN setups where the port is not changed,
		only the private address is replaced with a public one. When both rport
		and STUN are enabled, STUN will be preferred.
		This option is not recommended. Enable it only if you absolutely know
		what you're doing.*/

		$element = $xml->createElement("SIP_use_rport_media", false);
		$account->appendChild($element);

		/* Possible values: none, SDES

		Select the user's SRTP mode.*/

		$element = $xml->createElement("SIP_srtp_mode", "none");
		$account->appendChild($element);

		/* Possible values: inband, rfc+2833, SIP_info_numeric, SIP_info_ascii, disabled

		Select the DTMF band for the user.*/

		$element = $xml->createElement("SIP_dtmf_style", "rfc_2833");
		$account->appendChild($element);

		/* Possible values: true, false

		Optional, enable busy line field.*/

		$element = $xml->createElement("SIP_use_blf", true);
		$account->appendChild($element);

		/* Possible values: true, false

		Optional, publish user presence.*/

		$element = $xml->createElement("SIP_publish_presence", true);
		$account->appendChild($element);

		/* Possible values: true, false

		Optional, subscribes for other user's presence.*/

		$element = $xml->createElement("SIP_subscribe_presence", true);
		$account->appendChild($element);

		/* Possible values: disabled, default, custom

		Optional.*/

		$element = $xml->createElement("SIP_keep_alive_mode", "disabled");
		$account->appendChild($element);
	
		/* Possible values: unsigned long

		Optional.*/

		$element = $xml->createElement("SIP_keep_alive_timeout", 90);
		$account->appendChild($element);
	
		/* Implemented in XML Configuration v1.10

		Possible values: true, false

		Optional, enables preconditions.*/

		$element = $xml->createElement("SIP_use_preconditions", true);
		$account->appendChild($element);


		/* Implemented in XML Configuration v1.12

		Possible values: true, false

		Optional, enables reg events.*/

		$element = $xml->createElement("SIP_use_reg_event", false);
		$account->appendChild($element);

		/* Possible values: string

		The Jabber Id of the user.*/

		$element = $xml->createElement("XMPP_Jid", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional full name of the XMPP user.*/

		$element = $xml->createElement("XMPP_name", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional XMPP connect server.*/

		$element = $xml->createElement("XMPP_server", "");
		$account->appendChild($element);

		/* Possible values: true, false

		It governs the usage of the legacy TLS mode for XMPP.*/

		$element = $xml->createElement("XMPP_legacy_tls", false);
		$account->appendChild($element);

		// stun holds stun related settings.

		$stun = $xml->createElement("stun");

		/* Possible values: disabled, custom, default

		In most cases only disabled and custom are used
		Controls the use of STUN.*/

		$element = $xml->createElement("use_stun", "custom");
		$stun->appendChild($element);

		/* Possible values: string

		Configures the address of the STUN server.*/

		$element = $xml->createElement("stun_host", "");
		$stun->appendChild($element);

		/* Possible values: unsigned int

		Configures the port of the STUN server.*/

		$element = $xml->createElement("stun_port", 3478);
		$stun->appendChild($element);

		/* Possible values: unsigned int

		Sets the refresh period of the STUN server
		Use this function to specify how often to refresh the STUN server.
		The default is 30 seconds. The refresh can be used to keep the
		NAT mapping alive.*/

		$element = $xml->createElement("stun_refresh_period", 40);
		$stun->appendChild($element);

		$account->appendChild($stun);

		/* Possible values: string

		Configures the server address.*/

		$element = $xml->createElement("IAX2_host", "");
		$account->appendChild($element);

		/* Possible values: string

		Configures the context to be used.*/

		$element = $xml->createElement("IAX2_context", "");
		$account->appendChild($element);

		/* Possible values: string

		Optional the display name.*/

		$element = $xml->createElement("IAX2_callerid", "");
		$account->appendChild($element);

		/*Possible values: string

		Configures the user name used for identification.*/

		$element = $xml->createElement("IAX2_callerNumber", "");
		$account->appendChild($element);

		/* Possible values: inband, disabled, outband

		Select the DTMF band for the user.*/

		$element = $xml->createElement("IAX2_dtmf_style", "");
		$account->appendChild($element);

		/*msrp holds msrp related settings.*/

		$msrp = $xml->createElement("msrp");

		/* Implemented in XML Configuration v1.8

		Possible values: true, false

		Enable msrp for the user.*/

		$element = $xml->createElement("enable_msrp", true);
		$msrp->appendChild($element);

		/* Implemented in XML Configuration v1.8

		Possible values: true, false

		Force user to use msrp for chat messages.*/

		$element = $xml->createElement("force_msrp_for_chat", true);
		$msrp->appendChild($element);

		/* Implemented in XML Configuration v1.9

		Possible values: true, false

		Enables TLS for the MSRP.*/

		$element = $xml->createElement("enable_tls", true);
		$msrp->appendChild($element);

		/* Implemented in XML Configuration v1.8

		Possible values: true, false

		Enable msrp relay for the user.*/

		$element = $xml->createElement("enable_msrp_relay", true);
		$msrp->appendChild($element);

		/* Possible values: string

		MSRP relay uri.*/

		$element = $xml->createElement("relay_uri", "");
		$msrp->appendChild($element);

		/* Implemented in XML Configuration v1.8

		Possible values: string

		Msrp relay username.*/

		$element = $xml->createElement("relay_username", "");
		$msrp->appendChild($element);

		/* Implemented in XML Configuration v1.8

		Possible values: string

		MSRP relay password.*/

		$element = $xml->createElement("relay_password", "");
		$msrp->appendChild($element);

		$account->appendChild($msrp);

		/* Codecs holds codec nodes for each supported codec for that.

                Only one per provisioning xml.*/

		$codecs = $xml->createElement("codecs");

		/* Codec contains a codec id, name, priority and if it is enabled. */

		$codec = $xml->createElement("codec");

		/*Possible values: unsigned int
			Internal codec id
			Current list:
			0 - uLaw
			1 - GSM
			6 - aLaw
			7 - g722
			16 - g729
			24 - Speex narrow
			25 - Speex wide
			26 - Speex ultra
			27 - iLBC30
			28 - iLBC20
			29 - g726
			31 - VP8
			34 - Opus narrow
			35 - Opus wide
			36 - Opus super
			37 - Opus full
		*/
		$prio = 1;
		foreach ($permitcodecs as $c => $p) {

			if (empty($codecs[$cid]))
				continue; /* unknown codec */

			$cid = $codecs[$c];
			
			$element = $xml->createElement("codec_id", $cid);
			$codec->appendChild($element);

			/* Possible values: unsigned int

			Codec priority in media negotiations.*/

			$element = $xml->createElement("priority", $prio);
			$codec->appendChild($element);

			/* Possible values: true, false

			Controls if the codec is enabled*/

			$element = $xml->createElement("enabled", true);
			$codec->appendChild($element);

			/* Optional parameters - bps, dtx, vbr 

			Add them if they're set in $permitcodecs */

			if (!empty($p)) {
				foreach ($p as $param => $val) {
					$element = $xml->createElement($param, $val);
					$codec->appendChild($element);
				}
			}

			$codecs->appendChild($codec);
			$prio++;		
		}


		$account->appendChild($codecs);

		$accounts->appendChild($account);

		$options->appendChild($accounts);

		/* Implemented in XML Configuration v1.5

		Dianostics contains all the settings for debugging.*/

		$diagnostics = $xml->createElement("diagnostics");

		/* Possible values: true, false

		Optional enables the debug logging into a file.*/

		$element = $xml->createElement("enable_debug_log", false);
		$diagnostics->appendChild($element);

		/* Possible values: true, false

		Optional enables the extended crash dump file. Avialable only on Windows.*/

		$element = $xml->createElement("enable_extra_dmp", false);
		$diagnostics->appendChild($element);

		/* Possible values: true, false

		Optional enables the audio log files.*/

		$element = $xml->createElement("enable_audio_debug", false);
		$diagnostics->appendChild($element);

		$options->appendChild($diagnostics);

		/* Implemented in XML configuration v1.11

		ZRTP holds the ZRTP related settings */

		$zrtp = $xml->createElement("zrtp");

		/* Possible values: true, false

		Enables ZRTP. */

		$element = $xml->createElement("enabled", false);
		$zrtp->appendChild($element);

		$hash_algorithms = $xml->createElement("hash_algorithms");

		$hash_algorithm = $xml->createElement("hash_algorithm");

		/* Possible values: S256, S384

		Hash algorithm name.*/

		$element = $xml->createElement("name", "S256");
		$hash_algorithm->appendChild($element);

		/* Possible values: 
			0 - S256
			1 - S384

		Hash algorithm id.*/

		$element = $xml->createElement("id", 0);
		$hash_algorithm->appendChild($element);

		/* Possible values: int

		Hash algorithm priority.*/

		$element = $xml->createElement("priority", 0);
		$hash_algorithm->appendChild($element);

		/* Possible values: true, false

		Controls if the hash algorithm is enabled.*/

		$element = $xml->createElement("selected", true);
		$hash_algorithm->appendChild($element);

		$hash_algorithms->appendChild($hash_algorithm);

		$zrtp->appendChild($hash_algorithms);

		$cipher_algorithms = $xml->createElement("cipher_algorithms");

		$cipher_algorithm = $xml->createElement("cipher_algorithm");

		/* Possible values: AES251

		Cipher algorithm name.*/

		$element = $xml->createElement("name", "S256");
		$cipher_algorithm->appendChild($element);

		/* Possible values: 
			0 - AES251

		Cipher algorithm id.*/

		$element = $xml->createElement("id", 0);
		$cipher_algorithm->appendChild($element);

		/*Possible values: int

		Cipher algorithm priority.*/

		$element = $xml->createElement("priority", 0);
		$cipher_algorithm->appendChild($element);

		/*Possible values: true, false

		Controls if the cipher algorithm is enabled.*/

		$element = $xml->createElement("selected", true);
		$cipher_algorithm->appendChild($element);

		$cipher_algorithms->appendChild($cipher_algorithm);

		$zrtp->appendChild($cipher_algorithms);

		$auth_tags = $xml->createElement("auth_tags");

		$auth_tag = $xml->createElement("auth_tag");

		/* Possible values: HS32, HS80

		Auth tags name.*/

		$element = $xml->createElement("name", "HS80");
		$auth_tag->appendChild($element);

		/* Possible values: 
			0 - HS32
			1 - HS80

		Auth tags id.*/

		$element = $xml->createElement("id", 1);
		$auth_tag->appendChild($element);

		/*Possible values: int

		Auth tags priority.*/

		$element = $xml->createElement("priority", 1);
		$auth_tag->appendChild($element);

		/*Possible values: true, false

		Controls if the Auth tags is enabled.*/

		$element = $xml->createElement("selected", true);
		$auth_tag->appendChild($element);

		$auth_tags->appendChild($auth_tag);

		$zrtp->appendChild($auth_tags);

		$key_agreement_methods = $xml->createElement("key_agreement_methods");

		$key_agreement_method = $xml->createElement("key_agreement_method");

		/* Possible values: DH2K, EC25, DH3K, EC38

		Key agreement name.*/

		$element = $xml->createElement("name", "DH2K");
		$key_agreement_method->appendChild($element);

		/* Possible values: 
			0 - DH2k
			1 - EC25
			2 - DH3K
			3 - EC38

		Key agreement id.*/

		$element = $xml->createElement("id", 1);
		$key_agreement_method->appendChild($element);

		/*Possible values: int

		Key agreement priority.*/

		$element = $xml->createElement("priority", 0);
		$key_agreement_method->appendChild($element);

		/*Possible values: true, false

		Controls if the Key agreement is enabled.*/

		$element = $xml->createElement("selected", true);
		$key_agreement_method->appendChild($element);

		$key_agreement_methods->appendChild($key_agreement_method);

		$zrtp->appendChild($key_agreement_methods);

		$sas_encodings = $xml->createElement("sas_encodings");

		$sas_encoding = $xml->createElement("sas_encoding");

		/* Possible values: B256, B32

		Sas encodings name.*/

		$element = $xml->createElement("name", "B256");
		$sas_encoding->appendChild($element);

		/* Possible values: 
			0 - B32
			1 - B256

		Sas encodings id.*/

		$element = $xml->createElement("id", 1);
		$sas_encoding->appendChild($element);

		/*Possible values: int

		Sas encodings priority.*/

		$element = $xml->createElement("priority", 0);
		$sas_encoding->appendChild($element);

		/*Possible values: true, false

		Controls if the Sas encodings is enabled.*/

		$element = $xml->createElement("selected", true);
		$sas_encoding->appendChild($element);

		$sas_encodings->appendChild($sas_encoding);

		$zrtp->appendChild($sas_encodings);

		$options->appendChild($zrtp);

		$xml->appendChild($options);

		echo $xml->saveXML($xml, LIBXML_NOEMPTYTAG);
	} else {
		error("Unknown version");
	}

?>
