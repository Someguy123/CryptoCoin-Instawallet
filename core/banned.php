<?php
/**
 * @author Greedi
 * @copyright 2012
 */

  $banlist = array("123.456.789");
  $myip = $_SERVER['REMOTE_ADDR'];
  if (in_array($myip, $banlist)) {
    exit("<p style="text-align:center;">You have been banned, visit #instawallet on irc.freenode.net for support.</p>");
  }
?>