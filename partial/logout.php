<?php
session_start();
session_unset();
session_reset();
session_destroy();
header("Location:/forum/index.php?c=true")
?>