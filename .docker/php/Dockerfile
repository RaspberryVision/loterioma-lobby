FROM raspberryvision/base-symfony:0.0.3-webskeleton

RUN apt-get update \
    && apt-get install -y --no-install-recommends vim curl debconf subversion git apt-transport-https apt-utils \
    build-essential locales acl mailutils wget nodejs zip unzip sudo \
    gnupg gnupg1 gnupg2 dos2unix zlib1g-dev libpng-dev libjpeg-dev libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev libfreetype6-dev libmagickwand-dev

RUN a2enmod headers \
    && sed -ri -e 's/^([ \t]*)(<\/VirtualHost>)/\1\tHeader set Access-Control-Allow-Origin "*"\n\1\2/g' /etc/apache2/sites-available/*.conf
RUN docker-php-ext-install mysqli pdo pdo_mysql gd bcmath intl