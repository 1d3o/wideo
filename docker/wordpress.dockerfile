FROM wordpress:latest

RUN apt-get update && apt-get install -y git

WORKDIR /var/www/html
