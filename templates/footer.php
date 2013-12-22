 <!-- BEGIN FOOTER.PHP -->
         </div>
      </div>
      <footer>
        <p style="font-size: 11px;">&copy; 2013 Someguy123 - Page rendered in: <?=round(timer()-$start,5)?> seconds - Like my service? Please donate here to keep us running: <?=$btclient->getaccountaddress($don_account);?> (recv: <?=$btclient->getbalance($don_account,0)?> LTC)</p>
	<p style="font-size: 11px;">Please be aware this site is released under the GNU Affero GPL v3 License. This means you can get the source code <a href="http://github.com/Someguy123/Cryptocoin-Instawallet">HERE</a> and if you use it, you need to submit any modifications back to me.</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
