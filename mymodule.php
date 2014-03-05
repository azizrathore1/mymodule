<?php

if (!defined('_PS_VERSION_'))
  exit;

class MyModule extends Module{

  public function __construct(){

    $this->name = 'mymodule';
		$this->tab = 'search_filter';
		$this->version = '1.5';
		$this->author = 'Aziz rathore';
    $this->need_instance = 0;
    
    parent::__construct();
    
    $this->displayName = $this->l('My module');
		$this->description = $this->l('Adds a filter product categories.');
    
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

    /**
    * Get a single configuration value (in one language only)
    *
    * @param string $key Key wanted
    * @param integer $id_lang Language ID
    * @return string Value
    */

     if (!Configuration::get('MYMODULE_NAME'))       
      $this->warning = $this->l('No name provided');
}

	public function install(){
    if ( parent::install() == false ||
        $this->registerHook('leftColumn') == false ||
        $this->registerHook('header') == false ||
			// Temporary hooks. Do NOT hook any module on it. Some CRUD hook will replace them as soon as possible.
        // you can chagne the second param as likely json_encode(array(67))

  /**
   * Update configuration key for global context only
   *
   * @param string $key
   * @param mixed $values
   * @param bool $html
   * @return bool
   */
			 Configuration::updateValue('MYMODULE_NAME', 'my friend') == false
      )
      return false;
    return true;
	}

	public function uninstall(){
		if (!parent::uninstall() ||
			!Configuration::deleteByName('MYMODULE_NAME'))
			return false;
		return true;
	}
  
  public function hookLeftColumn($params){

    $languageId = (int) ($params['cookie']->id_lang);
    $categoriesData = Category::getCategories($languageId, $active = true);
    $homecategoriesData = Category::getHomeCategories($languageId, $active = true);
   
    $this->context->smarty->assign('homecategories', $homecategoriesData);
    $this->context->smarty->assign('langid', $languageId);
    return $this->display(__FILE__, 'mymodule.tpl');


    $this->context->smarty->assign(array( 
      
      'my_module_name' => Configuration::get('MYMODULE_NAME'),
      'my_module_category' => $this->context->link->getModuleLink('mymodule', 'display'),
      'my_module_newproducts' => $this->context->link->getModuleLink('mymodule', 'newproducts'),
    //'my_module_link' => $this->context->link->getManufacturerLink('mymodule', 'manufacturer'),
    'my_module_message' => $this->l('This is a simple text message') // Do not forget to enclose your strings in the l() translation method
    )
    );
}

public function hookHeader(){
  $this->context->controller->addCSS($this->_path.'css/mymodule.css', 'all');
  $this -> context -> controller ->addJS(_THEME_JS_DIR_.'bxslider/jquery.bxslider.min.js');
}   
private function _clearBlockcategoriesCache(){
  $this->_clearCache('mymodule.tpl');
}
}
