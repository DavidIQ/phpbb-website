echo "Ensure you have setup your parameters.yml and have no passkey on your ssh
key before running this script. If not hit Ctrl + C now."
sleep 5
set -x

php composer.phar self-update
git remote add public git@github.com:phpbb/phpbb-website.git
git remote add private git@github.com:phpbb/phpbb-website-private.git
git push public master
git push private master
php composer.phar install
php app/console doctrine:database:create
php app/console doctrine:migrations:migrate

# Merge.sh variation
git status -sb
git fetch public
git fetch private
git checkout -b master public/master
git merge public/master
git merge private/master
git checkout -b develop public/develop
git merge public/develop
git merge private/develop
git merge master
git checkout -b sandbox private/sandbox
git merge private/sandbox
git merge develop
git merge private/private
git merge master
git checkout -b private private/private
git merge private/private
git merge master
git checkout master
git push origin master develop
git push private master develop private sandbox
echo "Done"
