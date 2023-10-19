<?php

namespace src\utilities;

class ConversorArray
{
    public function converterArrayEmString(array $array): string
    {
        return implode(", ", $array);
    }

    public function converterStringEmArray(string $string): array
    {
        return explode(", ", $string);
    }
}