<?php
class IndexController extends XF_Controller_Abstract
{
	public function __construct()
	{
		parent::__construct($this);
	}
	
	public function indexAction()
	{
                $b = new Auto_Model_Brand;
                $brands = $b->getBrand();
                $first_letter = array();
                foreach($brands as $brand)
                {
                    if(isset($first_letter[$brand->first_letter]['name']))
                    {
                        $first_letter[$brand->first_letter]['brandNames'][] = $brand->name;
                    }
                    else 
                    {
                        $first_letter[$brand->first_letter]['name'] = $brand->first_letter;
                        $first_letter[$brand->first_letter]['brandNames'][] = $brand->name;
                    }
                    
                }
                $this->_view->brands = $first_letter;
		$this->_view->title = 'welcome to gongpingjia';
                $this->_view->my = 'abiao';
	}
}