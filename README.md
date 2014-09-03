Rolesystem SMS
==============
SMS interface for Rolesystem, a consulting application.

How to Install
--------------
- Please install Gammu before proceeding to the next step. The recommended version for gammu is: 1.29.x.
- You can find fully working tutorial [here](http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-1-persiapan-gammu.html).

Tutorials
---------
- [http://aksauncp.blogspot.com/2013/10/sms-gateway-instalasi-gammu-step-by-step.html](http://aksauncp.blogspot.com/2013/10/sms-gateway-instalasi-gammu-step-by-step.html).
- [http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/](http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/).
- [http://tnetter.wordpress.com/2013/12/28/dokumentasi-install-gammu-1-33xampp-1-8-2-windows-788-1/](http://tnetter.wordpress.com/2013/12/28/dokumentasi-install-gammu-1-33xampp-1-8-2-windows-788-1/).
- [http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-1-persiapan-gammu.html](http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-1-persiapan-gammu.html). **<< most comprehensive**
- [http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-2-persiapan-kalkun.html](http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-2-persiapan-kalkun.html).
- [http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-3-penyempurnaan-kalkun.html](http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-3-penyempurnaan-kalkun.html).
- [http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-4-multi-modem.html](http://toekangmodem.blogspot.com/2013/05/cara-mudah-install-gammu-windows-dan-kalkun-part-4-multi-modem.html).
- [http://www.blog.ghuffar.com/index.php/sms-gateway/9-mengirim-sms-dengan-gammu.html](http://www.blog.ghuffar.com/index.php/sms-gateway/9-mengirim-sms-dengan-gammu.html).

To-do
-----
- Logs per users.
- Dumping the new SQL Dump Tables.

Development Log
---------------
*Wed Sep  3 15:12:39 WIB 2014*
- Gammu has worked since a couple weeks ago.
- SMS Processor script is now fully working.
- Users page, Send SMS page are now OK.
- All features are now OK, communication logs left.

*Tue Aug 19 08:52:00 WIB 2014*
- Login page is now working.

*Mon Aug 18 22:21:03 WIB 2014*
- Integrating CI to the system

*Sun Jul 27 2014*
- Processor complete, needs to be debugged.

*Sat Jul 26 2014*
- Develop the web application.
- Designing database tables.

*Wed 07/23/2014*
- Reinstall awkward ads in web browsers.
- Tried to downgrade XAMPP to 1.7.2 and GAMMU to 1.27.x.
- Got a problem: msvcr71.dll missing gammu. Easily solved by installing the dll found from googling.

*Tue 07/22/2014*
- Got this following error:

		Error starting gammuSMSD service
		Error 1053: The service did not respond to the start or control request in a timely fashion.
		(Error starting service)

- When reading the smsdlog, found this error:

		Tue 2014/07/22 14:56:04 gammu-smsd[3204]: Unknown DB driver

- This link solves the problems above [http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/](http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/).