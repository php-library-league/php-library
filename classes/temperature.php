<?php
/**
* Working with temperature conversions
*/
class Temperature{
    public static $absolute_zero = 273.15;
    
    // -------------------------------------------------------------------------
    
    /**
    * Kelvin to Celsius conversion
    *
    * @param int $temp
    */
    public static function k_to_c($temp)
    {
        if(!is_numeric($temp))
        {
            return false;
        }
    return round(($temp - self::$absolute_zero)). '&deg;';
    }
    
    // -------------------------------------------------------------------------
    
    /**
    * Kelvin to Farenheit conversion
    *
    * @param int $temp
    */
    public static function k_to_f($temp)
    {
        if(!is_numeric($temp))
        {
            return false;
        }
    return round((($temp - self::$absolute_zero) * 1.8) + 32);
    }
    
    // -------------------------------------------------------------------------
}
?>