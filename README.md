1.installation of apache2 php5
  Updating The Operating-System

    $ sudo aptitude    update
    $ sudo aptitude -y upgrade
    
    $ sudo apt-get install apache2 unzip tcl php5 libapache2-mod-php5 make gcc git php5-dev
2.installation of Redis
    $ wget http://download.redis.io/redis-stable.tar.gz
    $ tar xvzf redis-stable.tar.gz
    $ cd redis-stable
    $ make

    copy both the Redis server and the command line interface in proper places, either manually using the following commands:
   $ sudo cp src/redis-server /usr/local/bin/
   $ sudo cp src/redis-cli /usr/local/bin/
   
     check if Redis is working
    $ redis-cli ping
      PONG
3. 
    Create a directory where to store your Redis config files and your data:
    $ sudo mkdir /etc/redis
    $ sudo mkdir /var/redis
     
     Copy the init script that you'll find in the Redis distribution under the utils directory into /etc/init.d. We suggest calling it with the name of the port where you are running this instance of Redis.
     $ sudo cp utils/redis_init_script /etc/init.d/redis_6379
     
     Copy the template configuration file you'll find in the root directory of the Redis distribution into /etc/redis/ using the port number as name, for instance:
     $ sudo cp redis.conf /etc/redis/6379.conf
     
     Create a directory inside /var/redis that will work as data and working directory for this Redis instance:
     $ sudo mkdir /var/redis/6379
     
     Edit the configuration file, making sure to perform the following changes:
      Set daemonize to yes (by default it is set to no).
      Set the pidfile to /var/run/redis_6379.pid (modify the port if needed).
      Change the port accordingly. In our example it is not needed as the default port is already 6379.
      Set your preferred loglevel.
      Set the logfile to /var/log/redis_6379.log
      Set the dir to /var/redis/6379 (very important step!)
      
      Finally add the new Redis init script to all the default runlevels using the following command:
      $ sudo update-rc.d redis_6379 defaults
      start service
      $ sudo /etc/init.d/redis_6379 start
