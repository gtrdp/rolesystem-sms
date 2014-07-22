rolesystem-sms
==============

SMS interface for Rolesystem.

How to Install
--------------
- Please install Gammu before proceed to the next step. The max version for gammu is:

Tutorials
---------
- [http://aksauncp.blogspot.com/2013/10/sms-gateway-instalasi-gammu-step-by-step.html](http://aksauncp.blogspot.com/2013/10/sms-gateway-instalasi-gammu-step-by-step.html).
- [http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/](http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/).
- [http://tnetter.wordpress.com/2013/12/28/dokumentasi-install-gammu-1-33xampp-1-8-2-windows-788-1/](http://tnetter.wordpress.com/2013/12/28/dokumentasi-install-gammu-1-33xampp-1-8-2-windows-788-1/).

To-do
-----
- Find out the max version of Gammu.
- Find out the max version of MySQL and XAMPP.

Development Log
---------------
*Tue 07/22/2014*
- Got this following error:

		Error starting gammuSMSD service
		Error 1053: The service did not respond to the start or control request in a tim
		ely fashion.
		 (Error starting service)

- When reading the smsdlog, found this error:

		Tue 2014/07/22 14:56:04 gammu-smsd[3204]: Unknown DB driver

- This links solves the problems above [http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/](http://tnetter.wordpress.com/2013/12/27/issue-mysql-5-5-unknown-db-driver/).