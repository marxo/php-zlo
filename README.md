libZLO for PHP
=========

[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/zamphyr/zlo?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)

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

  - PHP 5.3+


To-do
----

  - ~~Demo for the masses!~~
  - Faster (non-blocking) file reading and parsing
  - ISO 6801 compatible date and time implementation
  - Fix extension case sensitivity
  - Check plural formulas
  - Faster soluton for plural testing
  - Some basic debug helpers
  - Evaluator for directories to check for ZLO and create a translation file from it
  - ~~A better README~~
  - Compatibility with ISO 639-1 (?)

Version
----

  - 0.0.1

Usage
====

Instantiating
--
```php
use Zamphyr\ZLO;

include 'libzlo.php';

$libzlo = new ZLO\libzlo("path/to/your/translation_files");

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

You can pass a number as a parameter and get the adequate non-singular form of the phrase for that number as a translation. This makes sense for non-English speakers, Arabic in particular.

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

License
----
This is free and unencumbered software released into the public domain.

Anyone is free to copy, modify, publish, use, compile, sell, or
distribute this software, either in source code form or as a compiled
binary, for any purpose, commercial or non-commercial, and by any
means.

In jurisdictions that recognize copyright laws, the author or authors
of this software dedicate any and all copyright interest in the
software to the public domain. We make this dedication for the benefit
of the public at large and to the detriment of our heirs and
successors. We intend this dedication to be an overt act of
relinquishment in perpetuity of all present and future rights to this
software under copyright law.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

For more information, please refer to <http://unlicense.org/>

**Dif-tor heh smusma!**

Contact & donations
----
You can get in touch with me via the e-mail noted inside the library.

If you wish to port libZLO to other languages, frameworks or systems, let me know so I can help you out.

You can support me by sending some BitCoin crypto-money to
```
1KVmMLp5MHm1R3iM7Kprp1rUShinzLVtrV
```
