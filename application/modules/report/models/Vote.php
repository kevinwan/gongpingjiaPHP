<?php

/**
 * 估值相关数据操作
 * @author abiao 2015-7-17
 */
class Report_Model_Vote extends Application_Model_Abstract
{
    public function __construct()
    {
        parent::__construct(new Report_Model_Table_Vote());
    }

    /**
     *  获取评估投票
     *  2015-7-17
     */
    public function getVoteByTypeId($typeId)
    {
        return $this->getf("car_id", $typeId);
    }

    /*
     * 更新评估投票
     * 2015-07-22
     */
    public function upVoteById($id, $voteAry) {
        return $this->updatePk($id, $voteAry);
    }

    /*
     * 添加评估投票
     * 2015-07-22
     */
    public function addVote($voteAry) {
        return $this->insert($voteAry);
    }
}

