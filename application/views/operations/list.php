<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
echo anchor('/operations/insert/', 'Nueva operacion');
?>
 <table>
	<tr>
		<th>ID</th>
		<th>Descripcion</th>
		<th>Controlador</th>
		<th>Controlador padre</th>
	</tr>
<?php
foreach($operations as $operation){
?>
	<tr>
		<td><?php echo $operation->operation_id ?></td>
		<td><?php echo $operation->description ?></td>
		<td><?php echo $operation->controller ?></td>
		<td><?php echo is_object($operation->parent_operation) ? $operation->parent_operation->description : 'NONE' ?></td>
		<td><?php echo anchor('/operations/insert/'.$operation->operation_id, 'Editar')?></td>
		<td><?php echo anchor('/operations/delete/'.$operation->operation_id, 'Eliminar')?></td>
	</tr>
<?php } ?>
</table>
<br />