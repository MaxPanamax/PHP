<?php
    define("BR","</br>");
     class MyClass{
        public $a=23;
        public function __construct(){
            $a=56;
            var_dump($a);
        }
        public function _print(){
            echo $this->a." ".BR;
        }
    }
    $myClass1=new MyClass();
    $myClass1->_print();
    $myClass=new MyClass();
    $myClass->a= 0;
?>