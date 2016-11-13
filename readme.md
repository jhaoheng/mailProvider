# readme

## env

1. base on phalcon (support 2.x after)

## first try

1. `git clone git@github.com:jhaoheng/mailProvider.git`
2. Host this service on server.
3. `vim app/config/mail_config/default.php` : fill required info
4. exec curl
 
	```
	curl -X POST -H "authmailprovider : test" -d '{
		    "mailConfig" : "default",
		    "emails" : [
		        "xxxxxx@gmail.com"
		    ],
		    "mailType" : "index",
		    "mailViewArg" : {
		        "text" : "Hi , this is a default set"
		    } 
	http://{url}/mail/default/send
	``` 
	
## create a new one

1. copy `config/mail_config/default.php` a new one and named 'maildogconfig', fill up required info.
	- smtp
	- mailFrom
	- subject : update `index` -> `hello`
2. copy `app/mail_send/default.php` a new one and named `maildog.php` on the same folder.
	- Remember update the `authorization` code.
3. `vim app/app.php` create a new endpoint with `mail_send/maildog.php`.
4. create a new folder `app/views/emailTemplates/maildog/` and add a new `hello.phtml`.
5. exec curl

	```
	curl -X POST -H "authmailprovider : test" -d '{
		    "mailConfig" : "maildogconfig",
		    "emails" : [
		        "xxxxxx@gmail.com"
		    ],
		    "mailType" : "hello",
		    "mailViewArg" : null
	http://{url}/mail/maildog/send
	```