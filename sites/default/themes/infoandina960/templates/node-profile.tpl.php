<div id="node-<?php print $node->nid ?>" class="node node-<?php print $node->type ?>">

<?php if (!$page): ?>
  <h2 class="teaser-title"><a href="<?php print $node_url ?>" title="<?php print $title ?>">
    <?php print $title ?></a></h2>
<?php endif; ?>

	

  <div class="content clear-block grid-12 alpha omega">
    <?php print $picture ?>
		
 	 <div id="content-left" class="grid-7 clear-block alpha">
	 <?php print $field_foto_rendered; ?>
	 <?php print "<div class=\"field\"><div class=\"field-label\">" . $node->title . "</div></div>"; ?>
	 <?php print $node->content['body']['#value']; ?>
	 <?php print $field_institucion_pertenece_rendered; ?>
	 <?php print $field_cargo_rendered; ?>
	 <?php print infoandina960_listar_recursos_relacionados($node->nid, 'Recursos relacionados'); ?>
	 <?php print $field_archivo_rendered; ?>
	 </div>
	 <div id="content-right" class="grid-5 clear-block omega"><?php print infoandina960_show_view_block('similarterms-block_1'); ?></div>
	</div>

<?php if ($links): ?>
  <div class="node-links"><?php print $links ?></div>
<?php endif; ?>

</div>
