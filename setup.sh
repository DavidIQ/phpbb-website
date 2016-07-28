echo "Ensure you have setup your parameters.yml and have no passkey on your ssh
key before running this script. If you have hit enter."
read x
set -x

alias sf2='php app/console'

git remote add public git@github.com:phpbb/phpbb-website.git
git remote add private git@github.com:phpbb/phpbb-website-private.git
git push public master
git push private master
php composer.phar install
sf2 doctrine:database:create --env=dev
sf2 doctrine:database:create --env=test --connection=default
sf2 doctrine:database:create --env=test --connection=phpbb
sf2 doctrine:migrations:migrate

# Merge.sh variation
git status -sb
git fetch public
git fetch private
git checkout -b master public/master
git checkout -b private private/private
git checkout -b private private/www1-stable
git checkout master
git push origin master
git push private master private www1-stable
echo "Done"
