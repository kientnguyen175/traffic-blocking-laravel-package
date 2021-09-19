# Traffic Blocking Laravel Package
*The package help block access from any country you want. It gives you a web page where you can do it.*
# Installation
**1. Download the package**
```php
composer require megaads/traffic-blocking
```
**2. Edit the file ```/config/app.php``` by adding the line below in ```'providers'``` section**

* ```For Laravel Version < 5.0:```
```php
'Megaads\TrafficBlocking\Providers\TrafficBlockingServiceProvider'
```
* ```For Laravel Version >= 5.0:```
```php
Megaads\TrafficBlocking\Providers\TrafficBlockingServiceProvider::class
```
**3. Publish config files**
* ```For Laravel Version < 5.0:```
```php
php artisan config:publish --path="vendor/megaads/traffic-blocking/src/config" megaads/traffic-blocking --force
```
* ```For Laravel Version >= 5.0:```
```php
php artisan vendor:publish --tag='config' --force
```
# Usage
1. Define an array of keys in the file ```/config/packages/megaads/traffic-blocking/keys.php``` to help verify the permission to set up blocking access from selected countries.
1. Run ```<YOUR_DOMAIN>/megaads/traffic-blocking/index``` URL in browser to select countries you want to block access from.
2. The package gives you a ```Route Filter - Route Middleware``` with alias ```megaads-block-traffic``` and class ```\Megaads\TrafficBlocking\Middleware\BlockTraffic::class```. You can assign it to any route to block access from the countries you selected in step 1.
