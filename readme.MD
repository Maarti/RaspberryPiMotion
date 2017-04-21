#Usefull commands
    #Check if motion is running (and alert/error)
    sudo service motion status -l
    
    #Edit Motion config file
    sudo nano /etc/motion/motion.conf
    
    #Reboot raspberry
    sudo shutdown -r now

#Installing Apache
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

#Installing PHP
    #Install PHP
    sudo aptitude install php5
    
    #Remove apache index.html
    sudo rm /var/www/html/index.html
    
    #Test if it works
    echo "<?php phpinfo(); ?>" > /var/www/html/index.php
