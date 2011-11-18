<?php
/*
 * Created on Nov 17, 2011
 *
 * @author Sergio Morales López
 */
 echo anchor('/users/insert/', 'Nuevo usuario');
?>
 <table>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Apellido paterno</th>
		<th>Apellido materno</th>
		<th>E-mail</th>
		<th>Password</th>
		<th>Telefono</th>
		<th>Tipo de usuario</th>
	</tr>
<?php
foreach($users as $user){
?>
	<tr>
		<td><?php echo $user->user_id ?></td>
		<td><?php echo $user->name ?></td>
		<td><?php echo $user->lastname ?></td>
		<td><?php echo $user->slastname ?></td>
		<td><?php echo $user->email ?></td>
		<td><?php echo $user->password ?></td>
		<td><?php echo $user->telephone ?></td>
		<td><?php echo $user->userType->description ?></td>
		<td><?php echo anchor('/users/insert/'.$user->user_id, 'Editar')?></td>
		<td><?php echo anchor('/users/delete/'.$user->user_id, 'Eliminar')?></td>
	</tr>
<?php } ?>
</table>
<br />