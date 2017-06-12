![logo](http://eden.openovate.com/assets/images/cloud-social.png) Eden Array
====
[![Build Status](https://api.travis-ci.org/Eden-PHP/Array.png)](https://travis-ci.org/Eden-PHP/Array)
====

- [Install](#install)
- [Introduction](#intro)
- [API](#api)
    - [arsort](#arsort)
    - [asort](#asort)
    - [changeKeyCase](#changeKeyCase)
    - [chunk](#chunk)
    - [combine](#combine)
    - [count](#count)
    - [countValues](#countValues)
    - [diff](#diff)
    - [diffAssoc](#diffAssoc)
    - [diffKey](#diffKey)
    - [diffUassoc](#diffUassoc)
    - [diffUkey](#diffUkey)
    - [fill](#fill)
    - [fillKeys](#fillKeys)
    - [filter](#filter)
    - [flip](#flip)
    - [implode](#implode)
    - [inArray](#inArray)
    - [intersect](#intersect)
    - [intersectAssoc](#intersectAssoc)
    - [intersectKey](#intersectKey)
    - [intersectUassoc](#intersectUassoc)
    - [intersectUkey](#intersectUkey)
    - [keys](#keys)
    - [krsort](#krsort)
    - [ksort](#ksort)
    - [map](#map)
    - [merge](#merge)
    - [mergeRecursive](#mergeRecursive)
    - [natcasesort](#natcasesort)
    - [natsort](#natsort)
    - [pad](#pad)
    - [pop](#pop)
    - [push](#push)
    - [reverse](#reverse)
    - [rsort](#rsort)
    - [search](#search)
    - [shift](#shift)
    - [shuffle](#shuffle)
    - [sizeof](#sizeof)
    - [slice](#slice)
    - [sort](#sort)
    - [splice](#splice)
    - [sum](#sum)
    - [uasort](#uasort)
    - [udiff](#udiff)
    - [udiffAssoc](#udiffAssoc)
    - [udiffUassoc](#udiffUassoc)
    - [uintersect](#uintersect)
    - [uintersectAssoc](#uintersectAssoc)
    - [uintersectUassoc](#uintersectUassoc)
    - [uksort](#uksort)
    - [unique](#unique)
    - [unshift](#unshift)
    - [usort](#usort)
    - [values](#values)
    - [walk](#walk)
    - [walkRecursive](#walkRecursive)
- [Contributing](#contributing)

====

<a name="install"></a>
## Install

`composer install eden/array`

====

## Enable Eden

The following documentation uses `eden()` in its example reference. Enabling this function requires an extra step as descirbed in this section which is not required if you access this package using the following.

```
Eden_Array_Index::i();
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

Chainable array methods. When using multiple PHP array functions in one line, it makes code harder to read. This is because a programmer needs to be trained to read code from inner to outer, rather than traditionally left to right (unless you live in Japan). Eden's data typing are objects that correct this readability problem.


```
array_keys(array_reverse(array_flip(array(4, 5, 6)))); // [6, 5, 4]
```

The above demonstrates that we must read this as `array_flip()`, then `array_reverse()`, followed by `array_keys()` which is inner function first going outwards. The example below shows how using types makes this line easier to read.

```
echo eden('array')->set(4, 5, 6)->flip()->reverse()->keys(); //--> [6, 5, 4]
```

When echoed the array object will automatically convert to a readable json. Eden covers most of the array functions provided by PHP. Below is a list of string methods you can linearly perform.

```
echo eden('array')
	->set(4, 5, 6)
	->flip()
	->reverse()
	->keys(); //--> [6, 5, 4]
```

Expressed vertically as above shows something more pleasing to a developer. Array objects, 
for the most part, can also be treated as regular arrays as implied below.

```
//instantiate
$array = eden('array')->set(1, 2, 3);

//push in a new value
$array[] = 4;
 
echo $array[1];  //--> 2
 
foreach($array as $key => $value) {} //loop through array
```

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
eden('string')->set('Hello')->addslashes();
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
eden('string')->set('Hello')->bin2hex();
```

====

<a name="chunkSplit"></a>


### chunkSplit

Same as PHP: chunk_split

#### Usage

```
eden('string')->chunkSplit();
```

#### Example

```
eden('string')->set('Hello')->chunkSplit();
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
eden('string')->set('Hello')->convertUudecode();
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
eden('string')->countChars();
```

#### Example

```
eden('string')->set('Hello')->countChars();
```

====

<a name="crypt"></a>


### crypt

Same as PHP: crypt

#### Usage

```
eden('string')->crypt();
```

#### Example

```
eden('string')->set('Hello')->crypt();
```

====

<a name="explode"></a>


### explode

Same as PHP: explode

#### Usage

```
eden('string')->explode();
```

#### Example

```
eden('string')->set('Hello')->explode();
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
eden('string')->set('Hello')->hex2bin();
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
eden('string')->set('Hello')->htmlEntityDecode();
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
eden('string')->set('Hello')->htmlentities();
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
eden('string')->set('Hello')->htmlspecialchars();
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
eden('string')->set('Hello')->htmlspecialcharsDecode();
```

====

<a name="ipTags"></a>


### ipTags

Same as PHP: strip_tags

#### Usage

```
eden('string')->ipTags();
```

#### Example

```
eden('string')->set('Hello')->ipTags();
```

====

<a name="ipcslashes"></a>


### ipcslashes

Same as PHP: stripcslashes

#### Usage

```
eden('string')->ipcslashes();
```

#### Example

```
eden('string')->set('Hello')->ipcslashes();
```

====

<a name="ipslashes"></a>


### ipslashes

Same as PHP: stripslashes

#### Usage

```
eden('string')->ipslashes();
```

#### Example

```
eden('string')->set('Hello')->ipslashes();
```

====

<a name="ireplace"></a>


### ireplace

Same as PHP: str_ireplace

#### Usage

```
eden('string')->ireplace();
```

#### Example

```
eden('string')->set('Hello')->ireplace();
```

====

<a name="istr"></a>


### istr

Same as PHP: stristr

#### Usage

```
eden('string')->istr();
```

#### Example

```
eden('string')->set('Hello')->istr();
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

<a name="ltrim"></a>


### ltrim

Same as PHP: ltrim

#### Usage

```
eden('string')->ltrim();
```

#### Example

```
eden('string')->set('Hello')->ltrim();
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
eden('string')->set('Hello')->nl2br();
```

====

<a name="pad"></a>


### pad

Same as PHP: str_pad

#### Usage

```
eden('string')->pad();
```

#### Example

```
eden('string')->set('Hello')->pad();
```

====

<a name="pbrk"></a>


### pbrk

Same as PHP: strpbrk

#### Usage

```
eden('string')->pbrk();
```

#### Example

```
eden('string')->set('Hello')->pbrk();
```

====

<a name="pos"></a>


### pos

Same as PHP: strpos

#### Usage

```
eden('string')->pos();
```

#### Example

```
eden('string')->set('Hello')->pos();
```

====

<a name="pregReplace"></a>


### pregReplace

Same as PHP: preg_replace

#### Usage

```
eden('string')->pregReplace();
```

#### Example

```
eden('string')->set('Hello')->pregReplace();
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

<a name="repeat"></a>


### repeat

Same as PHP: str_repeat

#### Usage

```
eden('string')->repeat();
```

#### Example

```
eden('string')->set('Hello')->repeat();
```

====

<a name="replace"></a>


### replace

Same as PHP: str_replace

#### Usage

```
eden('string')->replace();
```

#### Example

```
eden('string')->set('Hello')->replace();
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

<a name="rtrim"></a>


### rtrim

Same as PHP: rtrim

#### Usage

```
eden('string')->rtrim();
```

#### Example

```
eden('string')->set('Hello')->rtrim();
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

<a name="sprintf"></a>


### sprintf

Same as PHP: sprintf

#### Usage

```
eden('string')->sprintf();
```

#### Example

```
eden('string')->set('Hello')->sprintf();
```

====

<a name="str"></a>


### str

Same as PHP: strstr

#### Usage

```
eden('string')->str();
```

#### Example

```
eden('string')->set('Hello')->str();
```

====

<a name="substr"></a>


### substr

Same as PHP: substr

#### Usage

```
eden('string')->substr();
```

#### Example

```
eden('string')->set('Hello')->substr();
```

====

<a name="substrCompare"></a>


### substrCompare

Same as PHP: substr_compare

#### Usage

```
eden('string')->substrCompare();
```

#### Example

```
eden('string')->set('Hello')->substrCompare();
```

====

<a name="substrCount"></a>


### substrCount

Same as PHP: substr_count

#### Usage

```
eden('string')->substrCount();
```

#### Example

```
eden('string')->set('Hello')->substrCount();
```

====

<a name="substrReplace"></a>


### substrReplace

Same as PHP: substr_replace

#### Usage

```
eden('string')->substrReplace();
```

#### Example

```
eden('string')->set('Hello')->substrReplace();
```

====

<a name="tok"></a>


### tok

Same as PHP: strtok

#### Usage

```
eden('string')->tok();
```

#### Example

```
eden('string')->set('Hello')->tok();
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
eden('string')->tr();
```

#### Example

```
eden('string')->set('Hello')->tr();
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
eden('string')->vsprintf();
```

#### Example

```
eden('string')->set('Hello')->vsprintf();
```

====

<a name="wordwrap"></a>


### wordwrap

Same as PHP: wordwrap

#### Usage

```
eden('string')->wordwrap();
```

#### Example

```
eden('string')->set('Hello')->wordwrap();
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