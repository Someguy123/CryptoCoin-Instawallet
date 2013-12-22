 <!-- BEGIN FOOTER.PHP -->
         </div>
      </div>
      <footer>
        <p style="font-size: 11px;">&copy; 2013 Someguy123 - Page rendered in: <?=round(timer()-$start,5)?> seconds - Like my service? Please donate here to keep us running: <?=$btclient->getaccountaddress($don_account);?> (recv: <?=$btclient->getbalance($don_account,0)?> LTC)</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
