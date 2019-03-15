# !/bin/sh

git clone https://github.com/mgp25/curve25519-php.git && cd curve25519-php
phpize
./configure --enable-curve25519
make
sudo make install
