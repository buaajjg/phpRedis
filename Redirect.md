1.create new folder in /var/www
sudo mkdir -p /var/www/desktop/

sudo mkdir -p /var/www/mobile/

sudo chown -R $USER:$USER /var/www/desktop/

sudo chown -R $USER:$USER /var/www/mobile/

sudo chmod -R 755 /var/www/

2. set port of server
  sudo vi /etc/apache2/ports.conf
  add port under "listen 80":
  listen 81;
  listen 82;
  please open the port of your cloud instance.
  
3.config the apache
sudo vi /etc/apache2/sites-available/000-default.conf

  <VirtualHost *:80>
    ..........

    DocumentRoot /var/www/html/

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory /var/www/html/>
      AllowOverride All
    </Directory>
  </VirtualHost>

  <VirtualHost *:81>
    ..........

    DocumentRoot /var/www/desktop/

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory /var/www/desktop/>
            AllowOverride all
    </Directory>
  </VirtualHost>
  <VirtualHost *:82>
    ..........

    DocumentRoot /var/www/mobile/

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory /var/www/mobile/>
            AllowOverride all
    </Directory>
  </VirtualHost>
  
4.set redirect path
  $ sudo vi .htaccess at /var/www/html
  <IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTP_USER_AGENT} "android|blackberry|googlebot-mobile|iemobile|ipad|iphone|ipod|opera mobile|palmos|webos" [NC]
  RewriteRule ^$ http://http://104.198.2.206/:82 [L,R=302]
  </IfModule>
  <IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTP_USER_AGENT} "!(android|blackberry|googlebot-mobile|iemobile|ipad|iphone|ipod|opera mobile|palmos|webos)" [NC]
  RewriteRule ^$ http://http://104.198.2.206/:81 [L,R=302]
  </IfModule>

  sudo a2ensite 000-default.conf
  sudo service apache2 restart
