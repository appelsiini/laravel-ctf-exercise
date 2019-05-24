FROM ubuntu:16.04

WORKDIR /app

RUN apt update && apt install -y build-essential zlib1g-dev libxml2-dev bzip2 curl libssl-dev pkg-config libcurl4-openssl-dev checkinstall vim netcat iputils-ping wget python cron

COPY ./binaries /tmp/binaries

# Installing apache v2.2.20 that's vulnerable to HttpOnly cookie exposure exploit
# https://www.exploit-db.com/exploits/18442
RUN tar -xjf /tmp/binaries/httpd-2.2.20.tar.bz2 -C /tmp/binaries \
    && cd /tmp/binaries/httpd-2.2.20 \
    && ./configure --prefix=/usr/local/apache2 --enable-mods-shared=all \
    && make \
    && make install

# Building php from source to make it work together with the old apache version
RUN tar -xzf /tmp/binaries/php-7.1.29.tar.gz -C /tmp/binaries \
    && cd /tmp/binaries/php-7.1.29 \
    && ./configure --with-apxs2=/usr/local/apache2/bin/apxs --with-mysqli --with-pdo-mysql --with-openssl --with-zlib --enable-zip --with-curl \
    && make \
    && make install

COPY . /app

# Setting up proper file permissions for the web root
RUN chown -R daemon:daemon /app
RUN find /app -type d -exec chmod 755 {} \;
RUN find /app -type f -exec chmod 644 {} \;
RUN chgrp -R daemon /app/storage /app/public/uploads /app/bootstrap/cache
RUN chmod -R ug+rwx /app/storage /app/public/uploads /app/bootstrap/cache

# Setup Laravel scheduler to run as root, this will be the final boss
RUN echo '* * * * * root cd /app && php artisan schedule:run >> /dev/null 2>&1' >> /etc/crontab

# Overriding default apache2 configuration file
COPY ./httpd.conf /usr/local/apache2/conf

CMD service cron start && /usr/local/apache2/bin/httpd -D FOREGROUND

EXPOSE 80

