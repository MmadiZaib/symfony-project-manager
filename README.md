## Install app 
``make install``

## Start app
``make start``

## Install ssl certificates 
``make ssh-nginx``

``apk add openssl``

``openssl req -x509 -nodes -days 365 -subj "/C=CA/ST=QC/O=Company, Inc./CN=mydomain.com" -addext "subjectAltName=DNS:mydomain.com" -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt;``

``docker cp nginx:/etc/ssl/certs/nginx-selfsigned.crt ~/Desktop;``
