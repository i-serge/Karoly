<?php

if (!function_exists('form_select'))
{

    /**
     * Display a complete dropdown with the doctrine object validation and post and 
     * @param object $doctrine_object
     * @param string $attribute_name
     * @param string $label
     * @param array $options
     * @return string 
     */
    function form_select(&$doctrine_object, $attribute_name, $label, $options=array()) {
        return
                form_input_label($label) .
                selected_dropdown($doctrine_object, $attribute_name, $options) .
                display_form_error_for($attribute_name);
    }

}

if (!function_exists('form_input_label'))
{

    /**
     *
     * @param type $label
     * @return type 
     */
    function form_input_label($label) {
        return '<div class="form_input_label">' . $label . '</div>';
    }

}

if (!function_exists('display_input'))
{

    /**
     *
     * @param string $type type of input (text, password)
     * @param object $object Doctrine object, could be a new one, or an existing one in case of editing
     * @param string $name input attribute name
     * @param string $label Text to display as label of the input
     * @param string $class css class to use in this input
     * @return type 
     */
    function display_input($type, &$object, $name, $label, $class='') {
        if ($type == 'password')
        {
            $input_value = '';
        } else
        {
            $input_value = set_input_value($object, $name);
        }
        $errors = display_form_error_for($name);
        $function_to_call = 'input_'.$type;
        return $function_to_call($input_value, $name, $label, $errors, $class='');
    }

}

function input_text($input_value, $name, $label, $errors, $class=''){
    return form_input_label($label) . '
        <input type="text" name="' . $name . '" value="' . $input_value . '" class="' . $class . '" /> ' . $errors;
}

function input_hidden($input_value, $name, $label, $errors, $class=''){
    return form_input_label($label) . '
        <input type="hidden" name="' . $name . '" value="' . $input_value . '" class="' . $class . '" /> ' . $errors;
}

function input_password($input_value, $name, $label, $errors, $class='') {
    return form_input_label($label) . '
        <input type="password" name="' . $name . '" value="" class="' . $class . '" /> ' . $errors;
}

if (!function_exists('display_input_no_autocomplete'))
{

    /**
     *
     * @param type $type
     * @param type $object
     * @param type $name
     * @param type $label
     * @return type 
     */
    function display_input_no_autocomplete($type, &$object, $name, $label) {
        $errors = display_form_error_for($name);
        return form_input_label($label) . '
        <input type="' . $type . '" name="' . $name . '"  /> ' . $errors . '<br />';
    }

}


if (!function_exists('set_input_value'))
{

    /**
     * Verifies in the post array first if the index exist, if not, then checks if the object has it and prints it
     * @param object $object doctrine object 
     * @param string $attribute_name attribute name
     * @return string html code
     */
    function set_input_value(&$object, $attribute_name) {
        if (isset($_POST[$attribute_name]))
        {
            return $_POST[$attribute_name];
        } else if (isset($object))
        {
            return $object->$attribute_name;
        }
    }

}

if (!function_exists('selected_dropdown'))
{

    /**
     *
     * @param type $doctrine_object
     * @param type $attribute_name
     * @param array $options associative array ('value'=>'label') for the options in the select
     * @return string html dropdown code
     */
    function selected_dropdown(&$doctrine_object, $attribute_name, $options=array()) {
        $selected_option = "";
        if (isset($_POST[$attribute_name]))
        {
            $selected_option = $_POST[$attribute_name];
        } else if (isset($doctrine_object))
        {
            $selected_option = $doctrine_object->$attribute_name;
        }

        $result = '<select name="' . $attribute_name . '">';
        $result.='<option value="">Selecciona una opcion</option>';
        foreach ($options as $value => $label) {
            if ($value == $selected_option)
            {
                $result.='<option value="' . $value . '" selected>' . $label . '</option>';
            } else
            {
                $result.='<option value="' . $value . '">' . $label . '</option>';
            }
        }
        $result.='</select>';
        return $result;
    }

}

if (!function_exists('display_form_error_for'))
{

    /**
     * Prints a div with the error for this input if it has an error
     * @param string $field index in the post array to verify if has a form_validation error
     */
    function display_form_error_for($field) {
        return form_error($field, '<div class="input_error">', '</div>');
    }

}

/* End of file MY_form_helper.php */ 
/* Location: ./application/helpers/MY_form_helper.php */ 