
<?php
	class mymoduledisplayModuleFrontController extends ModuleFrontController {
		
		public function init() {
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
