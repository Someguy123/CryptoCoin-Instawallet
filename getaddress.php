<?php
  include("core/wallet.php");
  $resp = recaptcha_check_answer ($privatekey,
  $_SERVER["REMOTE_ADDR"],
  $_POST["recaptcha_challenge_field"],
  $_POST["recaptcha_response_field"]);
  if (!$resp->is_valid) {
    // Error on incorrect CAPTCHA.
    die ("The reCAPTCHA wasn't entered correctly; go back and try it again." .
    "(reCAPTCHA said: " . $resp->error . ")");
  }
  if (isset($_SESSION["key"])) {
    $address = "/key/" . $_SESSION["key"];
  }
  else {
    $addr->newAddr();
    $_SESSION["key"] = $addr->securl;
    $address = "/key/" . $_SESSION["key"];
  }
  header("Location: " . $address);
?>
