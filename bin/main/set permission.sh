#!/bin/sh

cd ../..
sudo chmod -R a+rw common/runtime
sudo chmod -R a+rw frontend/web/assets
sudo chmod -R a+rw public/web/assets
ls -l
