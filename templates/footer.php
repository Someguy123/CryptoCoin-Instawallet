<!-- BEGIN FOOTER.PHP -->
    </div>
  </div> <!-- /container -->
  <footer>
   <p>Page rendered in: <?=round(timer()-$start,5)?> seconds. Like this service? Donate here to keep us running: <?=$btclient->getaccountaddress($don_account);?> (recv: <?=$btclient->getbalance($don_account,0)?> LTC)</p>
   <p>Please be aware, this site is released under the GNU Affero GPL v3 License. You can get the source code <a href="http://github.com/Someguy123/Cryptocoin-Instawallet">HERE</a> and if you use it, you must submit any modifications back to the repository.</p>
  </footer>
</body></html>