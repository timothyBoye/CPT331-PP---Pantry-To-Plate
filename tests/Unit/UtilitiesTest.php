<?php

namespace Tests\Unit;

use Tests\BaseTestCase;
use App\Utilities;

class UtilitiesTest extends BaseTestCase
{

    /**
     * Tests the float to string function outputs the correct strings representations.
     */
    public function testApproximatedFractionString()
    {
        // not a number
        $this->assertFalse(Utilities::approximatedFractionString("abc"));
        $this->assertFalse(Utilities::approximatedFractionString('/'));
        $this->assertFalse(Utilities::approximatedFractionString(true));
        $this->assertFalse(Utilities::approximatedFractionString("1a"));
        $this->assertFalse(Utilities::approximatedFractionString(array(1)));

        // 1/10
        $this->assertTrue(Utilities::approximatedFractionString(0.1) == '<sup>1</sup>&frasl;<sub>10</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.10) == '<sup>1</sup>&frasl;<sub>10</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.2) == '<sup>1</sup>&frasl;<sub>5</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.3) == '<sup>3</sup>&frasl;<sub>10</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.4) == '<sup>2</sup>&frasl;<sub>5</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.5) == '<sup>1</sup>&frasl;<sub>2</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.6) == '<sup>3</sup>&frasl;<sub>5</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.7) == '<sup>7</sup>&frasl;<sub>10</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.8) == '<sup>4</sup>&frasl;<sub>5</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.9) == '<sup>9</sup>&frasl;<sub>10</sub>');
        // 1/4
        $this->assertTrue(Utilities::approximatedFractionString(0.25) == '<sup>1</sup>&frasl;<sub>4</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.50) == '<sup>1</sup>&frasl;<sub>2</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.75) == '<sup>3</sup>&frasl;<sub>4</sub>');
        // 1/3
        $this->assertTrue(Utilities::approximatedFractionString(0.333) == '<sup>1</sup>&frasl;<sub>3</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.666) == '<sup>2</sup>&frasl;<sub>3</sub>');
        // 1/8
        $this->assertTrue(Utilities::approximatedFractionString(0.125) == '<sup>1</sup>&frasl;<sub>8</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.250) == '<sup>1</sup>&frasl;<sub>4</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.375) == '<sup>3</sup>&frasl;<sub>8</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.500) == '<sup>1</sup>&frasl;<sub>2</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.625) == '<sup>5</sup>&frasl;<sub>8</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.750) == '<sup>3</sup>&frasl;<sub>4</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(0.875) == '<sup>7</sup>&frasl;<sub>8</sub>');

        // whole number + fraction
        $this->assertTrue(Utilities::approximatedFractionString(1.5) == '1 <sup>1</sup>&frasl;<sub>2</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(12.125) == '12 <sup>1</sup>&frasl;<sub>8</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(5.250) == '5 <sup>1</sup>&frasl;<sub>4</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(3.666) == '3 <sup>2</sup>&frasl;<sub>3</sub>');
        $this->assertTrue(Utilities::approximatedFractionString(1.875) == '1 <sup>7</sup>&frasl;<sub>8</sub>');
    }

    /**
     * Tests the strip characters function is correctly outputting strings that will be usable as file names with no issues
     */
    public function testStripBadFileCharacters()
    {
        $this->assertEquals("hello-world.jpg", Utilities::stripBadFileCharacters("hello-world.jpg"));
        $this->assertEquals("hello-world.jpg", Utilities::stripBadFileCharacters("hèłłœ wörłd&'.jpg"));
        $this->assertEquals("-aaaaaaaa-eeeeeee-iiiiii-oooooooo-uuuuu-ccc-nn-y-sss-l-zzz", Utilities::stripBadFileCharacters("&'-æáãâäàåā éêëèēėę íîïìīį óõôöòœøō úûüùū çćč ñń ÿ ßśš ł žźż"));
    }

}
