#!/bin/sh

cd ../..

#cd vendor/znlib/migration/bin
#php console_test db:migrate:up --withConfirm=0
#cd ../../../..

#chmod -R a+rw var
#rm -rf var/cache/test/*
#rm var/log/test.log

php vendor/phpunit/phpunit/phpunit