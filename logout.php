<?php

include 'config.php';

session_start();
session_unset();
session_destroy();
?>
<meta http-equiv="refresh" content="0;url=<?php
echo $_SERVER["HTTP_REFERER"];
?>">