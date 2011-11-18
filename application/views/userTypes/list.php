<?php
/*
 * Created on Nov 17, 2011
 *
 * @author Sergio Morales López
 */
 echo anchor('/userTypes/insert/', 'Nuevo tipo de usuario');
?>
 <table>
	<tr>
		<th>ID</th>
		<th>Descripcion</th>
	</tr>
<?php
foreach($userTypes as $userType){
?>
	<tr>
		<td><?php echo $userType->userType_id ?></td>
		<td><?php echo $userType->description ?></td>
		<td><?php echo anchor('/userTypes/insert/'.$userType->userType_id, 'Editar')?></td>
		<td><?php echo anchor('/userTypes/delete/'.$userType->userType_id, 'Eliminar')?></td>
	</tr>
<?php } ?>
</table>
<br />