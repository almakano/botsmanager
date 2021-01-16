<?php
	if(! function_exists('assets_cached')) {
		function assets_cached($path) {
			return $path.'?'.substr(md5(filemtime(public_path().$path)), 0, 5);
		}
	}
?>