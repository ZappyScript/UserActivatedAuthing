User Activated Authing
----------------------
What is it?
-----------
User Activated Auths is a way to allow your customer to choose when their auth starts.

Limitations:
-----------
Since most of you will not be running SSL certs, passing HTTP data -> HTTPS is quite tricky. 
For this reason, you MUST have the plugin open on OSBot + yourwebsite.com/path/plugin

AFK Mode:
---------
If you're browsing around OSBot, the plugin will update and auth people as you load new pages, however, this isn't always best.
If you take any url of osbot and add ?sleep=10000 to the end, it will trigger afk mode. This will keep the page refreshing every 10 seconds, thus, allowing auths to carry on whilst you are away.

----------------------
Setup:
------

	Chrome Plugin:
		Open "manifest"
		Edit line ""matches": ["http://website.com/plugin/*"]," too your website's path to the plugin dir. !!! DONT FORGET THE *   !!!
		Save + close.
		
		Open "userActivatedAuthsExternal"
		edit line: "var token = "INSERT TOKEN HERE";" Insert a token here with random letters/numbers/special chars
		Copy that token (you'll need it in a moment)
		Edit line: "var authController = "http://website.com/plugin/authController.php";" too the path of authController.php on your website
		Edit line: "var refresh = 10000;"  too change the refresh rate of pulling up flagged auths from your website.
		Save + Close
	
	Webfiles:
		Open "trials-header.php"
		Edit line: "$trials = new Trials('HOST','USER','PASS','TABLE');" with your database details
		Edit line: "$token = "";" and add your token from Chrome Plugins
		Save + Exit
		
	SQL:
		Inside the /Database/ folder is a file you can use to make the tables.
		
	
-----------------
Usage:
------

Adding auths:
------------
Navigate to yoursite.com/addAuth.php?token=YOUR TOKEN
Input the data required, you'll get a user+password that you will give to your client.

Auth flagging:
------------
End user needs to say when they are ready to be flagged, I included 2 ways to do this, userAuth-via-Post-Example and userAuth-via-Get-Example
Choose which (or both) solution works for you, and add the relevant CSS to match your website.
Give the user the link to which option you chose (if POST, they will need their user+pass, if GET you include that in the URL)

Thanks Fruity for testing this out with me.