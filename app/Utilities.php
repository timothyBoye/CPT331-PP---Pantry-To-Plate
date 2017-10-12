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

    public static function stripBadFileCharacters($string)
    {
        $replacements = array(
            '\'' => '',
            '&' => '',
            ' ' => '-',
            'á' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ä' => 'a',
            'à' => 'a',
            'æ' => 'a',
            'å' => 'a',
            'ā' => 'a',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'è' => 'e',
            'ē' => 'e',
            'ė' => 'e',
            'ę' => 'e',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ì' => 'i',
            'ī' => 'i',
            'į' => 'i',
            'ó' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ö' => 'o',
            'ò' => 'o',
            'œ' => 'o',
            'ø' => 'o',
            'ō' => 'o',
            'ú' => 'u',
            'û' => 'u',
            'ù' => 'u',
            'ü' => 'u',
            'ū' => 'u',
            'ç' => 'c',
            'ć' => 'c',
            'č' => 'c',
            'ñ' => 'n',
            'ń' => 'n',
            'ÿ' => 'y',
            'ś' => 's',
            'š' => 's',
            'ß' => 's',
            'ł' => 'l',
            'ž' => 'z',
            'ź' => 'z',
            'ż' => 'z'
        );
        return strtr($string, $replacements);
    }
}