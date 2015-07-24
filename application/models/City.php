<?php

/**
 * 城市资料数据操作层
 * 所有的查询的结果缓存30天
 * author abiao 2015-7-2
 */
class Application_Model_City extends Application_Model_Abstract
{
    /**
     * 所有的查询的结果缓存30天
     */
    public function __construct()
    {
        parent::__construct(new Application_Model_Table_City());

        //设置缓存一个月
        try {
            $this->_select = $this->select()->setCacheClass(XF_Cache_Memcache::getInstance())->setCacheTime(60 * 24 * 30, FALSE);
        } catch (XF_Exception $e) {
        }
    }

    /**
     * 获取所有的省份资料
     * @return mixed
     */
    public function getsByProvince()
    {
        return $this->getsf('parent', '0');
    }

    /**
     * 获取所有的城市资料
     * @param int $parent 省份id
     * @return mixed
     */
    public function getsByCity($parent)
    {
        return $this->getsf('parent', $parent);
    }

    /**
     * 根据城市名称获取城市资料
     * @param string $name 城市名称
     * @return mixed
     */
    public function getCityByName($name)
    {
        return $this->select()->setWhere(array('parent,<>' => '0', 'name' => $name))->fetchRow();
    }

    /**
     * 根据城市名称获取城市资料
     * @param string $pinyin 城市拼音
     * @return mixed
     */
    public function getCityByPinYin($pinyin)
    {
        return $this->select()->setWhere(array('pinyin' => $pinyin))->fetchRow();
    }

    /**
     * 根据城市拼音获以及上级id取城市资料
     * @param string $pinyin 城市名称
     * @return mixed
     */
    public function getCityByPinyinAndParent($pinyin, $parent)
    {
        return $this->select()->setWhere(array('parent' => $parent, 'pinyin' => $pinyin))->fetchRow();
    }

    /**
     * 城市ID为数组Key的形式获取所有的品牌信息
     * @param int $parent_id 省份id
     * @return mixed
     */
    public function getsIndexAll($parent)
    {
        $citys = $this->getsByCity($parent);
        if ($citys != false) {
            foreach ($citys as $city) {
                $tmp[$city->id] = $city;
            }
        }
        return $tmp;
    }

    /**
     * 通过城市id 获取省份 城市 id
     */
    public function getCitysByCity_id($city_id)
    {
        $d = $this->get($city_id);
        if ($d->parent <= 0) {
            throw new XF_Exception('404 not found', 404);
        }

        return array(
            'pid' => $d->parent,
            'cid' => $d->id
        );

    }

    /**
     * 获取省份的省会城市信息
     * @param int $city_id 省份ID
     */
    /*public function getMain($city_id)
    {
        return $this->select()->setWhere(array('parent' => $city_id, 'is_main' => '1'))->fetchRow();
    }*/

}
