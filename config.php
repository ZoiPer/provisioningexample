<?php

define("SIP_DOMAIN", "sip.example.com");

/* permitted codecs */

/* If you do not set an option for a specific codec, the default will be used.*/
$permitcodecs = array(
	'GSM' => array(),
	'VP8' => array(
		'bps' => 1024,
		'dtx' => 1,
		'vbr' => 1
	)
);


