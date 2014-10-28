echo "Ensure you have setup your parameters.yml and have no passkey on your ssh
key before running this script. If you have hit enter."
read x
set -x

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
git checkout -b develop public/develop
git checkout -b sandbox private/sandbox
git checkout -b private private/private
git checkout master
git push origin master develop
git push private master develop private sandbox
echo "Done"
