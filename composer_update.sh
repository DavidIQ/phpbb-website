echo ""
echo "$ git status -sb"
git status -sb
echo ""
echo "$ php composer.phar self-update"
php composer.phar self-update
echo ""
if [ "$1" == "-n" ]
then
	echo "$ composer self-update"
	composer self-update
	echo ""
	echo "$ composer update -v --dev"
	composer update -v --dev
else
	echo "$ php composer.phar update -v --dev"
	php composer.phar update -v --dev
fi
echo ""
echo "$ tests.sh"
tests.sh
echo ""
echo "COMPLETE!"
