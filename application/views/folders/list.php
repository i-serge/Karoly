<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
echo anchor('/folders/insert/', 'Nuevo folder');
?>
 <table>
	<tr>
		<th>ID</th>
		<th>Descripcion</th>
		<th>Folder padre</th>
	</tr>
<?php
foreach($folders as $folder){
?>
	<tr>
		<td><?php echo $folder->folder_id ?></td>
		<td><?php echo $folder->description ?></td>
		<td><?php echo is_object($folder->folder_padre) ? $folder->folder_padre->description : 'NONE' ?></td>
		<td><?php echo anchor('/folders/insert/'.$folder->folder_id, 'Editar')?></td>
		<td><?php echo anchor('/folders/delete/'.$folder->folder_id, 'Eliminar')?></td>
	</tr>
<?php } ?>
</table>
<br />