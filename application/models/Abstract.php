<?php
/**
 * 基础Model类，所有自定义的Model都应该继承此类
 * @author abiao 2015-7-2
 */
abstract class Application_Model_Abstract
{
    /**
     * 当前model主要的Tabe对象
     * @var XF_Db_Table_Abstract
     */
    private $_table;
    private $__table;
	
    /** 
     * 定制的查询对象
     * 
     * @var XF_Db_Table_Select_Abstract
     */
    protected $_select;
	
    /**
     * 查询多条记录时，是否自动分页? 默认为FALSE不分页
     * @var bool
     */
    protected $_auto_paging = FALSE;
	
    /**
     * solr对象
     * @var Apache_Solr_Service
     */
    private $_solr;
	
    /**
     * solr服务器地址IP
     * @var string
     */
    const _solr_host = '116.90.87.46';
	
    /**
     * solr服务器端口
     * @var int
     */
    const _solr_port = 8383;
	
    /**
     * 初始化当前Model对应的Table对象
     * @access public
     * @param XF_Db_Table_Abstract $table
     * @throws XF_Exception
     */
    public function __construct(XF_Db_Table_Abstract $table = NULL)
    {
	if ($table == NULL)
            throw new XF_Exception('init Application_Model_Abstract error');
	$this->_table = $table;
	$this->__table = $table;
    }
	
    /**
     * 获取solr操作对象
     * @return Apache_Solr_Service
     */
    public function solr($path = NULL)
    {
	if ($this->_solr == NULL)
        {
			if ($path == NULL)
				$path = '/solr/';
			else
				$path = '/solr/'.$path;
				
			if (!class_exists('Apache_Solr_Service'))
				require XF_PATH.'/Custom/Solr/Service.php';
			$this->_solr = new Apache_Solr_Service(self::_solr_host, self::_solr_port, $path);
		}
		else 
		{
			if ($path != NULL)
			{
				$path = '/solr/'.$path;
				$this->_solr = new Apache_Solr_Service(self::_solr_host, self::_solr_port, $path);
			}			
		}
		
		return $this->_solr;
	}
	
	/**
	 * 获取当前对应的Table对象
	 * @return XF_Db_Table_Abstract
	 */
	public function table()
	{
		return $this->_table;
	}
	
	/**
	 * 获取一个全新的Table对象
	 * @return XF_Db_Table_Abstract
	 */
	public function NewTable()
	{
		return clone $this->__table;
	}
	
	/**
	 * 获取当前对应的Table查询对象
	 * @return XF_Db_Table_Select_Abstract
	 */
	public function select()
	{
		return $this->_select == null ?  $this->_select = $this->_table->getTableSelect() : $this->_select;
	}
	
	/**
	 * 根据主键获取一条记录
	 * @access public
	 * @param int $pk_id 主键id
	 * @return mixed
	 */
	public function get($pk_id)
	{
		return $this->select()->findRow($pk_id);
	}
	
	/**
	 * 根据字段获取一条记录
	 * @access public
	 * @param string $fieldName 字段名
	 * @param mixed $value 值，可以是一个数组
	 * @return mixed
	 */
	public function getf($fieldName, $value)
	{
		if (is_array($value))
			return $this->select()->setWhereIn($fieldName, $value)->fetchRow();
		return $this->select()->setWhere(array($fieldName => $value))->fetchRow();
	}
	
	
	/**
	 * 根据字段获取所有记录，返回一个二维数组或FALSE
	 * @access public
	 * @param string $fieldName 字段名
	 * @param mixed $value 值，可以是一个数组
	 * @return mixed
	 */
	public function getsf($fieldName, $value)
	{
		if (is_array($value))
			return $this->select()->setWhereIn($fieldName, $value)->setLimit(false)->fetchAll();
		return $this->select()->setWhere(array($fieldName => $value))->setLimit(false)->fetchAll();
	}
	
	/**
	 * 根据主键更新记录
	 * @access public
	 * @param int $pk_id 主键id
	 * @param array $data 要更新的资料
	 * @throws XF_Exception 可能会拋出该异常
	 * @return int
	 */
	public function updatePk($pk_id, Array $data)
	{
		$data[$this->_table->getPrimaryKey()] = $pk_id;
		return $this->NewTable()->fillDataFromArray($data)->update();
	}

	/**
	 * 根据主键删除记录
	 * @access public
	 * @param int $pk_id 主键id
	 * @return void
	 */
	public function deletePk($pk_id)
	{
		return $this->delete(array($this->_table->getPrimaryKey() => $pk_id));
	}
	
	/**
	 * 根据条件删除
	 * @param mixed $where 删除条件
	 * @return void
	 */
	public function delete($where)
	{
		return $this->select()->setWhere($where)->remove();
	}
	
	/**
	 * @通用数据插入
	 * @param array $data 数据数组
	 * @throws XF_Exception 可能会拋出该异常
	 * @return int 成功插入后的主键ID
	 */
	public function insert(Array $data)
	{
		return $this->NewTable()->fillDataFromArray($data, false)->insert(true);
	}
	
	/**
	 * 设置查询为自动分页【仅对多条查询时有效】
	 * @return Application_Model_Abstract
	 */
	public function autoPaging()
	{
		$this->_auto_paging = TRUE;
		return $this;
	}
	
	/**
	 * 验证指定的验证码是否有效
	 * @param string $smsCode 手机验证码
	 * @param int $smsCode 验证码
	 * @return bool
	 */
	public function smsCodeIsOk($mobile, $smsCode)
	{
		try 
		{
			$mem = XF_Cache_Memcache::getInstance();
		}
		catch (XF_Exception $e)
		{
			return false;
		}

		$code = $mem->read($mobile.'_'.$smsCode);
		return $code == $smsCode;
	}
	
	/**
	 * 清除指定的验证码
	 * @param string $mobile 手机验证码
	 * @param int $smsCode 验证码
	 * @return boolean
	 */
	public function smsCodeClear($mobile, $smsCode)
	{
		try
		{
			$mem = XF_Cache_Memcache::getInstance();
		}
		catch (XF_Exception $e)
		{
			return false;
		}
		
		$code = $mem->remove($mobile.'_'.$smsCode);
		return true;
	}
        
        /**
	 * 获取接口数据
	 * @access public
	 * param string $query 查询条件
	 * @return array
	 */
        public function pull($query)
	{
            //$url = urlencode($query);
            $url = $query;
            $curl = curl_init();  
            curl_setopt($curl, CURLOPT_URL, $url);  
            curl_setopt($curl, CURLOPT_HEADER, false);  
            curl_setopt($curl, CURLOPT_USERAGENT);  
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);  
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            $response = curl_exec($curl);  
            curl_close($curl); 
            $json = json_decode($response);
            if (is_object($json) && $json->status == 'success')
            {
                return $json;
            }
            else 
            {
                $message = '接口获取数据失败';
                XF_Functions::writeErrLog($message);
            }
        }
}

