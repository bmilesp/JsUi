# JsUi Plugin for CakePHP #

The JsUi plugin comes default with jQuery and the jQueryUI library. It is designed so that other libraries can be added on.

## Installation ##

Add jsui folder to your plugins folder.

## How to use it ##

Add: var $helpers = array('JsUi'); to your controller. (default is var $helpers = array('JsUi'=>array('jQuery')); see JsUi helper for more details.

This is a rough draft, but it works out of the box with endless options, and the ability easily add options.

Works out of the box:

datePickerInput -> easily drop in a JsUi datePicker widget
draft list selector element -> (for large HABTM lists, uses jQueryUI autoComplete).
buttonSet -> incomplete (see JsUi for more details).

jQuery themes can be added in the plugin webroot css/js folders.


## How to extend the plugin ##

This plugin is designed to be extended to use other javascript UI libraries and can be implimented into the helper. 

TODO: extract jQuery library specific methods to another file/object


