ZLO for PHP 
=========

Zamphyr Localizaton (ZLO) is a lightweight, easy to use, text-based & naïf translation and localization system, made to facilitate inline syntactic translation and localization, and KISS in the process.

Features
---

  - ISO 639-2 & ISO-639-3 compatible
  - Inline translation like gettext
  - Plurals translation with natural number calculation
  - Translation domains for modular translation (plugins, addons, etc...)
  - Scan directory for available translation files
  - Helpers in header for HTML encoding, language and writing direction
  - Parsed in browsers so it's scriptable

Requirements
----

  - PHP 5.5

Usage
====

Instantiating
--
```php
use Zamphyr\ZLO;

include 'libzlo.php';

$libzlo = new libzlo("path/to/your/translation_files");

/**
 * Set ZL_LANG to current language you want to use.
 * You don't have to use $_GET it's just simple.
 */

$libzlo->ZL_LANG = isset($_GET["zl"]) ? $_GET['zl'] : NULL;
```

Translation
--

Put the literal string for translation inside *zlo()* function, and let the magic happen.

```php
echo $libzlo->zlo("Friday")
```
or if you're using it inside markup:

```php
<?= $libzlo->zlo("Why Friday?"); ?>
```

You can pass a number as a parameter and get the adequate non-singular form as a translation. This makes sense for non-English speakers, Arabic in particular.

```php
<?= $libzlo->zlo("pencil",13); ?>
```

Function calculates the form needed for number 13 in this case, and returns the translation in the proper form.

Meta stuff
----
If you want to check the instantiated directory for available trnaslation files use *zlo_lang_list()*. Returns an array with filenames.
```php
$libzlo->zlo_lang_list()
```
Header function *zlo_header()* will return an associative array with values from your translation header. You can pass *$code* of a translation file as a variable to check a file that's not being used at the moment.

```php
$libzlo->zlo_header(string* $code)
```
You can get the stats for a translation file using *zlo_stat()* It returns an array with useful info which includes:
  - Number of sources
  - Number of translations
  - Number of flagged translations
  - Translated per cent
  - Fuzzy translatons per cent
  - Translation file size in bytes

```php
$libzlo->zlo_stat($libzlo->ZL_LANG);
```

Version
----

  - 0.0.1

To-do
----

  - Demo for the masses!
  - Date and time implementation
  - Fix extension case sensitivity
  - Check plural formulas
  - Faster soluton for plural testing
  - Some basic debug helpers
  - Evaluator for directories to check for ZLO and create a translation file from it
  - A better README


License
----
Public Domain

** Dif-tor heh smusma! **