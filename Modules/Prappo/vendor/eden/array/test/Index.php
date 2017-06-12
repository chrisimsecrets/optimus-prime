<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

class Eden_Array_Test_Index extends PHPUnit_Framework_TestCase
{	
    public function testCopy() 
	{
        $data   = array('first' => 'bar', 'second' => 'foo');
        $class  = eden('array')->set($data)->copy('first', 'third');
		
        $this->assertInstanceOf('Eden_Array_Index', $class);
        $this->assertArrayHasKey('third', $class->get());
    }

    public function testCount() 
	{
        $data   = array('bar', 'foo');
        $num    = eden('array')->set($data)->count();
        $this->assertCount($num, $data);
    }

    public function testCut() 
	{
        $data   = array('bar', 'foo');
        $class  = eden('array')->set($data)->cut(1);
        $this->assertInstanceOf('Eden_Array_Index', $class);
        $this->assertNotContains('foo', $class->get());
    }

    public function testEach() 
	{
        $data   = array('bar', 'foo');
        $test   = $this;
        $class  = eden('array')->set($data)->each(
            function ($key, $value) use ($test, $data)
            {
                $test->assertEquals($data[$key], $value);
            }
        );
		
        $this->assertInstanceOf('Eden_Array_Index', $class);
    }

    public function testIsEmpty() 
	{
        $data   = array();
        $result = eden('array')->set($data)->isEmpty();
        $this->assertTrue($result);
    }

    public function testPaste() 
	{
        $data   = array('bar', 'foo');
        $class  = eden('array')->set($data);
        $this->assertInstanceOf('Eden_Array_Index', $class->paste(0, 'box', 'boo'));
        $this->assertArrayHasKey('boo',$class->get());
    }

    public function testSerialize() 
	{
        $data   = array('foo', 'bar');
        $class  = eden('array')->set($data);
        $this->assertJsonStringEqualsJsonString(json_encode($class->get()), $class->serialize());
    }

    public function testSet() 
	{
        $data       = array('foo', 'bar');
        $somedata   = array('box', 'boo');
        $class      = eden('array')->set($data);
        $this->assertInstanceOf('Eden_Array_Index', $class->set($somedata));
		
		$this->assertEquals(2, eden('array')->set(1, 2, 3)->cut(1)->count());
    }

    public function testUnSerialize() 
	{
        $somedata       = array('a' => 'foo', 'b' => 'bar');
        $serialized     = '{"a":"foo","b":"bar"}';
        $class          = eden('array')->set($somedata)->unserialize($serialized);
        $this->assertInstanceOf('Eden_Array_Index', $class);
        $this->assertJsonStringEqualsJsonString(json_encode($somedata), (string) $class);
    }

    public function testArrayAccess() 
	{
        $data = eden('array')->set(array('name' => 'John', 'age' => 31));

        $this->assertFalse(isset($data[2]));
        $this->assertEquals(31, $data['age']);
    }

    public function testIterable() 
	{
        $data   = array('foo', 'bar');
        $class  = eden('array')->set($data);

        foreach($class as $key => $value) {
            $this->assertEquals($class->current(), $value);
        }
    }
	
	public function test_array_change_key_case()
	{
		$test = eden('array')
			->set(array('a' => 1))
			->array_change_key_case(CASE_UPPER)
			->get();
		
		$this->assertEquals(1, $test['A']);
		
		$test = eden('array')
			->set(array('a' => 1))
			->changeKeyCase(CASE_UPPER)
			->get();
		
		$this->assertEquals(1, $test['A']);
	}
	
	public function test_array_chunk()
	{
		$test = eden('array')
			->set(1, 2, 3, 4)
			->array_chunk(2)
			->get();
		
		$this->assertEquals(1, $test[0][0]);
		$this->assertEquals(2, $test[0][1]);
		$this->assertEquals(3, $test[1][0]);
		$this->assertEquals(4, $test[1][1]);
		
		$test = eden('array')
			->set(1, 2, 3, 4)
			->chunk(2)
			->get();
		
		$this->assertEquals(1, $test[0][0]);
		$this->assertEquals(2, $test[0][1]);
		$this->assertEquals(3, $test[1][0]);
		$this->assertEquals(4, $test[1][1]);
	}
	
