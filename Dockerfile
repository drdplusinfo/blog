FROM php:7.3-fpm-stretch

ARG USER_ID=1000
ARG GROUP_ID=1000

# Install other missed extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
      mc \
      vim \
      zlib1g-dev \
      libaio-dev \
      libxml2-dev \
      librabbitmq-dev \
      curl \
      gnupg \
      libyaml-0-2 libyaml-dev \
      git \
      apt-transport-https \
      sudo \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN curl -s https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add - && \
	echo 'deb https://deb.nodesource.com/node_10.x stretch main' > /etc/apt/sources.list.d/nodesource.list && \
	echo 'deb-src https://deb.nodesource.com/node_10.x stretch main' >> /etc/apt/sources.list.d/nodesource.list && \
  apt-get update && apt-get install -y nodejs npm

RUN curl https://getcaddy.com | bash -s personal hook.service,http.cache,http.cgi,http.expires,http.minify

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

RUN pecl channel-update pecl.php.net \
    && pecl install yaml-2.0.4 \
    && pecl install xdebug-2.9.0 \
    && docker-php-ext-enable yaml \
    && docker-php-ext-install intl

# re-build www-data user with same user ID and group ID as a current host user (you)
RUN userdel -f www-data && \
		if getent group www-data ; then groupdel www-data; fi && \
		groupadd --gid ${GROUP_ID} www-data && \
		useradd www-data --no-log-init --gid ${USER_ID} --groups www-data --home-dir /home/www-data --shell /bin/bash && \
		mkdir -p /var/www && \
		chown -R www-data:www-data /var/www && \
		mkdir -p /home/www-data && \
		chown -R www-data:www-data /home/www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer && \
	chmod +x /usr/local/bin/composer && \
  chown www-data:www-data /usr/local/bin/composer

RUN echo 'alias ll="ls -al"' >> ~/.bashrc \
    && mkdir -p /var/log/php/tracy && chown -R www-data /var/log/php && chmod +w /var/log/php && \
    touch /var/log/caddy && chown www-data /var/log/caddy

RUN mkdir -p /var/www/blog
WORKDIR /var/www/blog
COPY ./blog /var/www/blog
COPY ./_docker /

RUN chmod +x /var/docker.sh && chown -R www-data:www-data /home/www-data && chmod -R 0600 /home/www-data/.ssh/*

ENV XDEBUG_CONFIG "remote_host=10.10.2.1 remote_enable=1 	idekey=PHPSTORM remote_log=/tmp/xdebug.log"

ENTRYPOINT ["sh", "/var/docker.sh"]
