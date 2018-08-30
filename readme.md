
# zkit

## How to
 
#### environment
```bash
# install php
php -v

# install composer
composer -v
```

#### app debug install
```bash
# install php-cs-fixer
composer global require friendsofphp/php-cs-fixer
```

#### app install 
```bash
# install asset plugin
composer global require "fxp/composer-asset-plugin:~1.4"

# set github token
composer config --global github-oauth.github.com [github token]

# install
coposer install
```
 
#### server install
```bash
yum install -y epel-release
yum install -y http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

yum install -y httpd
yum install -y --enablerepo=remi,remi-php73 php php-intl php-mbstring php-mysqlnd php-mcrypt
#php-mysqli 

systemctl enable httpd.service

```
