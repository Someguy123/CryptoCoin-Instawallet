Cryptocoin Instawallet (inc. Litecoin and Bitcoin support)
====================
This PHP web application is designed to allow users to obtain a wallet for Bitcoin/Litecoin/etc. without having to sign-up, as well as the ability to password their wallets for added security against key leakage. It is used at the newly released [LTC.PE Litecoin Instawallet](http://wallet.ltc.pe).

People running these wallets should be aware of the security risks involved, as it depends on a coin daemon running on the server, there is NO COLD WALLET facility, although you may be able to move coins off of a coin daemon using `sendto` within the coin RPC without affecting other accounts.

License
=======
**IMPORTANT:** This is released under the GNU Affero GPL License v3 (please read LICENSE which is included in this git repository). This means that you **MUST** release any modifications you make if any other user can access it. Included in the footer by default is a link to my Github page, which you should be submitting any modifications you make as a pull request where possible.

How to use
==========
To use this, you must first have a coin daemon set up on your server. I have written a guide to installing **Litecoind** on linux here: [https://litecointalk.org/index.php/topic,43.0.html](https://litecointalk.org/index.php/topic,43.0.html)

Once you have set up Litecoin or Bitcoin on your server with the appropriate configuration, you must now enter the username, password, host, and port into `core/config.php` like this:

	$btclogin = array(
	"username" =>   "litecoinrpc",
	"password" => "Sup@rStr0ngP4$$W4RD",
	"host" =>       "localhost",
	"port" =>       "9332");

Next you will need to import `structure.sql` into your MySQL database **(NOTE: This uses PDO so you should be able to swap out MySQL for Postgres, or even SQLite with just one line of code changed)** - please don't use the root login for obvious reasons, instead make an isolated user with access to only the wallet database.

Afterwards you can enter the MySQL details in config.php:

	$sqlogin = array(
	"host" =>       "localhost",
	"dbname" =>     "ltcwallet",
	"username" =>   "ltcwallet",
	"password" =>   "S0meN0tSim1l4rP%$$w0RDz");

Finally, you can get a ReCaptcha key-pair from [here](https://www.google.com/recaptcha/admin/create) and enter it into the config file under `$publickey` and `$privatekey`, and then enter your IP under `$adminips` for access to **server.php** for an overview of the system. 

Now if you visit your website it should be fully functional, and ready to go.

Donations
=========
If you're using my code for any public wallet service, I would be grateful if you could donate to me. I've put in a lot of hard work into this code, so if it's useful to you, please send some coins over, there's no donation too small.

- BTC: **1SoMGuYknDgyYypJPVVKE2teHBN4HDAh3**
- LTC: **LSomguyTSwcw3hZKFts4P453sPfn4Y5Jzv**

Thank you.
