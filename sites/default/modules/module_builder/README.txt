$Id: README.txt,v 1.7.2.2 2009/10/25 16:25:30 joachim Exp $

Welcome to module_builder.module! 
This is a module designed to help expedite the process of creating custom 
modules. Simply fill out the form, select the hooks you want and the 
script will automatically generate a skeleton module file for you, 
along with PHPDoc comments and function definitions.

FEATURES
--------
* Automatically parses available hook names from CVS at your command...
  so help keep those files updated, won't you? ;)
* Comes with some sample standard hook function declarations to get 
  you started and a default module header; but if you don't like those,
  simply rename the .template files to -custom.template instead and 
  create your own definitions!
* Saves you the trouble of looking at drupaldocs.org 50 times a day to 
  remember what arguments and what order different hooks use. Score one
  for laziness! ;)
* Automatically selects hooks based on your needs.
* Option allows you to turn off informative comments.

INSTALL/CONFIG ON DRUPAL
--------------
1. Move this folder into your modules/ directory like you would any 
   other module.
2. Enable it from administer >> modules.
3. Go to administer >> settings >> module_builder and specify the path
   to save the hook documentation files
4. The first time you visit the module builder form, the module will 
   retrieve hook documentation from cvs.drupal.org and store it locally. 
   When you want to update this documentation later on, return to the 
   settings page and click the "Update" button.
5. (Optional) Create custom function declaration template file(s) if you
   don't like the default output.
6. (Optional) Create your own hook groupings if you don't like the 
   default ones.

INSTALL/CONFIG ON DRUSH
----------------
1. Move this folder to somewhere where Drush can find the command. Inside drush/commands will do it, though then you have to watch you don't clobber it on upgrade. Drush documentation has details on other, better options.
2. From a Drupal installation, do:
$ drush mbdl
This will download hook data to that Drupal's files/hooks folder. Hooks are downloaded for core and any other module builder-aware modules that are in this install of Drupal.
3. You can now generate module code. For more help, do:
$ drush help mb

If you use Drush with multiple Drupal installations, you can store your hook data centrally, and so only download it once for all your sites.
To do so, specify the --data option when both downloading hooks and generating code. You can use Drush's drushrc.php to set this option automatically.

USING THE MODULE
----------------
1. Click the "module_builder" link in the menu (note: you will require
   'access module builder' privileges to see this link)
2. Enter a module name, description, and so on.
3. Select from one of the available hook groupings to automatically 
   select hook choices for you, or expand the fieldsets and choose
   hooks individually.
4. Click the "Submit" button and watch your module's code generated
   before your eyes! ;)
5. Copy and paste the code into a files called <your_module>.module,
   <your_module>.info and <your_module>.install and save them to
   a <your_module> directory under one of the modules directories.
6. Start customizing it to your needs; most of the tedious work is 
   already done for you! ;)

TODO/WISHLIST
-------------
* Maybe some nicer theming/swooshy boxes on hook descriptions or 
  something to make the form look nicer/less cluttered
* I would like to add the option to import help text from a Drupal.org
  handbook page, to help encourage authors to write standardized 
  documentation in http://www.drupal.org/handbook/modules/

KNOWN ISSUES
------------
* Can't set default values in PHP 5 for some strange reason
* Fieldsets in Opera look mondo bizarr-o

API
-------------
This module can be considered to be an API and two wrappers: 
- Drupal's web-based UI (referred to in code comments as Drupal UI or just Drupal)
- Drush's command line
Furthermore, while the Drupal part of the module is version-specific (that is, you download the version of the module to match your version of Drupal core as you would any module), the Drush part, works across versions in the same way as Drush itself.
That is, you can download the current version of module builder, install it as a Drush command, and where you can use Drush you can use module builder. (Note this is still a work in progress...)


CONTRIBUTORS
------------
* Owen Barton (grugnog2), Chad Phillips (hunmonk), and Chris Johnson 
  (chrisxj) for initial brainstorming stuff @ OSCMS in Vancouver
* Jeff Robbins for the nice mockup to work from and some great suggestions
* Karthik/Zen/|gatsby| for helping debug some hairy Forms API issues
* Steven Wittens and David Carrington for their nice JS checkbox magic
* jsloan for the excellent "automatically generate module file" feature
* Folks who have submitted bug reports and given encouragement, thank you
  so much! :)
