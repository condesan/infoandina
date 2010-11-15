<?php


function infoandina960_preprocess_page(&$vars, $hook) {
	#dsm($vars);
	$icons = array(
	l(theme('image', path_to_theme() . '/images/' . 'icon_facebook.png'), 'http://facebook.com', array('html' => TRUE)),
	l(theme('image', path_to_theme() . '/images/' . 'icon_rss.jpg'), 'http://infoandina.org/rss.xml', array('html' => TRUE)),	
	l(theme('image', path_to_theme() . '/images/' . 'icon_twitter.gif'), 'http://twitter.com', array('html' => TRUE)),	
	l(theme('image', path_to_theme() . '/images/' . 'icon_youtube.jpg'), 'http://youtube.com', array('html' => TRUE)),	
	);
	
	$vars['icons'] = theme('item_list', $icons, $title = NULL, $type = 'ul', array('class' => 'icons container-inline'));
	
	if($vars['template_files'][0] == 'page-node') {
		$vars['node_type'] = $vars['node']->type;
		}
	
	}


function infoandina960_preprocess_search_theme_form(&$vars, $hook) {
	#dsm($vars['form']['search_theme_form']);
  // Remove the "Search this site" label from the form.
  $vars['form']['search_theme_form']['#title'] = t('');
	$vars['form']['search_theme_form']['#size'] = '14';
  
  // Set a default value for text inside the search box field.
  $vars['form']['search_theme_form']['#value'] = t('Buscar');
  
  // Add a custom class and placeholder text to the search box.
  $vars['form']['search_theme_form']['#attributes'] = array('class' => 'NormalTextBox txtSearch', 
                                                              'onfocus' => "if (this.value == 'Buscar') {this.value = '';}",
                                                              'onblur' => "if (this.value == '') {this.value = 'Buscar';}");
  
  // Change the text on the submit button
  //$vars['form']['submit']['#value'] = t('Go');

  // Rebuild the rendered version (search form only, rest remains unchanged)
  unset($vars['form']['search_theme_form']['#printed']);
  $vars['search']['search_theme_form'] = drupal_render($vars['form']['search_theme_form']);
  $vars['form']['submit']['#prefix'] = '<div class="form-item container-inline">';
	$vars['form']['submit']['#suffix'] = '</div>';
  $vars['form']['submit']['#type'] = 'image_button';
	$vars['form']['submit']['#attributes'] = array('class' => 'send-button');
  $vars['form']['submit']['#src'] = path_to_theme() . '/images/search.png';
    
  // Rebuild the rendered version (submit button, rest remains unchanged)
  unset($vars['form']['submit']['#printed']);
  $vars['search']['submit'] = drupal_render($vars['form']['submit']);

  // Collect all form elements to make it easier to print the whole form.
  $vars['search_form'] = implode($vars['search']);
}

function infoandina960_show_view_block($delta) {
	$block = module_invoke('views', 'block', 'view', $delta);
	$output .= ( $block['subject'] ? "<h2>" . $block['subject'] . "</h2>" : '' );
	$output .= $block['content'];
	return "<div id=\"views-". $delta ."\" class=\"block\">" . $output . "</div>";
	}

