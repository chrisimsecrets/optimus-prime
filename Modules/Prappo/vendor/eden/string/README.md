![logo](http://eden.openovate.com/assets/images/cloud-social.png) Eden String
====
[![Build Status](https://api.travis-ci.org/Eden-PHP/String.png)](https://travis-ci.org/Eden-PHP/String)
====

- [Install](#install)
- [Introduction](#intro)
- [API](#api)
    - [addslashes](#addslashes)
    - [bin2hex](#bin2hex)
    - [chunkSplit](#chunkSplit)
    - [convertUudecode](#convertUudecode)
    - [convertUuencode](#convertUuencode)
    - [countChars](#countChars)
    - [crypt](#crypt)
    - [explode](#explode)
    - [hex2bin](#hex2bin)
    - [htmlEntityDecode](#htmlEntityDecode)
    - [htmlentities](#htmlentities)
    - [htmlspecialchars](#htmlspecialchars)
    - [htmlspecialcharsDecode](#htmlspecialcharsDecode)
    - [ireplace](#ireplace)
    - [istr](#istr)
    - [lcfirst](#lcfirst)
    - [len](#len)
    - [ltrim](#ltrim)
    - [md5](#md5)
    - [nl2br](#nl2br)
    - [pad](#pad)
    - [pbrk](#pbrk)
    - [pos](#pos)
    - [pregReplace](#pregReplace)
    - [quotedPrintableDecode](#quotedPrintableDecode)
    - [quotedPrintableEncode](#quotedPrintableEncode)
    - [quotemeta](#quotemeta)
    - [repeat](#repeat)
    - [replace](#replace)
    - [rev](#rev)
    - [rot13](#rot13)
    - [rtrim](#rtrim)
    - [sha1](#sha1)
    - [shuffle](#shuffle)
    - [sprintf](#sprintf)
    - [str](#str)
    - [stripTags](#stripTags)
    - [stripcslashes](#stripcslashes)
    - [stripslashes](#stripslashes)
    - [substr](#substr)
    - [substrCompare](#substrCompare)
    - [substrCount](#substrCount)
    - [substrReplace](#substrReplace)
    - [tok](#tok)
    - [tolower](#tolower)
    - [toupper](#toupper)
    - [tr](#tr)
    - [trim](#trim)
    - [ucfirst](#ucfirst)
    - [ucwords](#ucwords)
    - [vsprintf](#vsprintf)
    - [wordwrap](#wordwrap)
- [Contributing](#contributing)

====

<a name="install"></a>
## Install

`composer install eden/string`

====

## Enable Eden

The following documentation uses `eden()` in its example reference. Enabling this function requires an extra step as descirbed in this section which is not required if you access this package using the following.

```
Eden_String_Index::i();
```

When using composer, there is not an easy way to access functions from packages. As a workaround, adding this constant in your code will allow `eden()` to be available after. 

```
Eden::DECORATOR;
```

For example:

```
Eden::DECORATOR;

eden()->inspect('Hello World');
```

====

<a name="intro"></a>
## Introduction

Chainable string methods. When using multiple PHP string functions in one line, it makes code harder to read. This is because a programmer needs to be trained to read code from inner to outer, rather than traditionally left to right (unless you live in Japan). Eden's data typing are objects that correct this readability problem.


```
str_replace('L', 'y', strtoupper(substr('hello', 1, 3))); // Eyy
```

The above demonstrates that we must read this as `substr()`, then `strtoupper()`, followed by `str_replace()` which is inner function first going outwards. The example below shows how using types makes this line easier to read.

```
echo eden('string')->set('hello')->substr(1, 3)->toupper()->replace('L', 'y'); //--> Eyy
```
Expressed vertically as below shows something more pleasing to a developer. 

```
echo eden('string')
	->set('hello')
	->substr(1, 3)
	->toupper()
	->replace('L', 'y'); //--> Eyy
```

When echoed the string object will automatically convert to a native string. Eden covers most of the string functions provided by PHP. Below is a list of string methods you can linearly perform.

====

<a name="api"></a>
## API

====

<a name="addslashes"></a>


### addslashes

Same as PHP: addslashes

#### Usage

```
eden('string')->addslashes();
```

#### Example

```
eden('string')->set('Hel"\'lo')->addslashes();
```

====

<a name="bin2hex"></a>


### bin2hex

Same as PHP: bin2hex

#### Usage

```
eden('string')->bin2hex();
```

#### Example

```
eden('string')->set('01010100100')->bin2hex();
```

====

<a name="chunkSplit"></a>


### chunkSplit

Same as PHP: chunk_split

#### Usage

```
eden('string')->chunkSplit(int $length, string $separator);
```

#### Example

```
eden('string')->set('Hello')->chunkSplit(2, ':');
```

====

<a name="convertUudecode"></a>


### convertUudecode

Same as PHP: convert_uudecode

#### Usage

```
eden('string')->convertUudecode();
```

#### Example

```
eden('string')->set('%2&5L;&\`\n`\n')->convertUudecode();
```

====

<a name="convertUuencode"></a>


### convertUuencode

Same as PHP: convert_uuencode

#### Usage

```
eden('string')->convertUuencode();
```

#### Example

```
eden('string')->set('Hello')->convertUuencode();
```

====

<a name="countChars"></a>


### countChars

Same as PHP: count_chars

#### Usage

```
eden('string')->countChars(int $min_length);
```

#### Example

```
eden('string')->set('Hello')->countChars(1);
```

====

<a name="crypt"></a>


### crypt

Same as PHP: crypt

#### Usage

```
eden('string')->crypt(string $salt);
```

#### Example

```
eden('string')->set('Hello')->crypt('123');
```

====

<a name="explode"></a>


### explode

Same as PHP: explode

#### Usage

```
eden('string')->explode(string $separator[,int $limit]);
```

#### Example

```
eden('string')->set('1-2-3-4')->explode('-');
```

====

<a name="hex2bin"></a>


### hex2bin

Same as PHP: hex2bin

#### Usage

```
eden('string')->hex2bin();
```

#### Example

```
eden('string')->set('3031303130313030313030')->hex2bin();
```

====

<a name="htmlEntityDecode"></a>


### htmlEntityDecode

Same as PHP: html_entity_decode

#### Usage

```
eden('string')->htmlEntityDecode();
```

#### Example

```
eden('string')->set('&amp;')->htmlEntityDecode();
```

====

<a name="htmlentities"></a>


### htmlentities

Same as PHP: htmlentities

#### Usage

```
eden('string')->htmlentities();
```

#### Example

```
eden('string')->set('&')->htmlentities();
```

====

<a name="htmlspecialchars"></a>


### htmlspecialchars

Same as PHP: htmlspecialchars

#### Usage

```
eden('string')->htmlspecialchars();
```

#### Example

```
eden('string')->set('&')->htmlspecialchars();
```

====

<a name="htmlspecialcharsDecode"></a>


### htmlspecialcharsDecode

Same as PHP: htmlspecialchars_decode

#### Usage

```
eden('string')->htmlspecialcharsDecode();
```

#### Example

```
eden('string')->set('&amp;')->htmlspecialcharsDecode();
```

====

<a name="lcfirst"></a>


### lcfirst

Same as PHP: lcfirst

#### Usage

```
eden('string')->lcfirst();
```

#### Example

```
eden('string')->set('Hello')->lcfirst();
```

====

<a name="ltrim"></a>


### ltrim

Same as PHP: ltrim

#### Usage

```
eden('string')->ltrim();
```

#### Example

```
eden('string')->set('   Hello')->ltrim();
```

====

<a name="md5"></a>


### md5

Same as PHP: md5

#### Usage

```
eden('string')->md5();
```

#### Example

```
eden('string')->set('Hello')->md5();
```

====

<a name="nl2br"></a>


### nl2br

Same as PHP: nl2br

#### Usage

```
eden('string')->nl2br();
```

#### Example

```
eden('string')->set("Hel\nlo")->nl2br();
```

====

<a name="pregReplace"></a>


### pregReplace

Same as PHP: preg_replace

#### Usage

```
eden('string')->pregReplace(string $regex, string $replacement);
```

#### Example

```
eden('string')->set('Hello')->pregReplace('/e/', 'i');
```

====

<a name="quotedPrintableDecode"></a>


### quotedPrintableDecode

Same as PHP: quoted_printable_decode

#### Usage

```
eden('string')->quotedPrintableDecode();
```

#### Example

```
eden('string')->set('Hello')->quotedPrintableDecode();
```

====

<a name="quotedPrintableEncode"></a>


### quotedPrintableEncode

Same as PHP: quoted_printable_encode

#### Usage

```
eden('string')->quotedPrintableEncode();
```

#### Example

```
eden('string')->set('Hello')->quotedPrintableEncode();
```

====

<a name="quotemeta"></a>


### quotemeta

Same as PHP: quotemeta

#### Usage

```
eden('string')->quotemeta();
```

#### Example

```
eden('string')->set('Hello')->quotemeta();
```

====

<a name="rtrim"></a>


### rtrim

Same as PHP: rtrim

#### Usage

```
eden('string')->rtrim();
```

#### Example

```
eden('string')->set('Hello   ')->rtrim();
```

====

<a name="sha1"></a>


### sha1

Same as PHP: sha1

#### Usage

```
eden('string')->sha1();
```

#### Example

```
eden('string')->set('Hello')->sha1();
```

====

<a name="sprintf"></a>


### sprintf

Same as PHP: sprintf

#### Usage

```
eden('string')->sprintf([mixed $variable[, mixed $variable2 ..]]);
```

#### Example

```
eden('string')->set('Hello %s')->sprintf('You');
```

====

<a name="ireplace"></a>


### ireplace

Same as PHP: str_ireplace

#### Usage

```
eden('string')->ireplace(string $needle, string $replacement);
```

#### Example

```
eden('string')->set('Hello')->ireplace('l', 'y');
```

====

<a name="pad"></a>


### pad

Same as PHP: str_pad

#### Usage

```
eden('string')->pad(int $length, string $replacement);
```

#### Example

```
eden('string')->set('Hello')->pad(7, 'o');
```

====

<a name="repeat"></a>


### repeat

Same as PHP: str_repeat

#### Usage

```
eden('string')->repeat(int $multiplier);
```

#### Example

```
eden('string')->set('Hello')->repeat(3);
```

====

<a name="replace"></a>


### replace

Same as PHP: str_replace

#### Usage

```
eden('string')->replace(string $needle, string $replacement);
```

#### Example

```
eden('string')->set('Hello')->replace('l', 'y');
```

====

<a name="rot13"></a>


### rot13

Same as PHP: str_rot13

#### Usage

```
eden('string')->rot13();
```

#### Example

```
eden('string')->set('Hello')->rot13();
```

====

<a name="shuffle"></a>


### shuffle

Same as PHP: str_shuffle

#### Usage

```
eden('string')->shuffle();
```

#### Example

```
eden('string')->set('Hello')->shuffle();
```

====

<a name="stripTags"></a>


### stripTags

Same as PHP: strip_tags

#### Usage

```
eden('string')->stripTags([string $allowableTags]);
```

#### Example

```
eden('string')->set('H<b>e</b>llo')->stripTags();
```

====

<a name="stripcslashes"></a>


### stripcslashes

Same as PHP: stripcslashes

#### Usage

```
eden('string')->stripcslashes();
```

#### Example

```
eden('string')->set('Hello')->stripcslashes();
```

====

<a name="stripslashes"></a>


### stripslashes

Same as PHP: stripslashes

#### Usage

```
eden('string')->stripslashes();
```

#### Example

```
eden('string')->set('He\\llo')->stripslashes();
```

====

<a name="istr"></a>


### istr

Same as PHP: stristr

#### Usage

```
eden('string')->istr(string $needle);
```

#### Example

```
eden('string')->set('Hello')->istr('e');
```

====

<a name="len"></a>


### len

Same as PHP: strlen

#### Usage

```
eden('string')->len();
```

#### Example

```
eden('string')->set('Hello')->len();
```

====

<a name="pbrk"></a>


### pbrk

Same as PHP: strpbrk

#### Usage

```
eden('string')->pbrk(string $needle);
```

#### Example

```
eden('string')->set('Hello')->pbrk('abcdefgh');
```

====

<a name="pos"></a>


### pos

Same as PHP: strpos

#### Usage

```
eden('string')->pos(string $needle);
```

#### Example

```
eden('string')->set('Hello')->pos('e');
```

====

<a name="rev"></a>


### rev

Same as PHP: strrev

#### Usage

```
eden('string')->rev();
```

#### Example

```
eden('string')->set('Hello')->rev();
```

====

<a name="str"></a>


### str

Same as PHP: strstr

#### Usage

```
eden('string')->str(string $needle);
```

#### Example

```
eden('string')->set('Hello')->str('e');
```

====

<a name="tok"></a>


### tok

Same as PHP: strtok

#### Usage

```
eden('string')->tok(string $needle);
```

#### Example

```
eden('string')->set('Hello')->tok('e');
```

====

<a name="tolower"></a>


### tolower

Same as PHP: strtolower

#### Usage

```
eden('string')->tolower();
```

#### Example

```
eden('string')->set('Hello')->tolower();
```

====

<a name="toupper"></a>


### toupper

Same as PHP: strtoupper

#### Usage

```
eden('string')->toupper();
```

#### Example

```
eden('string')->set('Hello')->toupper();
```

====

<a name="tr"></a>


### tr

Same as PHP: strtr

#### Usage

```
eden('string')->tr(string $needle, string $replacement);
```

#### Example

```
eden('string')->set('Hello')->tr('e', 'y');
```

====

<a name="substr"></a>


### substr

Same as PHP: substr

#### Usage

```
eden('string')->substr(int $start[, int $length]);
```

#### Example

```
eden('string')->set('Hello')->substr(2, 2);
```

====

<a name="substrCompare"></a>


### substrCompare

Same as PHP: substr_compare

#### Usage

```
eden('string')->substrCompare(string $needle, int $index);
```

#### Example

```
eden('string')->set('Hello')->substrCompare('el', 3);
```

====

<a name="substrCount"></a>


### substrCount

Same as PHP: substr_count

#### Usage

```
eden('string')->substrCount(string $needle);
```

#### Example

```
eden('string')->set('Hello')->substrCount('l');
```

====

<a name="substrReplace"></a>


### substrReplace

Same as PHP: substr_replace

#### Usage

```
eden('string')->substrReplace(string $replacement, int $start, int $length);
```

#### Example

```
eden('string')->set('Hello')->substrReplace('yy', 2, 2);
```

====

<a name="trim"></a>


### trim

Same as PHP: trim

#### Usage

```
eden('string')->trim();
```

#### Example

```
eden('string')->set('Hello')->trim();
```

====

<a name="ucfirst"></a>


### ucfirst

Same as PHP: ucfirst

#### Usage

```
eden('string')->ucfirst();
```

#### Example

```
eden('string')->set('Hello')->ucfirst();
```

====

<a name="ucwords"></a>


### ucwords

Same as PHP: ucwords

#### Usage

```
eden('string')->ucwords();
```

#### Example

```
eden('string')->set('Hello')->ucwords();
```

====

<a name="vsprintf"></a>


### vsprintf

Same as PHP: vsprintf

#### Usage

```
eden('string')->vsprintf(array $replacements);
```

#### Example

```
eden('string')->set('Hello %s')->vsprintf(array('You'));
```

====

<a name="wordwrap"></a>


### wordwrap

Same as PHP: wordwrap

#### Usage

```
eden('string')->wordwrap(int $length[, string $replacement]);
```

#### Example

```
eden('string')->set('Hello You')->wordwrap(3, '<br />');
```

====

<a name="contributing"></a>
#Contributing to Eden

Contributions to *Eden* are following the Github work flow. Please read up before contributing.

##Setting up your machine with the Eden repository and your fork

1. Fork the repository
2. Fire up your local terminal create a new branch from the `v4` branch of your 
fork with a branch name describing what your changes are. 
 Possible branch name types:
    - bugfix
    - feature
    - improvement
3. Make your changes. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")

##Making pull requests

1. Please ensure to run `phpunit` before making a pull request.
2. Push your code to your remote forked version.
3. Go back to your forked version on GitHub and submit a pull request.
4. An Eden developer will review your code and merge it in when it has been classified as suitable.