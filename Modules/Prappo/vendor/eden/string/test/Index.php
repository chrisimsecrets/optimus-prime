<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

class Eden_String_Test_Index extends PHPUnit_Framework_TestCase
{
    public function testCamelize() 
	{
        $string         = 'test-value';
        $resultString   = 'testValue';
        $class = eden('string')->set($string)->camelize('-');
        $this->assertInstanceOf('Eden_String_Index', $class);
        $newString = $class->get();
        $this->assertEquals($resultString, $newString);
    }

    public function testDasherize() 
	{
        $string         = 'test Value';
        $resultString   = 'test-value';
        $class = eden('string')->set($string)->dasherize();
        $this->assertInstanceOf('Eden_String_Index', $class);
        $newString = $class->get();
        $this->assertEquals($resultString, $newString);
    }

    public function testSummarize() 
	{
        $string         = 'the quick brown fox jumps over the lazy dog';
        $resultString   = 'the quick';
        $class = eden('string')->set($string)->summarize(3);
        $this->assertInstanceOf('Eden_String_Index', $class);
        $newString = $class->get();
        $this->assertEquals($resultString, $newString);
    }
	
	public function testSet() 
	{
		$this->assertEquals('hello', eden('string')->set('HelLo')->toLower()->get());
    }

    public function testTitlize() 
	{
        $string         = 'test+Value';
        $resultString   = 'Test Value';
        $class = eden('string')->set($string)->titlize('+');
        $this->assertInstanceOf('Eden_String_Index', $class);
        $newString = $class->get();
        $this->assertEquals($resultString, $newString);
    }

    public function testUncamelize() 
	{
        $string         = 'testValue';
        $resultString   = 'test-value';
        $class = eden('string')->set($string)->uncamelize('-');
        $this->assertInstanceOf('Eden_String_Index', $class);
        $newString = $class->get();
        $this->assertEquals($resultString, $newString);
    }
	
