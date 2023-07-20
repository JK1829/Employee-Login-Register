<?php
/**
 * The generic functionality methods of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Emp_Login
 * @subpackage Wp_Emp_Login/public

 */
class Wp_Emp_Login_Generic_Public
{
    
    public function __construct(){
        
    }
    
    public static function generic_placeholder_replacer($source,$placeholders){
        return strtr($source, $placeholders);
    }
}
