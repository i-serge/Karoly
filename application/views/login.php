<?php 
	echo form_open('login/buscar');
	echo display_input('text',$user,'email','E-mail');
	echo display_input_no_autocomplete('password',$user,'password','Contrasena');
	echo form_submit('logear','Entrar');
	echo form_close();
?>