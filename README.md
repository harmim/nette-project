# Example use Nette Framework

`C:\Windows\System32\drivers\etc\hosts`

```conf
127.0.0.1	localhost
127.0.0.1	nette-project.localhost.com
```

---

`C:/xampp/apache/conf/httpd.conf`

```conf
Include conf/extra/httpd-vhosts.conf
```

---

`C:/xampp/apache/conf/extra/httpd-vhost.conf`

```conf
<VirtualHost *>
	DocumentRoot "C:/xampp/htdocs/nette-project/www"
	ServerName nette-project.localhost.com
	<Directory "C:/xampp/htdocs/nette-project/www">
		Order allow,deny
		Allow from all
	</Directory>
</VirtualHost>
```
