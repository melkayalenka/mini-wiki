<?php
/**
 * Created by PhpStorm.
 * User: Резеда
 * Date: 14.07.2019
 * Time: 20:20
 */
namespace app\commons;
class Common
{
    public static function convertText($text) {

        $patternBold = '/\*{2}(\pL+)\*{2}/';
        $patternItalic = "/\\\\(\pL+)\\\\/";
        $patternHttp = "/[\(]{2}[a-zA-Z0-9_-]+[\[][a-zA-Z0-9_-]+[\]][\)]{2}/";

        $out = preg_replace_callback($patternItalic,  array(get_class(null), 'makeItalicText'), $text);
        $out = preg_replace_callback($patternBold,  array(get_class(null), 'makeBoldText'), $out);
        $out = preg_replace_callback($patternHttp,  array(get_class(null), 'makeHttp'), $out);

        return $out;
    }

    private static function makeBoldText($matches = array()) {
        $matches[0] = preg_replace('/\**(\pL+)\**/', '<b>$1</b>', $matches[0]);
        return $matches[0];
    }
    private static function makeItalicText($matches = array()) {
        $matches[0] = preg_replace('/\\\\(\pL+)\\\\/', '<i>$1</i>', $matches[0]);
        return $matches[0];
    }
    private static function makeHttp($matches = array()) {

        $matches[0] = ltrim($matches[0],"((");
        $matches[0] = rtrim($matches[0],"))");

        $r = explode('[', $matches[0]);
        $name = $r[0];
        $str = rtrim($r[1], "]");
        $matches[0] = "<a href=\"site/$name\">$str</a>";

        return $matches[0];
    }

}