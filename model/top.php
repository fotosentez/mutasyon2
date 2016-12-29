<?php

$url = Get::post ( "url" );
if (! $url or $url == "") {
	echo '<script type="text/javascript">window.location.href="index.php?url=index";</script>';
}