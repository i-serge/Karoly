<?php
/*
 * Created on Nov 17, 2011
 *
 * @author Sergio Morales López
 */
 
echo form_open('/users/insert/' . $user->user_id);
echo display_input('text', $user, 'name', 'Nombre');
echo display_input('text', $user, 'lastname', 'Apellido Paterno');
echo display_input('text', $user, 'slastname', 'Apellido Materno');
echo display_input('text', $user, 'email', 'E-mail');
echo display_input_no_autocomplete('password', $user, 'password', 'Password');
echo display_input_no_autocomplete('password', $user, 'confirm_password', 'Confirmar Password');
echo display_input('text', $user, 'telephone', 'Telefono');
echo form_select($user, 'userType_id', 'Tipo de usuario', $options);

echo form_submit('userSubmit', 'Guardar');
echo form_close();