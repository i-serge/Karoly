<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
echo form_open('/operations/insert/' . $operation->operation_id);
echo display_input('text', $operation, 'description', 'Descripcion');
echo display_input('text', $operation, 'controller', 'Controlador');
echo form_select($operation, 'parent_operation_id', 'Operacion padre', $options);

echo form_submit('operationSubmit', 'Guardar');
echo form_close();