	public function test_array_combine()
	{
		$test = eden('array')
			->set('a', 'b', 'c')
			->array_combine(array(4, 5, 6))
			->get();
		
		$this->assertEquals(4, $test['a']);
		$this->assertEquals(5, $test['b']);
		$this->assertEquals(6, $test['c']);
		
		$test = eden('array')
			->set('a', 'b', 'c')
			->combine(array(4, 5, 6))
			->get();
		
		$this->assertEquals(4, $test['a']);
		$this->assertEquals(5, $test['b']);
		$this->assertEquals(6, $test['c']);
	}
	
	public function test_array_diff_assoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2, 'c' => 1, 'd' => 2))
			->array_diff_assoc(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(1, $test['c']);
		$this->assertEquals(2, $test['d']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2, 'c' => 1, 'd' => 2))
			->diffAssoc(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(1, $test['c']);
		$this->assertEquals(2, $test['d']);
	}
	
	public function test_array_diff_key()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_diff_key(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->diffKey(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
	}
	
	public function test_array_diff_uassoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2, 'c' => 1, 'd' => 2))
			->array_diff_uassoc(array('c' => 3, 'b' => 2), function($value1, $value2) {
				return $value1;
			})
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(1, $test['c']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2, 'c' => 1, 'd' => 2))
			->diffUassoc(array('c' => 3, 'b' => 2), function($value1, $value2) {
				return $value1;
			})
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(1, $test['c']);
	}
	
	public function test_array_diff_ukey()
	{
		$test = eden('array')
			->set(array(4, 5, 6))
			->array_diff_ukey(array(7, 8, 9), function($value1, $value2) {
				return $value2;
			})
			->get();
		
		$this->assertTrue(empty($test));
		
		$test = eden('array')
			->set(array(4, 5, 6))
			->diffUkey(array(7, 8, 9), function($value1, $value2) {
				return $value2;
			})
			->get();
		
		$this->assertTrue(empty($test));
	}
	
	public function test_array_diff()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2, 'c' => 1, 'd' => 2))
			->array_diff(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(1, $test['c']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2, 'c' => 1, 'd' => 2))
			->diff(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(1, $test['c']);
	}
	
	public function test_array_fill_keys()
	{
		$test = eden('array')
			->set('a', 'b', 'c')
			->array_fill_keys(4)
			->get();
		
		$this->assertEquals(4, $test['a']);
		$this->assertEquals(4, $test['b']);
		$this->assertEquals(4, $test['c']);
		
		$test = eden('array')
			->set('a', 'b', 'c')
			->fillKeys(4)
			->get();
		
		$this->assertEquals(4, $test['a']);
		$this->assertEquals(4, $test['b']);
		$this->assertEquals(4, $test['c']);
	}
	
	public function test_array_filter()
	{
		$test = eden('array')
			->set('a', 'b', 'c')
			->array_filter(function($value) {
				return $value === 'b';
			})
			->get();
		
		$this->assertEquals('b', $test[1]);
		
		$test = eden('array')
			->set('a', 'b', 'c')
			->filter(function($value) {
				return $value === 'b';
			})
			->get();
		
		$this->assertEquals('b', $test[1]);
	}
	
	public function test_array_flip()
	{
		$test = eden('array')
			->set('a', 'b', 'c')
			->array_flip()
			->get();
		
		$this->assertEquals(0, $test['a']);
		$this->assertEquals(1, $test['b']);
		$this->assertEquals(2, $test['c']);
		
		$test = eden('array')
			->set('a', 'b', 'c')
			->flip()
			->get();
		
		$this->assertEquals(0, $test['a']);
		$this->assertEquals(1, $test['b']);
		$this->assertEquals(2, $test['c']);
	}
	
	public function test_array_intersect_assoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_intersect_assoc(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->intersectAssoc(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_intersect_key()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_intersect_key(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->intersectKey(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_intersect_uassoc()
	{
		$test = eden('array')
			->set(array('a' => 'red', 'b' => 'green', 'c' => 'blue'))
			->array_intersect_uassoc(
				array('d' => 'red', 'b' => 'green', 'e' => 'blue'), 
				function($value1, $value2) {
					if ($value1 === $value2) {
						return 0;
					}
					
					return ($value1 > $value2) ? 1: -1;
				})
			->get();
		
		$this->assertEquals('green', $test['b']);
		
		$test = eden('array')
			->set(array('a' => 'red', 'b' => 'green', 'c' => 'blue'))
			->intersectUassoc(
				array('d' => 'red', 'b' => 'green', 'e' => 'blue'), 
				function($value1, $value2) {
					if ($value1 === $value2) {
						return 0;
					}
					
					return ($value1 > $value2) ? 1: -1;
				})
			->get();
		
		$this->assertEquals('green', $test['b']);
	}
	
	public function test_array_intersect_ukey()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_intersect_ukey(array('c' => 3, 'b' => 2), function($value1, $value2) {
				return $value1;
			})
			->get();
		
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->intersectUkey(array('c' => 3, 'b' => 2), function($value1, $value2) {
				return $value1;
			})
			->get();
		
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_intersect()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_intersect(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->intersect(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_keys()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_keys()
			->get();
		
		$this->assertEquals('a', $test[0]);
		$this->assertEquals('b', $test[1]);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->keys()
			->get();
		
		$this->assertEquals('a', $test[0]);
		$this->assertEquals('b', $test[1]);
	}
	
	public function test_array_merge_recursive()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_merge_recursive(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b'][0]);
		$this->assertEquals(2, $test['b'][1]);
		$this->assertEquals(3, $test['c']);
		
		$test = eden('array')
			->array_merge_recursive(array('a' => 1, 'b' => 2), array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b'][0]);
		$this->assertEquals(2, $test['b'][1]);
		$this->assertEquals(3, $test['c']);
		
		$test = eden('array')
			->mergeRecursive(array('a' => 1, 'b' => 2), array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b'][0]);
		$this->assertEquals(2, $test['b'][1]);
		$this->assertEquals(3, $test['c']);
	}
	
	public function test_array_merge()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_merge(array('c' => 3, 'b' => 2))
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		$this->assertEquals(3, $test['c']);
		
		$test = eden('array')
			->array_merge(array('a' => 1, 'b' => 2), array('c' => 3, 'b' => 2))
			->get();
			
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		$this->assertEquals(3, $test['c']);
		
		$test = eden('array')
			->merge(array('a' => 1, 'b' => 2), array('c' => 3, 'b' => 2))
			->get();
			
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		$this->assertEquals(3, $test['c']);
	}
	
	public function test_array_pad()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_pad(4, 'foo')
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		$this->assertEquals('foo', $test[0]);
		$this->assertEquals('foo', $test[1]);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->pad(4, 'foo')
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		$this->assertEquals('foo', $test[0]);
		$this->assertEquals('foo', $test[1]);
	}
	
	public function test_array_reverse()
	{
		$test = eden('array')
			->set(1, 2, 3, 4)
			->array_reverse()
			->get();
		
		$this->assertEquals(4, $test[0]);
		$this->assertEquals(3, $test[1]);
		$this->assertEquals(2, $test[2]);
		$this->assertEquals(1, $test[3]);
		
		$test = eden('array')
			->set(1, 2, 3, 4)
			->reverse()
			->get();
		
		$this->assertEquals(4, $test[0]);
		$this->assertEquals(3, $test[1]);
		$this->assertEquals(2, $test[2]);
		$this->assertEquals(1, $test[3]);
	}
	
	public function test_array_slice()
	{
		$test = eden('array')
			->set(1, 2, 3, 4)
			->array_slice(1, 2)
			->get();
		
		$this->assertEquals(2, $test[0]);
		$this->assertEquals(3, $test[1]);
		
		$test = eden('array')
			->set(1, 2, 3, 4)
			->slice(1, 2)
			->get();
		
		$this->assertEquals(2, $test[0]);
		$this->assertEquals(3, $test[1]);
	}
	
	public function test_array_sum()
	{
		$test = eden('array')
			->set(1, 2, 3, 4)
			->array_sum();
		
		$this->assertEquals(10, $test);
		
		$test = eden('array')
			->set(1, 2, 3, 4)
			->sum();
		
		$this->assertEquals(10, $test);
	}
	
	public function test_array_udiff_assoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_udiff_assoc(array('c' => 3, 'b' => 2), function($value1, $value2) {
				return $value1;
			})
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->udiffAssoc(array('c' => 3, 'b' => 2), function($value1, $value2) {
				return $value1;
			})
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_udiff_uassoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_udiff_uassoc(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}, 
				function($value1, $value2) {
					return $value2;
				}
			)
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->udiffUassoc(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}, 
				function($value1, $value2) {
					return $value2;
				}
			)
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_udiff()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_udiff(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->udiff(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertEquals(1, $test['a']);
		$this->assertEquals(2, $test['b']);
	}
	
	public function test_array_uintersect_assoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_uintersect_assoc(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertTrue(empty($test));
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->uintersectAssoc(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertTrue(empty($test));
	}
	
	public function test_array_uintersect_uassoc()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_uintersect_uassoc(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}, 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertTrue(empty($test));
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->uintersectUassoc(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}, 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertTrue(empty($test));
	}
	
	public function test_array_uintersect()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_uintersect(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertTrue(empty($test));
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->uintersect(
				array('c' => 3, 'b' => 2), 
				function($value1, $value2) {
					return $value1;
				}
			)
			->get();
		
		$this->assertTrue(empty($test));
	}
	
	public function test_array_unique()
	{
		$test = eden('array')
			->set(1, 2, 1)
			->array_unique()
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(2, count($test));
		
		$test = eden('array')
			->set(1, 2, 1)
			->unique()
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(2, count($test));
	}
	
	public function test_array_values()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_values()
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->values()
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
	}
	
	public function test_count()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->count();
		
		$this->assertEquals(2, $test);
	}
	
	public function test_sizeof()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->sizeof();
		
		$this->assertEquals(2, $test);
	}
	
	public function test_array_fill()
	{
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->array_fill(3, 4)
			->get();
		
		$this->assertEquals(1, $test[3]['a']);
		$this->assertEquals(2, $test[3]['b']);
		
		$this->assertEquals(1, $test[4]['a']);
		$this->assertEquals(2, $test[4]['b']);
		
		$this->assertEquals(1, $test[5]['a']);
		$this->assertEquals(2, $test[5]['b']);
		
		$this->assertEquals(1, $test[6]['a']);
		$this->assertEquals(2, $test[6]['b']);
		
		$test = eden('array')
			->set(array('a' => 1, 'b' => 2))
			->fill(3, 4)
			->get();
		
		$this->assertEquals(1, $test[3]['a']);
		$this->assertEquals(2, $test[3]['b']);
		
		$this->assertEquals(1, $test[4]['a']);
		$this->assertEquals(2, $test[4]['b']);
		
		$this->assertEquals(1, $test[5]['a']);
		$this->assertEquals(2, $test[5]['b']);
		
		$this->assertEquals(1, $test[6]['a']);
		$this->assertEquals(2, $test[6]['b']);
	}
	
	public function test_array_map()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_map(function($value) {
				return $value + 1;
			})
			->get();
		
		$this->assertEquals(2, $test[0]);
		$this->assertEquals(3, $test[1]);
		$this->assertEquals(4, $test[2]);
		
		$test = eden('array')
			->set(1, 2, 3)
			->map(function($value) {
				return $value + 1;
			})
			->get();
		
		$this->assertEquals(2, $test[0]);
		$this->assertEquals(3, $test[1]);
		$this->assertEquals(4, $test[2]);
	}
	
	public function test_array_search()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_search(3);
		
		$this->assertEquals(2, $test);
		
		$test = eden('array')
			->set(1, 2, 3)
			->search(3);
		
		$this->assertEquals(2, $test);
	}
	
	public function test_array_implode()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->implode(', ');
		
		$this->assertEquals('1, 2, 3', (string) $test);
	}
	
	public function test_in_array()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->in_array(2);
		
		$this->assertTrue($test);
		
		$test = eden('array')
			->set(1, 2, 3)
			->inArray(4);
		
		$this->assertFalse($test);
	}
	
	public function test_array_shift()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_shift();
		
		$this->assertEquals(1, $test);
		
		$test = eden('array')
			->set(1, 2, 3)
			->shift();
		
		$this->assertEquals(1, $test);
	}
	
	public function test_array_unshift()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_unshift(0)
			->get();
		
		$this->assertEquals(0, $test[0]);
		$this->assertEquals(1, $test[1]);
		$this->assertEquals(2, $test[2]);
		$this->assertEquals(3, $test[3]);
		
		$test = eden('array')
			->set(1, 2, 3)
			->unshift(0)
			->get();
		
		$this->assertEquals(0, $test[0]);
		$this->assertEquals(1, $test[1]);
		$this->assertEquals(2, $test[2]);
		$this->assertEquals(3, $test[3]);
	}
	
	public function test_array_pop()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_pop();
		
		$this->assertEquals(3, $test);
		
		$test = eden('array')
			->set(1, 2, 3)
			->pop();
		
		$this->assertEquals(3, $test);
	}
	
	public function test_array_push()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_push(0)
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(3, $test[2]);
		$this->assertEquals(0, $test[3]);
		
		$test = eden('array')
			->set(1, 2, 3)
			->push(0)
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(3, $test[2]);
		$this->assertEquals(0, $test[3]);
	}
	
	public function test_array_splice()
	{
		$test = eden('array')
			->set(1, 2, 3)
			->array_splice(1, 1)
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(3, $test[1]);
		
		$test = eden('array')
			->set(1, 2, 3)
			->splice(1, 1)
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(3, $test[1]);
	}
	
	public function test_array_walk_recursive()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->array_walk_recursive(function($value1, $value2) {
				return $value1 > $value2;
			})
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(0, $test[2]);
		
		
		$test = eden('array')
			->set(1, 2, 0)
			->walkRecursive(function($value1, $value2) {
				return $value1 > $value2;
			})
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(0, $test[2]);
	}
	
	public function test_array_walk()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->array_walk(function($value1, $value2) {
				return $value1 > $value2;
			})
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(0, $test[2]);
		
		$test = eden('array')
			->set(1, 2, 0)
			->walk(function($value1, $value2) {
				return $value1 > $value2;
			})
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(0, $test[2]);
	}
	
	public function test_arsort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->arsort()
			->get();
		
		$this->assertEquals(0, $test[2]);
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
	}
	
	public function test_asort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->asort()
			->get();
		
		$this->assertEquals(0, $test[2]);
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
	}
	
	public function test_krsort()
	{
		$test = eden('array')
			->set(array('c' => 1, 'a' => 2, 'b' => 3))
			->krsort()
			->get();
		
		$this->assertEquals(2, $test['a']);
		$this->assertEquals(3, $test['b']);
		$this->assertEquals(1, $test['c']);
	}
	
	public function test_ksort()
	{
		$test = eden('array')
			->set(array('c' => 1, 'a' => 2, 'b' => 3))
			->ksort()
			->get();
		
		$this->assertEquals(2, $test['a']);
		$this->assertEquals(3, $test['b']);
		$this->assertEquals(1, $test['c']);
	}
	
	public function test_natcasesort()
	{
		$test = eden('array')
			->set(array('c' => 1, 'a' => 2, 'b' => 3))
			->natcasesort()
			->get();
		
		$this->assertEquals(2, $test['a']);
		$this->assertEquals(3, $test['b']);
		$this->assertEquals(1, $test['c']);
	}
	
	public function test_natsort()
	{
		$test = eden('array')
			->set(array('c' => 1, 'a' => 2, 'b' => 3))
			->natsort()
			->get();
		
		$this->assertEquals(2, $test['a']);
		$this->assertEquals(3, $test['b']);
		$this->assertEquals(1, $test['c']);
	}
	
	public function test_rsort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->rsort()
			->get();
		
		$this->assertEquals(2, $test[0]);
		$this->assertEquals(1, $test[1]);
		$this->assertEquals(0, $test[2]);
	}
	
	public function test_sort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->sort()
			->get();
		
		$this->assertEquals(0, $test[0]);
		$this->assertEquals(1, $test[1]);
		$this->assertEquals(2, $test[2]);
	}
	
	public function test_shuffle()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->shuffle()
			->get();
		
		$this->assertEquals(3, count($test));
	}
	
	public function test_uasort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->uasort(function($value1, $value2) {
				return $value1;
				
			})
			->get();
		
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(0, $test[2]);
	}
	
	public function test_uksort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->uksort(function($value1, $value2) {
				return $value1;
				
			})
			->get();
			
		$this->assertEquals(1, $test[0]);
		$this->assertEquals(2, $test[1]);
		$this->assertEquals(0, $test[2]);
	}
	
	public function test_usort()
	{
		$test = eden('array')
			->set(1, 2, 0)
			->usort(function($value1, $value2) {
				if ($value1 === $value2) {
					return 0;
				}
				
				return ($value1 > $value2) ? 1: -1;
			})
			->get();
			
		$this->assertEquals(0, $test[0]);
		$this->assertEquals(1, $test[1]);
		$this->assertEquals(2, $test[2]);
	}
}