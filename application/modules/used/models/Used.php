<?php

/**
 * 二手车相关数据操作
 * @author abiao 2015-7-15
 */
class Used_Model_Used extends Application_Model_Abstract
{
<<<<<<< HEAD
	public function __construct()
	{
		parent::__construct(new Used_Model_Table_Used());
	}
        
        /**
	 *  获取首页二手车背景墙
	 *  2015-7-15
	 */
	public function getIndexUsed($city,$num)
        {
            $query = '/api/cars/car/indexcar/gongpingjia-php/?city='.$city.'&num='.$num;
            $used = $this->pull($query);
            return $used->cars;
        }
        
        /**
	 *  获取首页二手车随便看看
	 *  2015-7-15
	 */
        public function getUsedList($city,$page,$num)
        {
            $query = '/api/cars/car/lookcar/gongpingjia-php/?city='.$city.'&num='.$num.'&page='.$page;
            $used = $this->pull($query);
            return $used->cars;
        }
        
        /**
	 *  获取首页二手车随便看看
	 *  2015-7-15
	 */
        public function getUsedCarDealers($city)
        {
            $query = '/api/cars/dealer/gongpingjia-php/?city='.$city;
            $dealers = $this->pull($query);
            return $dealers->dealers;
        }  
=======
    public function __construct()
    {
        parent::__construct(new Used_Model_Table_Used());
    }

    /**
     *  获取首页二手车背景墙
     *  2015-7-15
     */
    public function getIndexUsed($city, $num)
    {
        $query = '/api/cars/car/indexcar/gongpingjia-php/?city=' . $city . '&num=' . $num;
        $used = $this->pull($query);
        return $used->cars;
    }

    /**
     *  获取首页二手车随便看看
     *  2015-7-15
     */
    public function getUsedList($city, $page, $num)
    {
        $query = '/api/cars/car/lookcar/gongpingjia-php/?city=' . $city . '&num=' . $num . '&page=' . $page;
        $used = $this->pull($query);
        return $used;
    }

    /**
     *  获取首页二手车随便看看
     *  2015-7-15
     */
    public function getUsedCarDealers($city)
    {
        $query = '/api/cars/dealer/gongpingjia-php/?city=' . $city;
        $dealers = $this->pull($query);
        return $dealers->dealers;
    }
>>>>>>> 5755f08f2d8e05db34b3147f6028cfb4c1f1b56b
}
