<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">

<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>  
</head>

<body class="<?php print $body_classes; ?>">

<div id="wrapper"> <!--width independent from body-->


  <div id="header">
	
	<?php if ($header): ?>
      <?php print $header ?>
    <?php endif; ?>
	

    <?php if ($site_name): ?>
	  <h1 id="site-name">
	    <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home">
	      <?php print $site_name; ?> 
	    </a>
      </h1>
	<?php endif; ?> 
		
	<?php if ($site_slogan): ?>
	  <h2 id="slogan">
        <?php print $site_slogan; ?>
	  </h2>
	<?php endif; ?>
		
		 		 		
	<?php if ($search_box): ?>
      <?php print $search_box ?>
    <?php endif; ?>

          <div id="navigation">
            <?php if (isset($primary_links)) : ?>
              <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
            <?php endif; ?>
          </div>

  </div> <!-- end header -->
  

  <?php if ($banner): ?>
    <div id="banner">
      <?php print $banner ?>
    </div>
  <?php endif; ?>

  <?php if (isset($secondary_links)) : ?>
    <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')) ?>
  <?php endif; ?>

  <?php print $breadcrumb ?>


  <div id="main">

    <?php if ($left): ?>
      <div id="sidebar-left">
        <?php print $left ; ?>
      </div>
    <?php endif; ?>

    <?php if ($middle): ?>
      <div id="middlebar">
        <?php print $middle ; ?>
      </div>
    <?php endif; ?>


	  <div id="main-content">
		
		    <?php if ($content_top): ?>
              <div id="content-top">
                <?php print $content_top; ?>
              </div> <!-- /#content-top -->
            <?php endif; ?>
		
			<?php if ($title): ?>
              <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
		
		    <?php print $messages ?>
		
		    <?php if ($tabs): ?>
		   	<div class="tabs"><?php print $tabs; ?></div>
		    <?php endif; ?>
		
			<?php print $content; ?>
			
			<?php if ($content_bottom): ?>
              <div id="content-bottom">
                <?php print $content_bottom; ?>
              </div> <!-- /#content-bottom -->
            <?php endif; ?>

	  </div>		
	  


  </div> <!-- /#main -->
	
	<?php if ($footer_message): ?>
	    <div id="footer">
		    <?php print $footer_message ?><?php print $footer; ?>
	    </div>
	<?php endif; ?>
	
	

	<?php print $closure ?>
</div>

</body>
</html>