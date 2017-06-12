<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

class EdenCollectionIndexTest extends PHPUnit_Framework_TestCase
{
    public function testAdd() 
    {
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28));

        $this->assertInstanceOf('Eden\\Collection\\Index', $collection);
        $this->assertEquals('[{"name":"John","age":31},{"name":"Jane","age":28}]', (string) $collection);
    }

    public function testCount() 
    {
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28));

        $this->assertEquals(2, $collection->count());
    }

    public function testCut() 
    {
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28))
            ->add(array('name' => 'Jack', 'age' => 35))
            ->add(array('name' => 'Nick', 'age' => 24))
            ->add(array('name' => 'Fred', 'age' => 26))
            ->add(array('name' => 'Paul', 'age' => 33))
            ->cut('first')
            ->cut(1)
            ->cut('last');


        $this->assertEquals(3, $collection->count());
        $this->assertInstanceOf('Eden\\Collection\\Index', $collection);

        $this->assertEquals(
            '[{"name":"Jane","age":28},{"name":"Nick","age":24},{"name":"Fred","age":26}]',
            (string) $collection);
    }

    public function testEach() 
    {
        $self = $this;
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28))
            ->each(function($i, $row) use ($self) {
                $self->assertArrayHasKey('name', $row->get());
            });

    }

    public function testGet() 
    {
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28))
            ->get();

        $this->assertTrue(is_array($collection));
    }

    public function testSerialize() 
    {
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28))
            ->serialize();

        $this->assertEquals('[{"name":"John","age":31},{"name":"Jane","age":28}]', $collection);
    }

    public function testSet() 
    {
        $collection = eden('collection')
            ->set(array(
                array('name' => 'John', 'age' => 31),
                array('name' => 'Jane', 'age' => 28)));

        $this->assertInstanceOf('Eden\\Collection\\Index', $collection);
        $this->assertEquals('[{"name":"John","age":31},{"name":"Jane","age":28}]', (string) $collection);
    }

    public function testSetModel() 
    {
    }

    public function testUnserialize() 
    {
        $collection = eden('collection')
            ->unserialize('[{"name":"John","age":31},{"name":"Jane","age":28}]');

        $this->assertEquals(2, $collection->count());
    }

    public function testArrayAccess()
    {
        $collection = eden('collection');

        $collection[] = array('name' => 'John', 'age' => 31);
        $collection[] = array('name' => 'Jane', 'age' => 28);

        $this->assertFalse(isset($collection[2]));

        $this->assertEquals('Jane', $collection[1]->getName());
    }

    public function testIterable()
    {
        $collection = eden('collection')
            ->add(array('name' => 'John', 'age' => 31))
            ->add(array('name' => 'Jane', 'age' => 28))
            ->add(array('name' => 'Jack', 'age' => 35))
            ->add(array('name' => 'Nick', 'age' => 24))
            ->add(array('name' => 'Fred', 'age' => 26))
            ->add(array('name' => 'Paul', 'age' => 33));

        foreach($collection as $index => $model) {
            $this->assertEquals($collection[$index]->getName(), $model->getName());
        }
    }
}