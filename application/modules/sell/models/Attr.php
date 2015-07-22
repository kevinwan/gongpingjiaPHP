<?php

/**
 * 估值相关数据操作
 * @author abiao 2015-7-17
 */
class Sell_Model_Attr extends Application_Model_Abstract
{
    public function __construct()
    {
        parent::__construct(new Sell_Model_Table_Attr());
    }

    /**
     *  添加图片
     *  2015-7-17
     */
    public function addAttr($userId, $sellInfoId, $type, $src, $des)
    {
        $sellInfo["user_id"] = $userId;
        $sellInfo["sell_info_id"] = $sellInfoId;
        $sellInfo["attr_type"] = $type;
        $sellInfo["attr_src"] = $src;
        $sellInfo["attr_des"] = $des;
        $sellInfo["created"] = time();
        $res = $this->insert($sellInfo);
        return $res;
    }
}