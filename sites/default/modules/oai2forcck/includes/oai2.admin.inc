<?php
// $Id: oai2.admin.inc,v 1.1.2.1 2009/02/03 01:57:36 kingmoore Exp $

/**
 * @file
 * oai2.admin.inc
 *
 */


/**
 * Menu callback. Admin setting page for oaiForCCK.
 */
function oai2forcck_settings() {
  
  $base_url = $GLOBALS['base_url'];  
  
  //------------ Group 1: Global Configuration
  $form['oai2_configuration'] = array(
    '#type' => 'fieldset',
    '#title' => t('Configuration'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  $form['oai2_configuration']['oai2_repository_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Repository Name'),
    '#size' => '50',
    '#default_value' =>  variable_get('oai2_repository_name', 'Repository')
  );
  $form['oai2_configuration']['oai2_base_url'] = array(
  '#type' => 'textfield',
  '#title' => t('Base URL of the Repository'),
  '#size' => '50',
  '#default_value' => variable_get('oai2_base_url', $base_url .'/oai2')
  );
  $form['oai2_configuration']['oai2_admin_email'] = array(
    '#type' => 'textfield',
    '#title' => t('Admin Email'),
    '#size' => '50',
    '#default_value' => variable_get('oai2_admin_email', 'admin@example.com')
  );
  $form['oai2_configuration']['oai2_max_size'] = array(
    '#type' => 'textfield',
    '#title' => t('Maximum Response Size'),
    '#size' => '50',
    '#default_value' => variable_get('oai2_max_size', '20'),
    '#description' => 'The maximum number of records to issue per response. If result set is larger than this number,
                      a resumption token will be issued',
  );
  $form['oai2_configuration']['oai2_expire_time'] = array(
    '#type' => 'textfield',
    '#title' => t('Expiration Time'),
    '#size' => '50',
    '#default_value' => variable_get('oai2_expire_time', '86400'),
    '#description' => 'The amount of time a resumption token will remain valid in seconds. Defaults to one day (86400s).',
  );
  
  
  //build content type options
  $content_type_options = array();
  $node_types = node_get_types();
  foreach ($node_types as $node_type) {
    $content_type_options[$node_type->type] = $node_type->name;
  }
  $form['oai2_configuration']['oai2_content_types'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Content Types to Expose'),
    '#options' => $content_type_options,      
    '#default_value' => variable_get('oai2_content_types', array()),
    '#description' => 'Select content types to expose with OAI2.',
  );
  
  
  //build set options - for now this is default + a list of vocabularies
  $set_options = array('default' => 'default');
  $result = db_query("SELECT vid,name FROM {vocabulary}");
  while ($row = db_fetch_object($result)) {
    $set_options[$row->vid] = $row->name;
  }  
  $form['oai2_configuration']['oai2_set'] = array(
    '#type' => 'select',
    '#title' => t('Vocabulary to define Sets'),
    '#options' => $set_options,
    '#default_value' => variable_get('oai2_set', ''),
    '#description' => 'Sets will be defined as groups of nodes tagged with each term of this vocabulary.
                       Default will group sets by content type.'
  );
  
  
  //---------- Group: Metadata Format Configuration
  $form['oai2_metadata'] = array(
    '#type' => 'fieldset',
    '#title' => t('Metadata Format'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  
  $metadata_format_options = array();
  $result = db_query('SELECT * FROM {oai2_metadata_formats} ORDER BY name');
  while ($row = db_fetch_object($result)) {
    $metadata_format_options[$row->name] = strtoupper($row->name);
  }
  $metadata_format = variable_get('oai2_metadata_format', 'oai_dc');
  $form['oai2_metadata']['oai2_metadata_format'] = array(
    '#type' => 'select',
    '#title' => t('Metadata Format'),
    '#options' => $metadata_format_options,
    '#default_value' =>  $metadata_format,
  );
  

  $result = db_query("SELECT * FROM {oai2_metadata_formats} where name='%s' ", $metadata_format);
  while ($row = db_fetch_array($result)) {
    $metadata_prefix = $row['metadata_prefix'];
    $metadata_namespace = $row['metadata_namespace'];
    $schema_location = $row['schema'];
  }  
  $form['oai2_metadata']['oai2_metadata_prefix'] = array(
    '#type' => 'item',
    '#title' => t('Metadata Prefix'),
    '#value' =>  $metadata_prefix,
    '#description' => t('Default for selected metadata format.')
  );
  $form['oai2_metadata']['oai2_metadata_namespace'] = array(
    '#type' => 'item',
    '#title' => t('Metadata Namespace'),
    '#value' => $metadata_namespace,
    '#description' => t('Default for selected metadata format.')
  );
  $form['oai2_metadata']['oai2_schema_location'] = array(
    '#type' => 'item',
    '#title' => t('Schema Location'),
    '#value' => $schema_location,
    '#description' => t('Default for selected metadata format.')
  );
  
  
  /** for each content type selected
   *   - list all fields with a form field for DCMI Metadata Term
   */
  
  //---------- Group: Field Mappings
  $form['oai2_field_mapping'] = array(
    '#type' => 'fieldset',
    '#title' => t('Mappings: Field -> DCMI Metadata Term'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description' => t("This is where content type fields are mapped to DCMI Metadata terms. Blank fields will not appear
                         in the OAI-PMH response. If you see no fields here, you must expose some content types above.
                         Field values should be in the form of 'dc:title'<br/><br/>
                         
                        Notes:&nbsp;&nbsp;List of properties in the legacy /elements/1.1/ namespace of Dublin Core:contributor, coverage, creator,
                        date, description, format, identifiers, language, publisher, relation, rights, source, subject, title.<br/><br/>
                        For more information please visit:http://www.dublincore.org/documents/dcmi-terms/<br/><br/>
    "), 
  );
  
  //here we are going to output form fields for every field of each content type we are exposing
  //first get all available content types
  $content_types = variable_get('oai2_content_types', array()); 
  foreach ($content_types as $type => $selected) {
    
    //if we have exposed a content type
    if ($selected) {
      
      //get details about that content type and it's fields
      $content_type = content_types($type);
      $fields = $content_type['fields'];
          
      //put a bit of markup header to separate the content types visually - should maybe be themeable
      $form['oai2_field_mapping']['oai2_type_'. $type]['oai2_markup_'. $type] = array(
        '#value' => "<br/><br/><h3>$type</h3><hr/>",
      );

      //add the body field to the fields array because fields array only contains cck fields
      if (!empty($content_type['extra']['body_field']['label'])) {
        $body_field = array();
        $body_field['field_name'] = 'body';
        $body_field['widget']['label'] = $content_type['extra']['body_field']['label'];
        array_unshift($fields, $body_field);          
      }
      
      //add the title field to the fields array because fields array only contains cck fields      
      if (!empty($content_type['extra']['title']['label'])) {
        $title_field['field_name'] = 'title';
        $title_field['widget']['label'] = $content_type['extra']['title']['label'];
        array_unshift($fields, $title_field);
      }  
      
      //for each field, create a form field with a key like oai2_map:content_type:field_name
      foreach ($fields as $field) {

        $field_name = $field['field_name'];
               
        $form['oai2_field_mapping']['oai2_map:'. $type .':'. $field_name] = array(
          '#type' => 'textfield',
          '#title' => $field['widget']['label'],
          '#size' => '20',
          '#default_value' => variable_get('oai2_map:'. $type .':'. $field_name, ''),          
        );        
      }
    }
    
  }
  
  return system_settings_form($form);
}
