FROM ubuntu:xenial

RUN apt-get update
RUN apt-get install -y php7.0-dev git
RUN mkdir /src && git clone https://github.com/tony2001/pinba_extension /src/pinba_extension
RUN cd /src/pinba_extension && find . && phpize && ./configure --enable-pinba && make install