<?php
/*
Plugin Name: Advanced Custom Fields: Menus
Plugin URI: https://github.com/matgargano/Fluent-Forms-ACF-Field
Description: ACF field to select a Menu
Version: 0.0.1
Author: @matgargano of @statenweb
Author URI: http://www.statenweb.com
License: MIT
License URI: http://opensource.org/licenses/MIT
*/

// $version = 5 and can be ignored until ACF6 exists
function include_field_types_menus( $version ) {

  include_once('menus-v5.php');

}

add_action('acf/include_field_types', 'include_field_types_menus');


function register_fields_menus() {
  include_once('menus-v4.php');
}

add_action('acf/register_fields', 'register_fields_menus');


