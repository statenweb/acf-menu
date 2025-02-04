<?php
class acf_field_menus extends acf_field {
  
  
  /*
  *  __construct
  *
  *  This function will setup the field type data
  *
  *  @type  function
  *  @date  5/03/2014
  *  @since 5.0.0
  *
  *  @param n/a
  *  @return  n/a
  */
  
  function __construct() {
    // vars
    $this->name = 'menus_field';
    $this->label = __('Menus');
    $this->category = __("Content",'acf'); // Basic, Content, Choice, etc
    $this->defaults = array(
      'return_format' => 'form_object',
      'allow_multiple' => 0,
      'allow_null' => 0
    );
    // do not delete!
    parent::__construct();
  }
  
  
  /*
  *  render_field_settings()
  *
  *  Create extra settings for your field. These are visible when editing a field
  *
  *  @type  action
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $field (array) the $field being edited
  *  @return  n/a
  */
  
  function render_field_settings( $field ) {
    
    /*
    *  acf_render_field_setting
    *
    *  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
    *  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
    *
    *  More than one setting can be added by copy/paste the above code.
    *  Please note that you must also have a matching $defaults value for the field name (font_size)
    */
    
    acf_render_field_setting( $field, array(
      'label' => 'Allow Null?',
      'type'  =>  'radio',
      'name'  =>  'allow_null',
      'choices' =>  array(
        1 =>  __("Yes",'acf'),
        0 =>  __("No",'acf'),
      ),
      'layout'  =>  'horizontal'
    ));

    
  }
  
  /*
  *  render_field()
  *
  *  Create the HTML interface for your field
  *
  *  @param $field (array) the $field being rendered
  *
  *  @type  action
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $field (array) the $field being edited
  *  @return  n/a
  */
  
  function render_field( $field ) {
    
    
    /*
    *  Review the data of $field.
    *  This will show what data is available
    */
    
	// vars
	$field = array_merge($this->defaults, $field);
	$choices = array();
  $menus = wp_get_nav_menus();

  if ( ! empty( $menus ) ) {

    foreach ( $menus as $menu ) {
         $choices[ $menu->slug ] = $menu->name;
    }


    
	//Prevent undefined variable notice
    if(isset($forms)){
      foreach( $forms as $form ){
        $choices[ intval($form->id) ] = ucfirst($form->title);
      }
    }
    // override field settings and render
    $field['choices'] = $choices;
    $field['type']    = 'select';
    ?>
	<select id="<?php echo str_replace(array('[',']'), array('-',''), $field['name']);?>" name="<?php echo $field['name']; if( $field['allow_multiple'] ) echo "[]"; ?>"<?php echo $multiple; ?>>
        <?php
		if ( $field['allow_null'] ) 
			echo '<option value="">- Select -</option>';
			
		foreach ($field['choices'] as $key => $value){
			$selected = '';
			if ( (is_array($field['value']) && in_array($key, $field['value'])) || $field['value'] == $key )
				$selected = ' selected="selected"';
		?>
			<option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $value; ?></option>
		<?php } ?>
	</select>
    <?php
  }
}
  




}
// create field
new acf_field_menus();