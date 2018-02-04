<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<pre>
<?php
var_dump($_SERVER['SSL_CLIENT_VERIFY'], $_SERVER['SSL_CLIENT_S_DN'], $_SERVER['SSL_CLIENT_S_DN_CN'], $_SERVER['SSL_CLIENT_S_DN_G'], $_SERVER['SSL_CLIENT_S_DN_S']);
?>
</pre>