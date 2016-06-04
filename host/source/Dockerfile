FROM       ubuntu:trusty
MAINTAINER Gregory Vorozhtcov

# language
RUN locale-gen en_US.UTF-8
RUN locale-gen ru_RU.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV DEBIAN_FRONTEND noninteractive
RUN dpkg-reconfigure locales

# update soft
RUN apt-get update -y
RUN apt-get -y dist-upgrade
RUN apt-get upgrade -y
RUN apt-get install software-properties-common -y

# ssh
RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd
RUN sed -ri 's/^PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config
RUN mkdir /root/.ssh/

RUN mkdir /home/gregory/
RUN useradd gregory
RUN usermod -u 1033 -s /bin/bash gregory
RUN groupmod -g 1033 gregory

RUN mkdir /home/gregory/.ssh
RUN mkdir /home/gregory/source/
RUN touch /home/gregory/.ssh/known_hosts
RUN chown -R gregory:gregory /home/gregory/

# open port
EXPOSE 22

VOLUME /home/gregory/source/

# container init
ADD ./start.sh /start.sh
RUN chmod 755 /start.sh
CMD ["/bin/bash", "/start.sh"]