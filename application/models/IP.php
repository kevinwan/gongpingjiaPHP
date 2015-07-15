<?php
/**
 * IP地址库
 * @author abiao 2015-7-2
 */
class Application_Model_IP extends Application_Model_Abstract
{	

    public function __construct()
    {
        parent::__construct(new Application_Model_Table_IP());
	//设置缓存一小时
	try
	{
            $this->_select = $this->select()->setCacheClass(XF_Cache_Memcache::getInstance())->setCacheTime(60, FALSE);
	}
	catch (XF_Exception $e){}
    }
	
    /**
     * 指定的IP是否存在库中
     * @param string $ip ip地址
     * @return mixed
     */
    public function getByIP($ip)
    {
        return $this->getf('ip', $ip);
    }
	
    /**
     * 添加IP到库中
     * @param string $ip ip地址
     * @return int 当前ip所在地区(省份)ID
     */
    public function add($ip)
    {
        if ($ip == '127.0.0.1') return '1';
		
	$province_id = 1;
        $city_id = 35;
		
	$url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
	$url= str_replace('&amp;','&',$url);  
	$curl = curl_init();  
	curl_setopt($curl, CURLOPT_URL, $url);  
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0); 
	$string = curl_exec($curl);
	curl_close($curl);  
	 	 
        $json = json_decode($string);

	//如果无法正常解析到JSON，则返回 北京的id
	if($json == false) return $province_id;
	if (!is_object($json->data)) return $province_id;
		
	$provinceName = str_replace('省', '', $json->data->region);
	$provinceName = str_replace('市', '', $provinceName);
	$cityName = str_replace('市', '', $json->data->city);


        $mod = new Application_Model_City();
        $row = $mod->getCityByName($cityName);
        if ($row != false)
        {
            $province_id = $row->parent;
            $city_id = $row->id;
        }
		
	$tb = $this->NewTable();
	$tb->ip = $ip;
	$tb->province_id = $province_id;
	$tb->city_id = $city_id;
	$tb->address = '';
	try{
            $tb->insert();
	}
	catch (XF_Exception $e)
	{}
        
	return $province_id;
    }
}

