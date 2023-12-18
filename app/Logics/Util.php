<?php
namespace App\Logics;

class Util {
    // 대상이 배열인지, 키에 해당하는 값이 있는지 확인
    // parameter : [], key
    public static function CanGetArrayValue($arr, $key) {
        if (is_array($arr) == false) {
            return false;
        }
        if (isset($arr[$key]) == false) {
            return false;
        }
        return true;
    }
}