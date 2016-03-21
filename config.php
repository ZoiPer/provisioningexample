<?php

define("SIP_DOMAIN", "sip.example.com");

/* permitted codecs */

/*
+----+-------------------+-----------+-----------+-----------+---+---+
| id | Codec             |Min Bitrate|Max Bitrate|Default    |DTX|VBR|
+----+-------------------+-----------+-----------+-----------+---+---+
|  0 | uLaw              | 640000    | 64000     | 64000     | 0 | 0 |
|  1 | GSM               | 13200     | 13200     | 13200     | 0 | 0 |
|  6 | aLaw              | 64000     | 64000     | 64000     | 0 | 0 |
|  7 | G722              | 64000     | 64000     | 64000     | 0 | 0 |
| 16 | G729              | 8000      | 8000      | 8000      | 1 | 0 |
| 24 | Speex Narrow      | 2150      | 24600     | 8000      | 0 | 1 |
| 25 | Speex Wide        | 3950      | 42200     | 27800     | 0 | 1 |
| 26 | Speex Ultra       | 5750      | 44000     | 29600     | 0 | 1 |
| 27 | iLBC30            | 13333     | 15200     | 13333     | 0 | 1 |
| 28 | iLBC20            | 13333     | 15200     | 15200     | 0 | 1 |
| 29 | G726              | 32000     | 32000     | 32000     | 0 | 0 |
| 31 | VP8               | 32000     | 2000000   | 128000    | 0 | 1 |
| 32 | H264              | 32000     | 2000000   | 128000    | 0 | 1 |
| 34 | Opus Narrow       | 6000      | 24000     | 15000     | 1 | 1 |
| 35 | Opus Wide         | 6000      | 28000     | 20000     | 1 | 1 |
| 36 | Opus Super        | 6000      | 32000     | 30000     | 1 | 1 |
| 34 | Opus Narrow       | 6000      | 40000     | 40000     | 1 | 1 |
+----+-------------------+-----------+-----------+-----------+---+---+

Please note that the codecs listed below are just for an example. You would have to add your codecs and settings.

If you do not set an option for a specific codec, the default will be used.*/

$permitcodecs = array(
	'GSM' => array(
		'bps' => 13200,
		'dtx' => 0,
		'vbr' => 0
	),
	'VP8' => array(
		'bps' => 128000,
		'dtx' => 1,
		'vbr' => 1
	)
);


