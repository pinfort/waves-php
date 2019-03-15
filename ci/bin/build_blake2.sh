# !/bin/sh

git clone git@github.com:strawbrary/php-blake2.git && cd php-blake2
phpize
./configure --enable-blake2
make && sudo make install
