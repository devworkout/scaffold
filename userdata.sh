#!/usr/bin/env bash

# Add swap
fallocate -l 1G /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile

# Add common stuff
apt-get -y update
apt-get -y install git docker-compose php-curl php-dom php-mbstring php-zip php-bcmath composer fish
export COMPOSER_HOME="$HOME/.config/composer"

#cat << EOF > /root/.ssh/id_rsa
#:ssh-private-key:
#EOF
#
#cat << EOF > /root/.ssh/id_rsa.pub
#:ssh-public-key:
#EOF

#chmod 777 /root/.ssh/id_rsa.pub
#chmod 600 /root/.ssh/id_rsa
ssh-keyscan bitbucket.org >> /root/.ssh/known_hosts
ssh-keyscan github.com >> /root/.ssh/known_hosts

mkdir /work
chmod -R 777 /work
cd /work

#git clone git@bitbucket.org::username:/:project_name:.git
git config --global user.email "vlad@serpentine.io"
git config --global user.name "Vladislav Otchenashev"

composer global require hirak/prestissimo

#cd /work/:project_name:
#composer install --no-dev
#mv ./.env.example ./.env
#docker-compose up -d --build
chmod -R 777 /work