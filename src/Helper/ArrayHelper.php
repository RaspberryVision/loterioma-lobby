<?php declare(strict_types = 1);

namespace App\Helper;

use function is_array;

/**
 * Array helper
 */
class ArrayHelper
{
    /**
     * Remote empties from array
     * Where "empties" are null empty array elements
     * @param array $array
     * @return array
     */
    public static function removeEmpties(array $array): array
    {
        foreach ($array as $index => $value) {
            if ($value === null || is_array($value) && empty($value)) {
                unset($array[$index]);
            }
        }

        return $array;
    }
}
