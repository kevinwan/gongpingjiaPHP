<?php

/**
 * 估值相关数据操作
 * @author abiao 2015-7-17
 */
class Sell_Model_Sellinfo extends Application_Model_Abstract
{
    public function __construct()
    {
        parent::__construct(new Sell_Model_Table_Sellinfo());
    }

    /**
     *  添加其他信息
     *  2015-7-17
     */
    public function addSellInfo($userId, $modelId, $changeModelId, $dataFrom, $infoId, $car_parts, $car_color, $period_insurance, $car_maintain, $max_cost, $transfer_num, $nowCityId)
    {
        $sellInfo["user_id"] = $userId;
        $sellInfo["data_from"] = $dataFrom;
        $sellInfo["info_id"] = $infoId;
        $sellInfo["model_id"] = $modelId;
        if($dataFrom == "fourshop") {
            $sellInfo["change_model_id"] = $changeModelId;
        }
        $sellInfo["car_parts"] = $car_parts;
        $sellInfo["car_color"] = $car_color;
        $sellInfo["period_insurance"] = $period_insurance;
        $sellInfo["car_maintain"] = $car_maintain;
        $sellInfo["max_cost"] = $max_cost;
        $sellInfo["transfer_num"] = $transfer_num;
        $sellInfo["city_id"] = $nowCityId;
        $sellInfo["created"] = time();
        $res = $this->insert($sellInfo);
        return $res;
    }
}