# eID example

## Prerequisites
- VirtualBox 5.2.6
- Vagrant 2.0.2

## Setup
Run following script to setup ID-card authentication example

```sh
sudo apt-get update
sudo apt-get install -y apache2
sudo apt-get install -y php
sudo apt-get install -y libapache2-mod-php

sudo rm -rf /var/www/html
sudo mkdir -p /vagrant/www
sudo ln -fs /vagrant/www /var/www/html

sudo mkdir -p /etc/apache2/eid
cd /etc/apache2/eid

# Create and sign own cert
sudo openssl genrsa -out server.key 1024
sudo openssl req -new -key server.key -out server.csr -subj "/C=/ST=/L=ET/O=/OU=/CN=/emailAddress=/"
sudo openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt

# Get central certificates from https://sk.ee/repositoorium/sk-sertifikaadid
# No need for KLASS certificates
sudo wget https://sk.ee/upload/files/EE_Certification_Centre_Root_CA.pem.crt
sudo wget https://sk.ee/upload/files/ESTEID-SK_2011.pem.crt
sudo wget https://sk.ee/upload/files/ESTEID-SK_2015.pem.crt
sudo wget https://sk.ee/upload/files/EID-SK_2011.pem.crt
sudo wget https://sk.ee/upload/files/EID-SK_2016.pem.crt

cat EE_Certification_Centre_Root_CA.pem.crt ESTEID-SK_2011.pem.crt ESTEID-SK_2015.pem.crt EID-SK_2011.pem.crt EID-SK_2016.pem.crt | sudo tee id.crt

# Configure apache
sudo a2enmod ssl
sudo cp /vagrant/eid-apache.conf /etc/apache2/sites-available
sudo a2ensite eid-apache
sudo service apache2 restart
```

After setup you can open browser and go to [https://localhost](https://localhost). There is a login link that redirects you to /idlogin page, where PIN1 is asked. When authentication is successful, then session is created and you are redirected back to main page.