<?php
/*
* flash array message
* params( array| json string| object)
* return object
*/
if(!method_exists($this, '_object')){
        function _object($array){
                if(is_array($array)) return (object) $array;
                if(is_object($array)) return $array;
                if(is_string($array)) return (object) json_decode($array);
        return $array; 
        }
}
/*
* flash array message
* params( array| json string| object)
* return array
*/
if(!method_exists($this, '_array')){
        function _array($array){
                if(is_object($array)) return (array) $array;
                if(is_array($array)) return $array;
                if(is_string($array)) return (array) json_decode($array);
                return $array; 
        }
}
/*
* extract value from array, object
* params( array|object, key)
* return value
*/
if(!method_exists($this, '_from')){
        function _from($object, $key){
                $array = _array($object);
                $value = (is_array($object) && array_key_exists($key, $object)) ? $object[$key] : "" ; 
                return $value; 
        }
}
/*
* flash array message
* params( array= ['error' => 'Error'])
* return void
*/
if(!method_exists($this, '_flash')){
        function _flash($object){
                $array = _array($object);
                foreach ($array as $key => $value) {
                        session()->flash( $key , $value);
                }
        }
}
/*
* flash array message
* params( array= ['error' => 'Error'])
* return void
*/
if(!method_exists($this, '_money')){
        function _money($number){
                return "MKW " . _number($number) . ".00";
        }
}
/*
* flash array message
* params( array= ['error' => 'Error'])
* return void
*/
if(!method_exists($this, '_number')){
        function _number($number){
                if(is_numeric($number)) return $number;
                if(is_string($number)) return $number;
                return 0;
        }
}