<?php
if (! function_exists('tounicode'))
{
    function tounicode($value)
    {
        return \Kyawnaingtun\Tounicode\Services\Converter::convert($value);
    }
}