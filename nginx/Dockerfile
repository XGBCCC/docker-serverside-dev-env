FROM ubuntu:18.04

LABEL maintainer="Mars <11@boxue.io>"
LABEL description="Docker container for server side development"

RUN apt-get update && \
        DEBIAN_FRONTEND=noninteractive apt-get install -y nginx iputils-ping vim \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN echo "daemon off;" >> /etc/nginx/nginx.conf \
        && mkdir -p /etc/nginx/ssl

ADD php-default /etc/nginx/sites-available/default
COPY apn.boxue.io* /etc/nginx/ssl/
# COPY apn.boxue.io.key /etx/nginx/ssl

RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

RUN ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && \
    mkdir -p /var/www/push-notifications/current && \
    chown www-data:www-data /var/www/push-notifications/current

CMD ["nginx"]

