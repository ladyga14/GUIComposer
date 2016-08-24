NoConsoleComposer
=================

PHP script that can help you run composer even if you don't have SSH access to your server.

There are times when we want to run `composer` on a hosting box or somewhere we are not allowed shell access through SSH or other methods. NoConsoleComposer will help you do some of the basic work using `composer` even when you have no SSH access. A web server with FTP access can easily run NoConsoleComposer. Follow the guide given below for installation and usage.
Installation
=================

Steps to use NoConsoleComposer :

 1. Download the source from above and put the `composer` folder where you can access it from web. For shared hosting, it would be under the `public_html` folder most probably. I'll assume that you put the `composer` folder directly under `public_html`. i.e, `public_html/composer`.
 2. Access NoConsoleComposer from `http://yourdomain.com/composer/index.php`. The screen is doing what it is saying, i.e, downloading composer from web. It will show updates and then the page will refresh. And the buttons will show up :![](http://i.imgur.com/sdGwh0A.png)

Usage
==================

 1. You will have to input the relative path(with respect to `composer/main.php`) or absolute path to the folder in which you want to run the command.
 2. Click the appropriate button and keep an eye on the log.