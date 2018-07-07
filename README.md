# GiBiLogic SluggerBundle

A small bundle that contains a ready-to-use slugger service for Symfony 2.

The slugify operation:

* Removes new lines (`\n`) and/or carriage returns (`\r`)
* Replaces extended characters ("æ" and "Ñ", for example) into their "plain" versions ("ae" and "n", for example)
* Converts the entire string in lower case (by using the `mb_strtolower` function)
* Replaces every non-letter non-number character with a separator (defaults to `-`)

## Installation

Add this bundle to the composer.json of your application with the console command:

```bash
composer require gibilogic/slugger-bundle
```

Or, if you are using `composer.phar`, use the console command:

```bash
php composer.phar require gibilogic/slugger-bundle
```

Add the bundle to your `AppKernel.php`:

```php
...
new Gibilogic\SluggerBundle\GibilogicSluggerBundle(),
...
```

## Usage

Inside your Symfony 2 application, get the slugger service:

```php
/* @var \Gibilogic\SluggerBundle\Service\Slugger $sluggerService */
$sluggerService = $this->container->get('gibilogic.slugger');
```

Then call its `slugify` method:

```php
$slug = $sluggerService->slugify($string);
```

You can also specify the slug character separator (defaults to `-`):

```php
$slug = $sluggerService->slugify($string, '_');
```
