# RaspberryPi Motion Detection
This is the configuration of my Raspberry Pi that is running a [Motion](http://www.lavrsen.dk/foswiki/bin/view/Motion/WebHome) daemon, PhP and an Apache Server.
Motion record videos when a motion is detected (from the Raspberry Pi camera), then i have cron jobs that merge and speed up videos, and put it in the Apache server.


# Memo
## Usefull commands
    #Check if motion is running (and alert/error)
    sudo service motion status -l
    
    #Edit Motion config file
    sudo nano /etc/motion/motion.conf

    #Edit crontab
    sudo crontab -e
    
    #Reboot raspberry
    sudo shutdown -r now

## Installing Motion
    #Update
    sudo apt-get update
    sudo apt-get upgrade
    
    #Install motion
    sudo apt-get install motion
    
    #Recognize RaspberryPi Camera V2
    sudo modprobe bcm2835-v4l2
    echo "bcm2835-v4l2" | sudo tee -a /etc/modules

    #Config motion
    # Change the start_motion_daemon to yes in :
    sudo nano /etc/default/motion
    # Edit the config file (or see mine) :
    sudo nano /etc/motion/motion.conf

## Installing Apache
    #Update
    sudo apt-get update
    sudo apt-get upgrade
    
    #Install apache
    sudo apt-get install apache2
    
    #Change owner and get rights
    sudo chown -R pi:www-data /var/www/html/
    sudo chmod -R 770 /var/www/html/
    
    #Test if it works
    wget -O verif_apache.html http://127.0.0.1
    cat ./verif_apache.html

## Installing PHP
    #Install PHP
    sudo aptitude install php5
    
    #Remove apache index.html
    sudo rm /var/www/html/index.html
    
    #Test if it works
    echo "<?php phpinfo(); ?>" > /var/www/html/index.php

## Directory password protection (Apache)
    #Install apache-utils
    sudo apt-get install apache2 apache2-utils
    
    #Create user/password
    sudo htpasswd -c /etc/apache2/.htpasswd {THE_USERNAME_HERE}
    #then prompted to type the password

    #Edit apache config
    sudo nano /etc/apache2/apache2.conf
    # Find the <Directory> block for the /var/www directory that holds the document root. Turn on .htaccess processing by changing the AllowOverride directive within that block from "None" to "All":
    <Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    #Add .htaccess to the directory
    sudo nano /var/www/html/.htaccess
    # Type :
    AuthType Basic
    AuthName "Restricted Content"
    AuthUserFile /etc/apache2/.htpasswd
    Require valid-user

## Installing [ffmpeg](https://wiki.debian.org/ffmpeg#Installation)
    #Add repository
    nano /etc/apt/sources.list
    # Add :
        # Backports repository
        deb http://httpredir.debian.org/debian jessie-backports main contrib non-free
    
    #Update
    sudo aptitude update
    
    #Install
    sudo aptitude -t jessie-backports install ffmpeg

## Installing Imagemagick (convert)
    sudo apt-get install imagemagick


# Links
* [Motion](http://www.lavrsen.dk/foswiki/bin/view/Motion/WebHome)
* [Motion Config File Options](http://www.lavrsen.dk/foswiki/bin/view/Motion/ConfigFileOptions)
* [Installing motion on Raspberry](https://raspbian-france.fr/video-surveillance-raspberry-pi-camera/)
* [Installing web server](https://raspbian-france.fr/installer-serveur-web-raspberry/)

