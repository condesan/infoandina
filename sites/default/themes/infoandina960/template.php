<?php


function infoandina960_preprocess_page(&$vars, $hook) {
	#dsm($vars);
	$icons = array(
	l(theme('image', path_to_theme() . '/images/' . 'icon_facebook.png'), 'http://www.facebook.com/infoandina', array('html' => TRUE, 'attributes' => array('target' => '_blank'))),
	l(theme('image', path_to_theme() . '/images/' . 'icon_rss.jpg'), 'http://infoandina.org/rss.xml', array('html' => TRUE, 'attributes' => array('target' => '_blank'))),	
	l(theme('image', path_to_theme() . '/images/' . 'icon_twitter.gif'), 'http://twitter.com/infoandina', array('html' => TRUE,  'attributes' => array('target' => '_blank'))),	
	l(theme('image', path_to_theme() . '/images/' . 'icon_youtube.jpg'), 'http://www.youtube.com/infoandina', array('html' => TRUE,  'attributes' => array('target' => '_blank'))),	
	);
	
	$vars['icons'] = theme('item_list', $icons, $title = NULL, $type = 'ul', array('class' => 'icons container-inline'));
	
	if(($vars['template_files'][0] == 'page-node') && ($vars['node']->type !== 'page')) {
		$vars['title'] = $vars['node']->type;
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

function infoandina960_get_date(){
	$days  = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$months = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre");
	return $days[date('w')] . " " . date('j') . " de " . $months[date('n')] . " del " . date('Y');
	}


function infoandina_960_listar_apellidos_y_nombres($uid) {
	
	$sql = "SELECT {content_type_profile}.field_nombres_value, {content_type_profile}.field_apellidos_value FROM {content_type_profile} INNER JOIN {node} ON {content_type_profile}.nid = {node}.nid WHERE {node}.uid = '%d'";
	
	$query = db_query($sql, $uid);
	
	while($data = db_fetch_array($query)) {
		
		$output = $data['field_nombres_value'].' '.$data['field_apellidos_value'];
		
		}
	
		return $output;
	
	}

function infoandina960_listar_autores_en_linea($autores_registrados = array(), $autores_no_registrados = array()) {
	
	if (!is_array($autores_registrados)) { $autores_registrados = array(); }
	if (!is_array($autores_no_registrados)) { $autores_no_registrados = array(); }	
	$autores = array_merge($autores_registrados, $autores_no_registrados);
	foreach($autores as $autor) {
				if (is_array($autor['safe']) && !empty($autor['safe'])) {
				$lista_autores[$autor['safe']['title']] = l(trim($autor['safe']['title']),'node/'.$autor['nid']);
				}
				elseif (!is_array($autor['safe']) && !empty($autor['value'])) {
					$lista_autores[$autor['value']] = trim($autor['safe']);			
				}
		}
	if(!empty($lista_autores)) {	
	ksort($lista_autores);
	$lista = implode('; ', $lista_autores);
	$output = "<div class=\"field\"><div class=\"field-label\">Autores: </div><div id=\"autores\">".$lista."</div></div>";
	}
	else {
	$output = '';
}
	return $output;
	
}	

function infoandina960_listar_recursos_relacionados($nid, $title) {
	
		$sql = "SELECT nid FROM {content_field_autor} WHERE field_autor_nid = '%d'";
		 $result = db_query(db_rewrite_sql($sql), $nid);
		 while ($data = db_fetch_object($result)) {
		 $noderel = node_load($data->nid);
		 $list[]=l($noderel->title,'node/'.$noderel->nid);
         }
		if (!empty($list)) { $output = "<div class=\"field\"><div class=\"field-label\">" . $title . "</div>" . theme('item_list', $list) . "</div>";}		 
		else { $output = '';}
		return $output;
	}
	
	function _limpiar_arreglo($arreglo) {
	foreach($arreglo as $k => $v) {
		if(!empty($v)) {
			$lst[] = $v;
			}
		}
	return $lst;
	}
