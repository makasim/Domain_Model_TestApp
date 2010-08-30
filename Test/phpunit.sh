#!/bin/sh

PHPUNIT_COMMAND=`pwd`/../Lib/phpunit/phpunit.php;
php53 -d auto_prepend_file=prepend.php $PHPUNIT_COMMAND "$@";