	public function testAddslashes() 
	{
		$string         = '"\'\\';
		$resultString   = '\\"\\\'\\\\';
		$class = eden('string')->set($string)->addslashes();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->addslashes();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testBin2hex() 
	{
		$string         = '01010100100';
		$resultString   = '3031303130313030313030';
		$class = eden('string')->set($string)->bin2hex();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->bin2hex();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testChunkSplit() 
	{
		$string         = 'Hello';
		$resultString   = 'He:ll:o:';
		$class = eden('string')->set($string)->chunkSplit(2, ':');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->chunk_split(2, ':');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testConvertUudecode() 
	{
		$string         = "%2&5L;&\`\n`\n";
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->convertUudecode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->convert_uudecode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testConvertUuencode() 
	{
		$string         = 'Hello';
		$resultString   = "%2&5L;&\`\n`\n";
		$class = eden('string')->set($string)->convertUuencode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->convert_uuencode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testCountChars() 
	{
		$string         = 'Hello';
		$results = eden('string')->set($string)->countChars(1);
		$this->assertEquals(1, $results[72]);
		$this->assertEquals(1, $results[101]);
		$this->assertEquals(2, $results[108]);
		$this->assertEquals(1, $results[111]);
		
		$results = eden('string')->set($string)->count_chars(1);
		$this->assertEquals(1, $results[72]);
		$this->assertEquals(1, $results[101]);
		$this->assertEquals(2, $results[108]);
		$this->assertEquals(1, $results[111]);
	}

	public function testCrypt() 
	{
		$string         = 'Hello';
		$class = eden('string')->set($string)->crypt('123');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$hash = $class->get();
		$this->assertEquals($hash, crypt($string, '123'));
		
		$class = eden('string')->set($string)->crypt('123');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$hash = $class->get();
		$this->assertEquals($hash, crypt($string, '123'));
	}

	public function testExplode() 
	{
		$string         = '1-2-3-4';
		$results = eden('string')->set($string)->explode('-');
		$this->assertEquals('1', $results[0]);
		$this->assertEquals('2', $results[1]);
		$this->assertEquals('3', $results[2]);
		$this->assertEquals('4', $results[3]);
	}

	public function testHex2bin() 
	{
		$string         = '3031303130313030313030';
		$resultString   = '01010100100';
		$class = eden('string')->set($string)->hex2bin();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->hex2bin();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testHtmlEntityDecode() 
	{
		$string         = '&amp;';
		$resultString   = '&';
		$class = eden('string')->set($string)->htmlEntityDecode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->html_entity_decode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testHtmlentities() 
	{
		$string         = '&';
		$resultString   = '&amp;';
		$class = eden('string')->set($string)->htmlentities();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->htmlentities();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testHtmlspecialchars() 
	{
		$string         = '&';
		$resultString   = '&amp;';
		$class = eden('string')->set($string)->htmlspecialchars();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->htmlspecialchars();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testHtmlspecialcharsDecode() 
	{
		$string         = '&amp;';
		$resultString   = '&';
		$class = eden('string')->set($string)->htmlspecialcharsDecode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->htmlspecialchars_decode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testStripTags() 
	{
		$string         = '<b>Hello</b>';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->stripTags();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strip_tags();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testStripcslashes() 
	{
		$string         = 'H\x0aello';
		$resultString   = 'H'.chr(0x0A).'ello';
		
		$class = eden('string')->set($string)->stripcslashes();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testStripslashes() 
	{
		$string   		= '\\"\\\'\\\\';
		$resultString   = '"\'\\';
		$class = eden('string')->set($string)->stripslashes();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testIreplace() 
	{
		$string         = 'HelLo';
		$resultString   = 'Heyyo';
		$class = eden('string')->set($string)->ireplace('l', 'y');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->str_ireplace('l', 'y');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testIstr() 
	{
		$string         = 'Hello';
		$resultString   = 'ello';
		$class = eden('string')->set($string)->istr('e');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->stristr('e');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testLcfirst() 
	{
		$string         = 'HellO';
		$resultString   = 'hellO';
		$class = eden('string')->set($string)->lcfirst();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->lcfirst();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testLen() 
	{
		$string         = 'Hello';
		$result = eden('string')->set($string)->len();
		$this->assertEquals(5, $result);
		
		$result = eden('string')->set($string)->strlen();
		$this->assertEquals(5, $result);
	}

	public function testLtrim() 
	{
		$string         = '  Hello';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->ltrim();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testMd5() 
	{
		$string         = 'Hello';
		$resultString   = '8b1a9953c4611296a827abf8c47804d7';
		$class = eden('string')->set($string)->md5();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testNl2br() 
	{
		$string         = "Hel\nlo";
		$resultString   = "Hel<br />\nlo";
		$class = eden('string')->set($string)->nl2br();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testPad() 
	{
		$string         = 'Hello';
		$resultString   = 'Hellooo';
		$class = eden('string')->set($string)->pad(7, 'o');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->str_pad(7, 'o');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testPbrk() 
	{
		$string         = 'Hello';
		$resultString   = 'ello';
		$class = eden('string')->set($string)->pbrk('abcdefgh');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strpbrk('abcdefgh');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testPos() 
	{
		$string         = 'Hello';
		$result = eden('string')->set($string)->pos('e');
		$this->assertEquals(1, $result);
		
		$result = eden('string')->set($string)->strpos('e');
		$this->assertEquals(1, $result);
	}

	public function testPregReplace() 
	{
		$string         = 'Hello';
		$resultString   = 'Hillo';
		$class = eden('string')->set($string)->pregReplace('/e/', 'i');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->preg_replace('/e/', 'i');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testQuotedPrintableDecode() 
	{
		$string         = 'Hello';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->quotedPrintableDecode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->quoted_printable_decode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testQuotedPrintableEncode() 
	{
		$string         = 'Hello';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->quotedPrintableEncode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->quoted_printable_encode();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testQuotemeta() 
	{
		$string         = 'Hello';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->quotemeta();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->quotemeta();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testRepeat() 
	{
		$string         = 'Hello';
		$resultString   = 'HelloHelloHello';
		$class = eden('string')->set($string)->repeat(3);
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->str_repeat(3);
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testReplace() 
	{
		$string         = 'Hello';
		$resultString   = 'Hillo';
		$class = eden('string')->set($string)->replace('e', 'i');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->str_replace('e', 'i');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testRev() 
	{
		$string         = 'Hello';
		$resultString   = 'olleH';
		$class = eden('string')->set($string)->rev();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strrev();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testRot13() 
	{
		$string         = 'Hello';
		$resultString   = 'Uryyb';
		$class = eden('string')->set($string)->rot13();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->str_rot13();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testRtrim() 
	{
		$string         = 'Hello    ';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->rtrim();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->rtrim();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testSha1() 
	{
		$string         = 'Hello';
		$resultString   = 'f7ff9e8b7bb2e09b70935a5d785e0cc5d9d0abf0';
		$class = eden('string')->set($string)->sha1();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->sha1();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testShuffle() 
	{
		$string         = 'Hello';
		$class = eden('string')->set($string)->shuffle();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals(5, strlen($newString));
		
		$class = eden('string')->set($string)->str_shuffle();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals(5, strlen($newString));
	}

	public function testSprintf() 
	{
		$string         = 'Hello %s';
		$resultString   = 'Hello You';
		$class = eden('string')->set($string)->sprintf('You');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->sprintf('You');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testStr() 
	{
		$string         = 'Hello';
		$resultString   = 'ello';
		$class = eden('string')->set($string)->str('e');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strstr('e');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testSubstr() 
	{
		$string         = 'Hello';
		$resultString   = 'll';
		$class = eden('string')->set($string)->substr(2, 2);
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->substr(2, 2);
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testSubstrCompare() 
	{
		$string         = 'Hello';
		$result = eden('string')->set($string)->substrCompare('el', 3);
		$this->assertEquals(7, $result);
		
		$result = eden('string')->set($string)->substr_compare('el', 3);
		$this->assertEquals(7, $result);
	}

	public function testSubstrCount() 
	{
		$string         = 'Hello';
		$result = eden('string')->set($string)->substrCount('l');
		$this->assertEquals(2, $result);
		
		$result = eden('string')->set($string)->substr_count('l');
		$this->assertEquals(2, $result);
	}

	public function testSubstrReplace() 
	{
		$string         = 'Hello';
		$resultString   = 'Heyyo';
		$class = eden('string')->set($string)->substrReplace('yy', 2, 2);
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->substr_replace('yy', 2, 2);
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testTok() 
	{
		$string         = 'H<b>e</b>llo';
		$class = eden('string')->set($string)->tok('e');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals('H<b>', $newString);
		
		$class = eden('string')->set($string)->strtok('e');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals('H<b>', $newString);
	}

	public function testTolower() 
	{
		$string         = 'Hello';
		$resultString   = 'hello';
		$class = eden('string')->set($string)->tolower();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strtolower();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testToupper() 
	{
		$string         = 'Hello';
		$resultString   = 'HELLO';
		$class = eden('string')->set($string)->toupper();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strtoupper();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testTr() 
	{
		$string         = 'Hello';
		$resultString   = 'Hyllo';
		$class = eden('string')->set($string)->tr('e', 'y');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->strtr('e', 'y');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testTrim() 
	{
		$string         = '  Hello   ';
		$resultString   = 'Hello';
		$class = eden('string')->set($string)->trim();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->trim();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testUcfirst() 
	{
		$string         = 'heLLo';
		$resultString   = 'HeLLo';
		$class = eden('string')->set($string)->ucfirst();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->ucfirst();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testUcwords() 
	{
		$string         = 'hello you';
		$resultString   = 'Hello You';
		$class = eden('string')->set($string)->ucwords();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->ucwords();
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testVsprintf() 
	{
		$string         = 'Hello %s';
		$resultString   = 'Hello You';
		$class = eden('string')->set($string)->vsprintf(array('You'));
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->vsprintf(array('You'));
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}

	public function testWordwrap() 
	{
		$string         = 'Hello You';
		$resultString   = 'Hello<br />You';
		$class = eden('string')->set($string)->wordwrap(3, '<br />');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
		
		$class = eden('string')->set($string)->wordwrap(3, '<br />');
		$this->assertInstanceOf('Eden_String_Index', $class);
		$newString = $class->get();
		$this->assertEquals($resultString, $newString);
	}
}