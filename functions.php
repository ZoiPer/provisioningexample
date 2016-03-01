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
