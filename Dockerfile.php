FROM ubuntu:xenial

RUN apt-get update
RUN apt-get install -y php7.0-dev git
RUN mkdir /src && git clone https://github.com/tony2001/pinba_extension /src/pinba_extension
RUN cd /src/pinba_extension && find . && phpize && ./configure --enable-pinba && make install
RUN echo "extension=/usr/lib/php/20151012/pinba.so\npinba.enabled=1\npinba.server=mysql" > /etc/php/7.0/cli/conf.d/99-pinba.ini

EXPOSE ["9000"]