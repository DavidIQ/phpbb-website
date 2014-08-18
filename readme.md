# phpBB Website

This is the copy of the new symfony website running at www.phpbb.com. The site is maintained by the [phpBB Website Team](https://www.phpbb.com/community/memberlist.php?mode=group&g=47077)

## Analysis Tools

Static Code Analysis from Scrutinizer CI: [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phpbb/phpbb-website/badges/quality-score.png?s=21078441fbd939c53fcfdca497f2c5a5d6a4e86d)](https://scrutinizer-ci.com/g/phpbb/phpbb-website/)

Static Code Analysis from SensioLabs Insights: *Coming Soon*

Test Suite Continous Integration from Travis CI:[![Build Status](https://travis-ci.org/phpbb/phpbb-website.svg?branch=master)](https://travis-ci.org/phpbb/phpbb-website)

Code Coverage from Bamboo: [phpBB Continous Integration (Bamboo)](https://bamboo.phpbb.com/browse/WEB-PUB)

## Setting up the website

1. Clone the repository (`git clone git@github.com:phpbb/phpbb-website.git`)
1. Copy `app/config/parameters.dist.yml` to `app/config/parameters.yml` and adjust confiuration as needed. The phpBB database connection is used for parts of the website which fetch from the community forums. You can either setup a blank forum and set this to it or have this as an empty database. The symfony database is the main database used by the site. There are two test databases which are used by phpunit and are destroyed/repopulated with test data whilst running tests so please setup two empty databases for use here.
1. Install the composer dependencies with `php composer.phar install` (composer.phar is in the repo)
1. Create the main website database which you have entered details for earlier if you have not yet created it with `php app/console doctrine:database:create`
1. Populate your website database with the database schema by running `php app/console doctrine:migrations:migrate`

## Contributing

If you wish to contribute something to the website simply fork this repository, make your changes in your fork and submit a pull request (please only have one change or a series of relevant changes in one pull request).

If you have any problems or would like some help you can email `website [at] phpbb [dot] com` or ask for help on IRC using the `#phpbb-dev` channel on [Freenode](http://webchat.freenode.net/).

## Bug Reporting

Please use our main [Website Issue Tracker](https://www.phpbb.com/bugs/website/) to report any bugs or suggest features/offer general website feedback in our [website feedback topic](https://www.phpbb.com/community/viewtopic.php?f=64&t=2103285).

## Unit Tests

We use phpunit for our unit tests but we don't require phpunit to be installed globally. Simply run `bin/phpunit -c app/` or `tests.sh` to run our tests and it will use phpunit downloaded by composer when you install the project dependencies.

## Dependencies

Should you have problems with composer retrieving depdenencies you can request a copy of the latest `vendor/` and `bin/` directories by emailing `website [at] phpbb [dot] com` or contacting us via IRC as described above.

## License

[GNU GPL v3](http://opensource.org/licenses/gpl-3.0)

By contributing you agree to assign copyright of your code to `phpBB Limited` - See the `LICENSE` file for the full license.
