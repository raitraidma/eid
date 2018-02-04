<?php
session_start();
if (isset($_SESSION['is_logged_in']) and $_SESSION['is_logged_in'] === TRUE) {
?>
  <p><strong>You are logged in</strong></p>
  <p><a href="./idlogin/idinfo.php">Here</a> you can see some data that came with ID-card.</p>
<?php
} else {
?>
  <a href="./idlogin">Login with ID-card</a>
<?php
}
?>