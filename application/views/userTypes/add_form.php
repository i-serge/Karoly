<?php
/*
 * Created on Nov 17, 2011
 *
 * @author Sergio Morales López
 */
 
echo form_open('/userTypes/insert/' . $userType->userType_id);
echo display_input('text', $userType, 'description', 'Descripcion');

echo form_submit('userTypeSubmit', 'Guardar');
echo form_close();