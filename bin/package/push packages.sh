#!/bin/sh

cd ../../vendor

cd znbundle/article && git add . && git commit -m upd && git push
cd ../../znbundle/messenger && git add . && git commit -m upd && git push
cd ../../znbundle/notify && git add . && git commit -m upd && git push
cd ../../znbundle/queue && git add . && git commit -m upd && git push
cd ../../znbundle/reference && git add . && git commit -m upd && git push
cd ../../znbundle/storage && git add . && git commit -m upd && git push
cd ../../znbundle/user && git add . && git commit -m upd && git push
cd ../../znbundle/dashboard && git add . && git commit -m upd && git push
cd ../../znbundle/language && git add . && git commit -m upd && git push
cd ../../znbundle/rbac && git add . && git commit -m upd && git push
cd ../../znbundle/talkbox && git add . && git commit -m upd && git push

cd ../../zncore/base && git add . && git commit -m upd && git push
cd ../../zncore/db && git add . && git commit -m upd && git push
cd ../../zncore/domain && git add . && git commit -m upd && git push

cd ../../zncrypt/base && git add . && git commit -m upd && git push
cd ../../zncrypt/jwt && git add . && git commit -m upd && git push
cd ../../zncrypt/pki && git add . && git commit -m upd && git push
cd ../../zncrypt/tunnel && git add . && git commit -m upd && git push

cd ../../zndoc/linux && git add . && git commit -m upd && git push
cd ../../zndoc/rest-api && git add . && git commit -m upd && git push
cd ../../zndoc/team && git add . && git commit -m upd && git push

cd ../../znexample/composer-package && git add . && git commit -m upd && git push
cd ../../znexample/database && git add . && git commit -m upd && git push
cd ../../znexample/phpunit && git add . && git commit -m upd && git push

cd ../../znfixture/geo && git add . && git commit -m upd && git push
cd ../../znfixture/info-bot && git add . && git commit -m upd && git push

cd ../../znfork/danog_madelineproto && git add . && git commit -m upd && git push

cd ../../znlib/rest && git add . && git commit -m upd && git push
cd ../../znlib/socket && git add . && git commit -m upd && git push
cd ../../znlib/web && git add . && git commit -m upd && git push
cd ../../znlib/console && git add . && git commit -m upd && git push
cd ../../znlib/init && git add . && git commit -m upd && git push
cd ../../znlib/db && git add . && git commit -m upd && git push
cd ../../znlib/fixture && git add . && git commit -m upd && git push
cd ../../znlib/migration && git add . && git commit -m upd && git push

#cd ../../znsandbox/bundle && git add . && git commit -m upd && git push
cd ../../znsandbox/sandbox && git add . && git commit -m upd && git push
#cd ../../znsandbox/telegram && git add . && git commit -m upd && git push
#cd ../../znsandbox/web && git add . && git commit -m upd && git push
#cd ../../znsandbox/yii2-legacy && git add . && git commit -m upd && git push

cd ../../zntool/dev && git add . && git commit -m upd && git push
cd ../../zntool/test && git add . && git commit -m upd && git push
cd ../../zntool/rest-client && git add . && git commit -m upd && git push
cd ../../zntool/generator && git add . && git commit -m upd && git push
cd ../../zntool/package && git add . && git commit -m upd && git push
cd ../../zntool/phar && git add . && git commit -m upd && git push
cd ../../zntool/stress && git add . && git commit -m upd && git push

#cd ../../zntpl/school3.local && git add . && git commit -m upd && git push
cd ../../zntpl/symfony4 && git add . && git commit -m upd && git push
cd ../../zntpl/telegram-bot && git add . && git commit -m upd && git push
cd ../../zntpl/telegram-client && git add . && git commit -m upd && git push
cd ../../zntpl/backend.vkrg && git add . && git commit -m upd && git push
#cd ../../zntpl/yii2 && git add . && git commit -m upd && git push

cd ../../znyii/base && git add . && git commit -m upd && git push
cd ../../znyii/app && git add . && git commit -m upd && git push
cd ../../znyii/error && git add . && git commit -m upd && git push
