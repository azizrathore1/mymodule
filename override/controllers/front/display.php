
<?php
class mymoduledisplayModuleFrontController extends ModuleFrontController {


	public function init() {
	//$this->page_name = 'eurostores_search'; //page_name and body id
	/***
	 To hide specific column assign boolean value to specific variable
	*/
	//$this->display_column_left = false;
	//$this->display_column_right = false;
	 parent::init();
	} 

	public function initContent() {
		parent::initContent();
		$this->setTemplate('mymoduleresult.tpl');
		//$this->setTemplate('manufacturer.tpl');
		 
	}
	public function setMedia() {
		parent::setMedia();
		//$this->addCSS(__PS_BASE_URI__ . 'modules/' . $this->module->name . '/css/' . $this->module->name . '.css');
		$this ->addJS(__PS_BASE_URI__ . 'modules/' . $this->module->name .'/js/mymoduleresult.js');  
	}
}
?>
