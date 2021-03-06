<div id="node-<?php print $node->nid ?>" class="node node-<?php print $node->type ?>">

<?php if (!$page): ?>
  <h2 class="teaser-title"><a href="<?php print $node_url ?>" title="<?php print $title ?>">
    <?php print $title ?></a></h2>
<?php endif; ?>

	

  <div class="content clear-block grid-12 alpha omega">
    <?php print $picture ?>
		
 	 <div id="content-left" class="grid-9 clear-block alpha">
	 <?php print $field_volada_rendered; ?>
	 <?php print "<h1 class=\"title\">" . $title . "</h1>"; ?>
	 <?php print infoandina_960_listar_apellidos_y_nombres($node->uid); ?>
	 <?php print $field_foto_rendered; ?>
	 <?php print (!empty($field_descripcion_rendered) ? $field_descripcion_rendered : $node->content['body']['#value']); ?>
	 <?php print $field_fuente_rendered; ?>
	 <?php print $field_lugar_rendered; ?>
	 <?php print infoandina960_listar_autores_en_linea($node->field_autores_relacionados , $node->field_autores); ?>
	 <?php print $field_archivo_rendered; ?>
	 </div>
	 <div id="content-right" class="grid-3 clear-block omega"><?php print infoandina960_show_view_block('similarterms-block_1'); ?></div>
	</div>

<?php if ($links): ?>
  <div class="node-links"><?php print $links ?></div>
<?php endif; ?>

</div>
