<?php
// $Id: page.tpl.php,v 1.1.2.1 2009/02/24 15:34:45 dvessel Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $body_classes; ?>">
  <div id="page" class="container-16 clear-block">
		<div id="menu-top" class="grid-16 clear-block">
				<div class="grid-5 suffix-3 top-menu-left"><?php print strtoupper(infoandina960_get_date()); ?></div>
				<div class="grid-8 alpha omega top-menu-right">
				  <div class="grid-3 prefix-2 alpha omega"><?php if ($icons) { print $icons;} ?></div>
					<div class="grid-3 alpha omega"><?php if ($search_box) { print $search_box;} ?></div>
					
					</div>
		</div>
    <div id="site-header" class="grid-16 clear-block" style="height:<?php print ( $is_front ? '70px' : '90px' ); ?>;">
      <div id="branding" class="grid-4 alpha">
      <?php if ($linked_logo_img): ?>
        <span id="logo" class="grid-1 alpha"><?php print $linked_logo_img; ?></span>
      <?php endif; ?>
      </div>

    <?php if ($main_menu_links || $secondary_menu_links): ?>
      <div id="site-menu" class="grid-9 prefix-3 omega">
        <?php print $main_menu_links; ?>
        <?php #print $secondary_menu_links; ?>
      </div>
    <?php endif; ?>


    </div>


    <div id="site-subheader" class="prefix-1 suffix-1 clear-block">
    <?php if ($mission): ?>
      <div id="mission" class="<?php print ns('grid-14', $header, 7); ?>">
        <?php print $mission; ?>
      </div>
    <?php endif; ?>

    <?php if ($header): ?>
      <div id="header-region" class="region <?php print ns('grid-14', $mission, 7); ?> clear-block">
        <?php print $header; ?>
      </div>
    <?php endif; ?>
    </div>
    
		<!--solo se muestra en el home-->
		<!--inicio del if-->
		
		<?php if ($is_front) { ?>
		<div id="slideshow" class="grid-16 clear-block"><?php print infoandina960_show_view_block('noticias-block_1');?></div>
		<div id="messages" class="grid-16"><?php print $messages; ?></div>
		<div id="column-left" class="grid-6">
				<?php print infoandina960_show_view_block('noticias-block_2');?>
		</div>
		<div id="column-right" class="grid-10">
		<div id="column-right-top"></div>
			<div id="column-right-top-subcolumn-right" class="grid-6 alpha">
				<?php print infoandina960_show_view_block('recursos-block_1');?>
			</div>
			<div id="column-right-top-subcolumn-left" class="grid-4 omega">
					<?php print infoandina960_show_view_block('noticias-block_3');?>	
					<?php print infoandina960_show_view_block('eventos-calendar_block_1');?>	
			</div>
		</div>

		<?php } else { ?> <!--inicio del else -->
	  <div id="menu-principal" class="grid-16"><?php  print theme('links', menu_navigation_links('menu-menu-principal'), array('class' => 'links menu-principal')); ?> </div>
    <div id="main" class="column <?php print ns('grid-16', $left, 4, $right, 4) . ' ' . ns('push-4', !$left, 4); ?>">
				<div id="fulltext">
					
					<?php if($title): ?>
						<h2 class="supertitle"> <?php print $title; ?></h2>
					<?php endif; ?>
					<div id="fulltext-body">
							<?php if ($tabs): ?>
								<div class="tabs"><?php print $tabs; ?></div>
							<?php endif; ?>
							<?php print $messages; ?>
							<?php print $help; ?>
				
							<div id="main-content" class="region clear-block">
								<?php print $content; ?>
							</div>
				
							<?php print $feed_icons; ?>
					
					</div><!--fin de fulltext-body-->
					
			</div>	<!--fin de fulltext-->
    </div>

  <?php if ($left): ?>
    <div id="sidebar-left" class="column sidebar region grid-4 <?php print ns('pull-12', $right, 4); ?>">
      <?php print $left; ?>
    </div>
  <?php endif; ?>

  <?php if ($right): ?>
    <div id="sidebar-right" class="column sidebar region grid-4">
      <?php print $right; ?>
    </div>
  <?php endif; ?>

	<?php } ?> <!--fin del else -->

  <div id="footer" class="grid-16 clear-block">
    <?php if ($footer): ?>
      <div id="footer-region" class="region grid-14 clear-block">
        <?php print $footer; ?>
      </div>
    <?php endif; ?>

    <?php if ($footer_message): ?>
      <div id="footer-message" class="grid-12 prefix-4 alpha omega">
        <?php print $footer_message; ?>
      </div>
    <?php endif; ?>
  </div>


  </div>
  <?php print $closure; ?>
</body>
</html>
