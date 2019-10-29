<?php

namespace BrilliantCode\Table\Helpers;

final class Arr
{
    public static function mapIntoElements(array $array, string $element)
    {
        return array_map(function ($value) use ($element){
            return el($element, $value);
        }, $array);
    }
}
