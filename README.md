# assetmanagement

## Demo site
[http://assetmanagement.eastus.cloudapp.azure.com:8080](http://assetmanagement.eastus.cloudapp.azure.com:8080)

## Extract folder under "assetmanagement"
1. Download zip from [https://github.com/capstone070/assetmanagement](https://github.com/capstone070/assetmanagement)
2. Extract zip file into a folder

## Username and password for admin
```
username: Luis
password: luis
```

## How to load SQL file

1. Open PHP my admin
2. Create database called "assetmanagement"
3. Import assetmanagement.sql into new "assetmanagement" database.

## Update lib/config.php
To connect to database, you need to change the settings in [lib/config.php](https://github.com/capstone070/assetmanagement/blob/main/lib/config.php)
1. Open lib/config.php
2. Change host, username, and password (on the right part of the code)

## Libraries
Various libraries used in the platform
- [Bootstrap](https://getbootstrap.com) for UI
- [Unsplash](https://unsplash.com) to generate random image on login
- [ChartJS](https://www.chartjs.org) for generating charts
- [animate.css](https://animate.style) for animations
- [sergeytsalkov/meekrodb](https://meekro.com) to interact with database
- [chillerlan/php-qrcode](https://github.com/chillerlan/php-qrcode) to generate QR code

