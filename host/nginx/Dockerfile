FROM nginx:1.9
MAINTAINER Gregory Vorozhtcov

ADD nginx.conf /etc/nginx/
ADD gregory.conf /etc/nginx/sites-available/gregory.conf
RUN mkdir /etc/nginx/sites-enabled
RUN ls -la /etc/nginx/sites-available
RUN ls -la /etc/nginx/sites-enabled
RUN ln -s /etc/nginx/sites-available/gregory.conf /etc/nginx/sites-enabled/gregory
RUN usermod -u 1033 www-data
RUN groupmod -g 1033 www-data

# container init
ADD ./start.sh /start.sh
RUN chmod 755 /start.sh
CMD ["/bin/bash", "/start.sh"]