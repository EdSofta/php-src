--TEST--
SPL: ArrayObject with bad iterator class.
--FILE--
<?php
try {
  $ao = new ArrayObject(array('a'=>1,'b'=>2,'c'=>3));
  $ao->setIteratorClass("nonExistentClass");
  foreach($ao as $key=>$value) {
    echo "  $key=>$value\n";
  }
} catch (TypeError $e) {
    var_dump($e->getMessage());
}

try {
  $ao = new ArrayObject(array('a'=>1,'b'=>2,'c'=>3));
  $ao->setIteratorClass("stdClass");
  foreach($ao as $key=>$value) {
    echo "  $key=>$value\n";
  }
} catch (TypeError $e) {
    var_dump($e->getMessage());
}


try {
  $ao = new ArrayObject(array('a'=>1,'b'=>2,'c'=>3), 0, "nonExistentClass");
  foreach($ao as $key=>$value) {
    echo "  $key=>$value\n";
  }
} catch (TypeError $e) {
    var_dump($e->getMessage());
}

try {
  $ao = new ArrayObject(array('a'=>1,'b'=>2,'c'=>3), 0, "stdClass");
  foreach($ao as $key=>$value) {
    echo "  $key=>$value\n";
  }
} catch (TypeError $e) {
    var_dump($e->getMessage());
}

?>
--EXPECT--
string(128) "ArrayObject::setIteratorClass(): Argument #1 ($iteratorClass) must be a class name derived from Iterator, nonExistentClass given"
string(120) "ArrayObject::setIteratorClass(): Argument #1 ($iteratorClass) must be a class name derived from Iterator, stdClass given"
string(124) "ArrayObject::__construct(): Argument #3 ($iterator_class) must be a class name derived from Iterator, nonExistentClass given"
string(116) "ArrayObject::__construct(): Argument #3 ($iterator_class) must be a class name derived from Iterator, stdClass given"
