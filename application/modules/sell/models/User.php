<?php

/**
 * 估值相关数据操作
 * @author abiao 2015-7-17
 */
class Sell_Model_User extends Application_Model_Abstract
{
    public function __construct()
    {
        parent::__construct(new Sell_Model_Table_User());
    }

    /**
     *  添加用户信息
     *  2015-7-17
     */
    public function addUser($username, $phone, $dataFrom, $infoId)
    {
        $user = array();
        $user["username"] = $username;
        $user["phone"] = $phone;
        $user["created"] = time();
        $res = $this->insert($user);
        return $res;
    }

    /*
     * 通过电话查找用户
     * 2015-7-22
     */
    public function findUserByPhone($phone) {
        return $this->getf("phone", $phone);
    }

	public function validateCode($phone, $validateCode) {
		return parent::smsCodeIsOk($phone, $validateCode);
	}

	public function clearCode($phone, $validateCode) {
		return parent::smsCodeClear($phone, $validateCode);
	}
}