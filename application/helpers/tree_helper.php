<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
function display_child_nodes($nodes){
	echo "\n<ul>\n";
	foreach ($nodes as $node){
		echo "<li>\n".$node->description;
		if (!isset($nodes[0])) display_child_nodes($node->child_folders);;
		echo "\n</li>\n";
	}
	echo "</ul>";
	return;
}