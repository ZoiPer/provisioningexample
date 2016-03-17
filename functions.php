<?php

/* List of all codecs and their ids*/
$codec_ids = array(
'uLaw' => 0,
'GSM' => 1,
'aLaw' => 6,
'g722' => 7,
'g729' => 16,
'Speex narrow' => 24,
'Speex wide' => 25,
'Speex ultra' => 26,
'iLBC30' => 27,
'iLBC20' => 28,
'g726' => 29,
'VP8' => 31,
'H.264' => 32,
'Opus narrow' => 34,
'Opus wide' => 35,
'Opus super' => 36,
'Opus full' => 37
};

	function ver_to_int($ver) {
		$arr = explode('.', $ver);
		$f = (int) $arr[0];
		$s = (int) $arr[1];
		return $f * 10000 + $s;
	}

	function error($err) {
		echo "<error>$err</error>";
		die();
	}

/* THIS IS JUST AN EXAMPLE, you'll need your own way to authenticate users */

	/* 
	  This function returns some parameters which are put in the provisioning.
	  The only parameters it passes right now are the username and password for
	  the SIP/IAX2 account.
	*/

	function validate_user($username, $password) {
		$secretuser = "secretuser";
		$secretpass = "verysecret";
		if ($username != $secretuser || $password != $secretpass)
			return false;
		
		$tmp = array();
		$tmp['username'] = $username;
		$tmp['password'] = $password;

		return $tmp;
	}

	/*
	  This function returns string with escaped special XML symbols.
	  It is mainly used for the properly passing of the URL for balance,
	  rate and call quality rating.
	*/

	function xml_url ($string) {
		$sym = array(
			"<" => "&lt;",
			">" => "&gt;",
			'"' => "&quot;",
			"'" => "&apos;",
			"&" => "&amp;",
		);		
		return strtr($string, $sym);
	}
