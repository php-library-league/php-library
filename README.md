[![PHP Library Logo]][PHP Library Official Website]

# Description

PHP Library is a set of classes that contain the most useful attributes and methods that facilitate the development of Web applications.
Project is open-sourced under MIT licence on [GitHub]. Available over Composer and [Packagist].

[![Latest Stable Version]][latest release]
[![Total Downloads]][Packagist]
[![Travis Build Status]][Travis-CI]
[![Coverage Status]][Coverals]

# Organisation
Every native class call should have following type of namespace call in front.

```php
// Example of namespace structure
use PHP_Library\Class_Subpackage\Class_Namespace\Class_Name;
```

* All classes are inside [src folder].
* All unit tests are inside [tests folder].

Autoload file is created by Composer and it's located inside vendor folder.

```php
// How to access PHP Library classes
include_once 'vendor/autoload.php';
```

# Installation

There are two ways of using PHP Library. First one is to install it inside another project, let's say framework like CodeIgniter or Laravel. Second one is to install it for development. Either way, you need PHP 7 and Composer to do it. Here's detailed list of PHP versions supported.

PHP  | Production | Development
---- | ---------- | -----------
7.0  | Yes        | No
7.1  | Yes        | No
7.2  | Yes        | Yes
7.3  | Yes        | Yes
7.4  | Yes        | Yes

**Production** column shows on which versions PHP Library will work. **Development** column shows on which versions PHP Library is guaranteed to work and could be developed.

## Manual

If you want the stable version, get the [latest release] from the releases page.

## Composer

Install stable library version by using standard commands.

```bash
# Install PHP Library via Composer
composer require 90zlaya/php-library
```

## GitHub

If you want to develop this library and use GitHub instead of manual download, just clone repository to your hard drive.

```bash
# Clone repository via Git
git clone https://github.com/90zlaya/php-library.git
```

# Development

## Coding standard

PHP Library has it's own coding standard which deviates from PSR-2 standard with no much exceptions. To contribute to development of this project, you must follow this standard. [PHP_CodeSniffer] does this job for you in development versions of PHP Library.

```bash
# Run coding standard for all PHP files in library
composer run phpcs
```

If you want to find out more about specific rules, open [ruleset.xml] file which is located in root directory.

## Bug analysis

This library has been tested with [PHP Stan] and approved as bug-free for all classes. It's recommended to run following command to check for buggs in project.

```bash
# Run bug analysis
composer run phpstan
```

## Unit testing

All tests are covered with PHPUnit framework and stored inside tests folder. They need [outsource folder] to perform specific tests, which you have to download and unzip in PHP Library's root directory.

```bash
# Download outsource repository
wget https://github.com/php-library-league/outsource/archive/1.1.0.zip

# Unzip and remove downloaded file
unzip 1.1.0.zip && rm -rf 1.1.0.zip

# Rename folder
mv outsource-1.1.0/ outsource/

# Unzip archive
unzip outsource/archive.zip -d outsource/

# Give full permissions to all files and folders
chmod -R 777 outsource/
```

Command for running unit tests will target [phpunit.xml] file which is located inside root directory.

```bash
# Run PHPUnit tests
composer run phpunit
```

# References

## Inspiration

Idea behind creation of this repository is making everyday Web Development process faster and easier.

## Logo

Official PHP Library logo is designed by [designseed.co] - an unlimited custom graphic design service.

## Customers

This library is powering following Websites/Web Applications:

### [Zlatan Stajic]

![Homepage of zlatanstajic.com]

### [Space Prospection]

![Homepage of Space Prospection]

## API documentation

Official PHP Library API documentation has been documented by [phpDocumentor] and could be studied online on [API].

## Coverage

Official PHP Library code coverage report has been composed by [xDebug] and could be studied online on [coverage].

## Migration

All versions equal to PHP Library v2.0 or higher follow strict semantic versioning rules. All tests are guaranteed to pass for minor and patch versions, but major version change will make application crash.

## Acknowledgements

Copyright © 2017-2019 | [Zlatan Stajic] | Released under the [MIT License]

[Zlatan Stajic]: https://www.zlatanstajic.com/
[GitHub]: https://github.com/90zlaya/php-library
[Packagist]: https://packagist.org/packages/90zlaya/php-library
[Travis-CI]: https://travis-ci.org/90zlaya/php-library
[Coverals]:https://coveralls.io/github/90zlaya/php-library
[MIT License]: http://www.opensource.org/licenses/mit-license.php
[latest release]: https://github.com/90zlaya/php-library/releases/latest
[PHP Library Official Website]: https://php-library.zlatanstajic.com
[API]: https://php-library.zlatanstajic.com/api/
[coverage]: https://php-library.zlatanstajic.com/coverage/
[Zlatan Stajic]: https://www.zlatanstajic.com/
[Space Prospection]: https://space-prospection.zlatanstajic.com
[PHP Stan]: https://github.com/phpstan/phpstan
[phpDocumentor]: https://www.phpdoc.org/
[PHP_CodeSniffer]: https://github.com/squizlabs/PHP_CodeSniffer
[designseed.co]: https://designseedco.com/en/
[xDebug]: https://xdebug.org/
[outsource folder]: https://github.com/php-library-league/outsource
[src folder]: src/
[tests folder]: tests/

[ruleset.xml]: ruleset.xml
[phpunit.xml]: phpunit.xml

[PHP Library Logo]: https://php-library.zlatanstajic.com/assets/img/phplibrary-logo-blue.png?clear_cache=1
[Latest Stable Version]: https://poser.pugx.org/90zlaya/php-library/v/stable?clear_cache=1
[Total Downloads]: https://poser.pugx.org/90zlaya/php-library/downloads?clear_cache=1
[Travis Build Status]: https://img.shields.io/travis/90zlaya/php-library.svg?clear_cache=1
[Coverage Status]: https://coveralls.io/repos/github/90zlaya/php-library/badge.svg?branch=master&clear_cache=1
[Homepage of zlatanstajic.com]: https://link.zlatanstajic.com/images/portfolio/small/zlatanstajic.jpg?clear_cache=1
[Homepage of Space Prospection]: https://link.zlatanstajic.com/images/portfolio/small/space-prospection.jpg?clear_cache=1