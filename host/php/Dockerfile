FROM php:7.0.7-fpm
MAINTAINER Gregory Vorozhtcov

RUN mkdir /home/gregory/
RUN useradd gregory
RUN usermod -u 1033 -s /bin/bash gregory
RUN groupmod -g 1033 gregory
RUN usermod -d /home/gregory/source/ gregory
RUN chown -R gregory:gregory /home/gregory
WORKDIR /home/gregory/source/

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        curl \
        git \
        libcurl4-gnutls-dev \
        libc-client-dev \
        libtool autoconf automake gcc pkg-config make \
        supervisor openssh-server unzip wget gearman libgearman-dev

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-enable pdo
RUN docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install json
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install iconv
RUN docker-php-ext-install phar
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN wget https://github.com/wcgallego/pecl-gearman/archive/master.zip \
    && unzip master.zip \
    && cd pecl-gearman-master \
    && phpize \
    && ./configure \
    && make install \
    && docker-php-ext-enable gearman

RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
RUN php composer-setup.php
RUN mv composer.phar /bin/composer
RUN chmod a+x /bin/composer
RUN php -r "unlink('composer-setup.php');"
RUN curl -LsS http://codeception.com/codecept.phar -o /usr/local/bin/codecept
RUN chmod a+x /usr/local/bin/codecept

RUN sed -i -e "s/www-data/gregory/g" /usr/local/etc/php-fpm.d/www.conf
ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir /var/log/dev_php/

ADD php.ini /usr/local/etc/php/php.ini
ADD php.ini /usr/local/etc/php.ini

RUN mkdir /var/run/sshd
RUN sed -ri 's/^PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config
RUN mkdir /root/.ssh/

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


EXPOSE 22 9000

ADD ./start.sh /start.sh
RUN chmod 755 /start.sh
CMD ["/bin/bash", "/start.sh"]