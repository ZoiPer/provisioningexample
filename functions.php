<?php
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
