<?php

namespace App;

class Utilities
{
    public static function approximatedFractionString($float)
    {
        // Bad input
        if ($float < 0 || !is_numeric($float)) {
            return false;
        }

        $remainder = $float;
        $string = '';

        // Display whole numbers as whole numbers
        if (floor($float) > 0) {
            $string = $string . floor($float);
            $string = $string . ' ';
            $remainder -= floor($float);
        }
        // Display remainder (if any) as fraction
        if ($remainder > 0) {
            // Code from https://www.designedbyaturtle.co.uk/2015/converting-a-decimal-to-a-fraction-in-php/
            $tolerance = 1.e-2;

            $numerator = 1;
            $h2 = 0;
            $denominator = 0;
            $k2 = 1;
            $b = 1 / $remainder;
            do {
                $b = 1 / $b;
                $a = floor($b);
                $aux = $numerator;
                $numerator = $a * $numerator + $h2;
                $h2 = $aux;
                $aux = $denominator;
                $denominator = $a * $denominator + $k2;
                $k2 = $aux;
                $b = $b - $a;
            } while (abs($remainder - $numerator / $denominator) > $remainder * $tolerance);

            $string = $string . '<sup>' . $numerator . '</sup>' . '&frasl;' . '<sub>' . $denominator . '</sub>';
        }

        return $string;
    }
}