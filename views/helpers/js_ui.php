<?php 


class JsUiHelper extends AppHelper {
	
	/**
 * Helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array('Html','Form','Javascript');
	
	/** options for jquery noConflict (not necessary in 1.3)
	 * 
	 * @var array
	 */
    public $options = array(); 
    
    /**
     * 
     * @var string - js library definer
     */
    private $j = '$';
/**
 * Constructor (for 1.3) not for 1.2??
 *
 */
	function __construct($options = array()) {
		$defaultOptions = array('noConflict'=>false);
		$this->options = array_merge($defaultOptions, $options);
		$this->j = ($this->options['noConflict'] == true)? "jQuery" : "$";
		return parent::__construct();
	}
	
	
	function beforeRender(){
		/* if 1.3, check for js library then add here
		$this->Javascript->link('/js_ui/js/jquery-1.4.2.min.js',false); 
		$jsCode = "jQuery.noConflict()";
		$this->Javascript->codeBlock($jsCode, array('inline'=>false));
		*/
		$this->Javascript->link('/js_ui/js/jquery-ui-1.8.5.custom.min.js',false);
		$this->Javascript->link('/js_ui/js/ui-custom-methods.js',false);//for datepicker holidays and weekeds functions
		$this->Html->css('/js_ui/css/custom-theme/jquery-ui-1.8.5.custom',null,array('inline'=>false));
		
	}
	
	public function datePickerInput($elementName = '', $options = array()){
		$defaultOptions = array('bindingClass'=>'datepicker',
								'noConflict'=>'false',
								'dateFormat'=>'yy-mm-dd',
								'excludedDates'=>null,
								'excludeWeekends'=>false);
		$options = array_merge($defaultOptions, $options);
		$j= $this->j;

		$jsOption = array();
		$jsCode = array();
		if($options['excludedDates']){
			$jsCode[] = "excludedDates = ".json_encode($options['excludedDates']);
			if($options['excludeWeekends']){
				$jsOption[] = "beforeShowDay: excludeWeekendsAndDates";
			}else{
				$jsOption[] = "beforeShowDay: excludeDates";
			}
		}else if($options['excludeWeekends']){
			$jsOption[] = "beforeShowDay: $j.datepicker.noWeekends";
		}
		
		$jsOption[] = "dateFormat: '{$options['dateFormat']}'";
		$jsCode[] = "$j(document).ready(function(){
					$j( '.{$options['bindingClass']}' ).datepicker({".implode(", ",$jsOption)."});
				  })";
		$js = $this->Javascript->codeBlock(implode("\n",$jsCode));
		return $js. $this->Form->input($elementName,array('type'=>'text','class'=>$options['bindingClass']));
	}
	
	public function buttonSet($elementName = '',$options = array()){
	
		$defaultOptions = array('bindingReference'=>'buttonSet',
								'data' => array(),
								'label' => null,
								'enabled' =>true);
		$options = array_merge($defaultOptions, $options);
		$j= $this->j;
		
		$jsOption = array();
		$jsCode = array();
		
	//{".implode(", ",$jsOption)."}
		$jsCode[] = "$j(document).ready(function(){
					$j( '#{$options['bindingReference']}' ).buttonset();
				  })";
		$js = null;
		if($options['enabled']){
			$js = $this->Javascript->codeBlock(implode("\n",$jsCode));
		}
		//going to have to make a checkbox loop instead of multi select checkboxes unless you can remove the checkbox divs somehow
		$elems = "<span id='{$options['bindingReference']}' style='clear:none'>";
		$elems .= $this->Form->input($elementName, array( 'type' => 'select', 'multiple' => 'checkbox' ,'div'=>false, 'label'=>$options['label']));
		$elems .= "</span>";
		return $js.$elems;
	}
	
	
}


?>