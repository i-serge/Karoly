<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
echo form_open('/folders/insert/' . $folder->folder_id);
echo display_input('text', $folder, 'description', 'Descripcion');
echo form_select($folder, 'folder_padre_id', 'Folder padre', $options);

echo form_submit('folderSubmit', 'Guardar');
echo form_close();