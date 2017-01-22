<?php

$url = Get::post ( "url" );
if (! $url or $url == "") {
    header('Location: index.php?url=index');
}
