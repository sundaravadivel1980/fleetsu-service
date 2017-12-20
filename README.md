# fleetsu-service

Device List Get Service Call
http://fleetsuservice.com/fleetsuservice/v1/listDevice

Below is my virtaul host conf snippet
<VirtualHost *:80>
    DocumentRoot "C:/sundar/personal/fleetsu/fleetsuService"
    
    <Directory "C:/sundar/personal/fleetsu/fleetsuService">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
		Require all granted
    </Directory>    
    
    ServerName fleetsuservice
    ServerAlias fleetsuservice.com
    ##ServerAlias www.dummy-host2.localhost
    ##ErrorLog "logs/disneymxp.localdomain-error.log"
    ##CustomLog "logs/disneymxp.localdomain-access.log" combined
    
    SetEnv NGE_ENV dev
</VirtualHost>

If you using Linux, please make sure to set write permission for application var folder
