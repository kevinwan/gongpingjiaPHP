<?php

/**
 * 汽车基础数据相关API
 *
 * @author abiao 2015-7-15
 */
class Api_AutoController extends Api_AbstractController
{
    public function __construct()
    {
        parent::__construct($this);
    }


    /**
     * 获取品牌
     */
    public function brandsAction()
    {

        $b = new Auto_Model_Brand ();
        $brands = $b->getBrand();
        if (!XF_Functions::isEmpty($brands)) {
            /*$tmp = array();
    foreach ($brands as $r)
    {
                $tmp[] = array(
                    'id' => $r->id,
        'name' => $r->name,
        'first_letter' => $r->first_letter,
        'pinyin' => $r->pinyin,
        'logo_img' => 'http://gongpingjia.qiniudn.com/img/logo/'.$r->logo_img
                );
    }*/
            $this->responseOK($brands);
        }
        $this->responseOK();
    }

    /**
     * 获取品牌关键词
     */
    public function brandKeywordsAction()
    {
        $b = new Auto_Model_Brand ();
        $keywords = $b->getBrandKeywords();
        if (!XF_Functions::isEmpty($keywords)) {
            $tmp = array();
            foreach ($keywords as $r) {
                $tmp[] = array(
                    'keywords' => $r->keywords,
                    'slug' => $r->slug,
                    'brand_name' => $r->brand_name,
                    'parent' => $r->parent,
                    'name' => $r->name
                );
            }
            $this->responseOK($tmp);
        }
        $this->responseOK();
    }
}

