<?php
if (! function_exists('tounicode'))
{
    function tounicode($value)
    {
        return \Kyawnaingtun\Tounicode\Services\Converter::convert($value);
    }
}
if (! function_exists('checkFontType'))
{
    function checkFontType($value)
    {
        return \Kyawnaingtun\Tounicode\Services\Converter::checkFontType($value);
    }
}