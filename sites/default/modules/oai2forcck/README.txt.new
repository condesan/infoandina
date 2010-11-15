
 oai2ForCCK.module


Description:
============
This module provides an implementation the Open Archives Initiative Protocol for Metadata Harvesting (OAI-PMH)
for Drupal with support for CCK content types and their fields. By implementing the OAI2forCCK module,
you can expose content (its metadata) as an OAI-PMH repository. It will then be accessible by OAI harvesters.
For further OAI documentation, please see here: http://www.openarchives.org/OAI/openarchivesprotocol.html

Functionality:
=============
- Receive OAI-PMH request of service providers in form of HTTP request (GET or POST)
- Handle the OAI-PMH request
- Map Drupal nodes (created by CCK module) to OAI records (use the configuration at admin/settings/oai2forcck)
- Respond to OAI-PMH request in form of HTTP response (XML) to the service provider


Requirements:
=============
- Drupal 6.x
- CCK

Installation:
=============

   1. Copy the oai2ForCCK directory to your modules directory.
   2. Browse to admin/modules and enable the oai2ForCCK module, the module will report success or failure of the installation.
   3. Browse to admin/settings/oai2ForCCK to set the basic configuration of your repository
      - under configuration select the content types to expose and save
      - after saving, all exposed content types should have their fields available to be exposed
      - in the 'Mappings: Field -> DCMI Metadata Term' fieldset, enter dc terms (ie dc:title, dc:creator, etc) for
        each field you wish to expose. Blank fields will be ignored.
   4. After you have exposed content types and some fields, your repository is available at /oai2
   5. example requests are as follows:
      - /oai2?verb=Identify
      - /oai2?verb=ListMetadataFormats (only oai_dc currently supported)
      - /oai2?verb=ListIdentifiers&metadataPrefix=oai_dc
      - /oai2?verb=GetRecord&metadataPrefix=oai_dc&identifier=[nid]
      - /oai2?verb=ListRecords&metadataPrefix=oai_dc
      - verb=ListSets is not currently implemented
      
      
Upgrade Path from D5:
=====================
There is no current upgrade path from D5. However you shouldn't lose anything by uninstalling the D5 version
and installing the D6 version (provided you have upgraded to D6). You will just have to reconfigure and things
will work a bit differently (hopefully better).

Feedback:
=========
Please direct any feedback/questions/support requests/bugs etc. to the issue queue:
http://drupal.org/project/issues/oai2forcck

Other Projects:
====================
As an alternative, check out the OAI-PHM module (http://drupal.org/project/oai2). It works hand in hand with the
bibliography module to expose biblio content in an OAI-PHM repository.
