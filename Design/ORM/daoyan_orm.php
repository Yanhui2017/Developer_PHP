<?php
/**
 * Created by Sublime Text 3.
 * User: Daoyan
 * Date: 16/10/27
 * Time: 下午3:27
 */

namespace Common\Model;
use Think\Model;


class CommonModel extends Model
{		
	/**
	 * 数据库表名对应别名 表字段别名前2个字母为此数组键
	 * @param $m 模型名
	 * @author tommy.jin	2013-12-31
	 */
	private $_tbn = array(
				'tests'=>'LcTest',
			);
	/**
	 * sql转换用到的数组
	 * @param 
	 * @author tommy.jin	2014-01-14
	 */
	private $_where_fields = array("0"=>"","1"=>"AND","2"=>"OR","3"=>"=","4"=>"!=","5"=>">","6"=>"<","7"=>"in","8"=>"not in",
			"9"=>"DESC","10"=>"ASC","11"=>"like","12"=>'not like',"13"=>'<=',"14"=>">=");
	


	
	/**
	 * @author tommy.jin	2013-12-31
	 */
	public function get_info_one($where,$fields="",$order="")
	{		
		if(is_array($where))
		{
			$where = $this->sql_where($where);
		}
		if(is_array($fields))
		{
			$fields = $this->sql_fields($fields);
		}
		if(is_array($order))
		{
			$order = $this->sql_order($order);
		}
		$where = $this->parseField($where);
		$fields = $this->parseField($fields);
		$order = $this->parseField($order);
		$info = $this->field($fields)->where($where)->order($order)->find();
		
		return $this->parseResult($info);
	}
	


    /**
     *
     */
    public function parseResult($data,$type=1) {
        if(!empty($data)){
            //检查字段映射
            if(!empty($this->_fieldmap)) {
                $fieldmap = $this->_fieldmap;
                //遍历数组，如果$value是数组，则遍历_fieldmp进行键名替换
                foreach ($fieldmap as $key=>$val){
                    foreach($data as &$value){
                        if(is_array($value)){
                            if($type==1) { // 读取
                                if(array_key_exists($val,$value)) {
                                    $value[$key] = $value[$val];
                                    unset($value[$val]);
                                }
                            }else{
                                foreach ($value as $k => $v){
                                    if(array_key_exists($val,$value)) {
                                        $value[$val] = $value[$key];
                                        unset($value[$key]);
                                    }
                                }
                            }
                        }else{
                            if($type==1) { // 读取
                                foreach ($data as $k => $v){
                                    if(array_key_exists($val,$data)) {
                                        $data[$key] = $data[$val];
                                        unset($data[$val]);
                                    }
                                }
                            }else{
                                if(array_key_exists($val,$data)) {
                                    $data[$val] = $data[$key];
                                    unset($data[$key]);
                                }
                            }

                        }
                    }
                }

            }
        }
        return $data;

    }



    /**
	 * @author tommy.jin	2013-12-31
	 */
	public function get_data_all($where,$fields="",$limit="",$order="",$group="")
	{
		$where = $this->parseField($this->sql_where($where));
		$fields = $this->parseField($this->sql_fields($fields));
		$limit = $this->sql_limit($limit);
		$order = $this->parseField($this->sql_order($order));
		$group = $this->parseField($this->sql_group($group));
		$info = $this->field($fields)->where($where)->limit($limit)->order($order)->group($group)->select();
		return $this->parseResult($info);
	}

    /**
     * @author tommy.jin
     */
    protected function fieldname($name)
    {
        $field = $this->_fieldmap[$name];
        if($field)
        {
            return $field;
        }else
        {
            return "1";
        }
    }



    /**
	 * @author tommy.jin	2013-12-31
	 */
	public function insert_info_one($info)
	{
		$info = $this->parseField($info);
		return $this->add($info);
	}
	

	
	/**
     * @author tommy.jin	2013-12-31
	 */
	public function insert_info_all($info)
	{
		$info = $this->parseField($info);
		return $this->addAll($info);
	}
	
	/**
	 * @author tommy.jin	2013-12-31
	 */
	public function update_info($where,$info,$limit="",$order="")
	{
		if(is_array($where))
		{
			$where = $this->sql_where($where);
		}
		if(is_array($limit))
		{
			$limit = $this->sql_limit($limit);
		}
		if(is_array($order))
		{
			$order = $this->sql_order($order);
		}
		$where = $this->parseField($where);
		$info = $this->parseField($info);
		$order = $this->parseField($order);
		$rs = $this->where($where)->order($order)->limit($limit)->save($info);
		//0216修改
		if($rs === 0){
			return true;
		}
		return $rs;
	}
	
	/**
	 * @author tommy.jin	2013-12-31
	 */
	public function delete_info($where,$limit="",$order="")
	{
		if(is_array($where))
		{
			$where = $this->sql_where($where);
		}
		if(is_array($limit))
		{
			$limit = $this->sql_limit($limit);
		}
		if(is_array($order))
		{
			$order = $this->sql_order($order);
		}
		$where = $this->parseField($where);
		$order = $this->parseField($order);
		return $this->where($where)->order($order)->limit($limit)->delete();
	}

    /**
     * @author tommy.jin	2014-1-10
     */
    public function get_buildSql_all($zwhere="",$zfields="",$zlimit="",$zorder="",$zgroup="",$where="",$fields="",$limit="",$order="",$group="")
    {
        //子表sql
        $zwhere = $this->parseField($zwhere);
        $zfields = $this->parseField($zfields);
        $zorder = $this->parseField($zorder);
        $zgroup = $this->parseField($zgroup);
        //主表sql
        $where = $this->parseField($where);
        $fields = $this->parseField($fields);
        $order = $this->parseField($order);
        $group = $this->parseField($group);
        //创建子表SQL
        $table = $this->field($zfields)->where($zwhere)->limit($zlimit)->order($zorder)->group($zgroup)->select(false);
        $info = $this->field($fields)->table('('.$table.') AS t')->where($where)->limit($limit)->order($order)->group($group)->select();
        return $this->parseResult($info);
    }

    /**
     * @author 黄楠	2014-1-13
     */
    public function sql_query($sql)
    {
        $sql = $this->sqlParseField($sql);
        return $this->query($sql);
    }

    /**
     * @author tommy.jin	2013-12-31
     */
    public function get_info_all($where,$fields="",$limit="",$order="",$group="")
    {
        if(is_array($where))
        {
            $where = $this->sql_where($where);
        }
        if(is_array($fields))
        {
            $fields = $this->sql_fields($fields);
        }
        if(is_array($limit))
        {
            $limit = $this->sql_limit($limit);
        }
        if(is_array($order))
        {
            $order = $this->sql_order($order);
        }
        if(is_array($group))
        {
            $group = $this->sql_group($group);
        }
        $where = $this->parseField($where);
        $fields = $this->parseField($fields);
        $order = $this->parseField($order);
        $group = $this->parseField($group);
        $info = $this->field($fields)->where($where)->limit($limit)->order($order)->group($group)->select();
        return $this->parseResult($info);
    }

    /**
     * @author tommy.jin
     */
    public function get_info_all_sql($where,$fields="",$limit="",$order="",$group="")
    {
        if(is_array($where))
        {
            $where = $this->sql_where($where);
        }
        if(is_array($fields))
        {
            $fields = $this->sql_fields($fields);
        }
        if(is_array($limit))
        {
            $limit = $this->sql_limit($limit);
        }
        if(is_array($order))
        {
            $order = $this->sql_order($order);
        }
        if(is_array($group))
        {
            $group = $this->sql_group($group);
        }
        $where = $this->parseField($where);
        $fields = $this->parseField($fields);
        $order = $this->parseField($order);
        $group = $this->parseField($group);
        $sql = $this->field($fields)->where($where)->limit($limit)->order($order)->group($group)->buildSql();
        return $sql;
    }

    /**
     * @author tommy.jin	2014-01-13
     */
    public function sqlParseField($sql){
        preg_match_all('/<@([^@]*)@>/',$sql,$t);
        foreach ($t['1'] as $key => $val)
        {
            $tab = ucfirst($this->_tbn[$val]);
            $M = D($tab);
            $sql = str_replace($t['0'][$key],"`{$M->trueTableName}`",$sql);
            preg_match_all('/<#([^#]*)#>/',$sql,$f);
            foreach ($f['1'] as $k => $v)
            {
                if(array_key_exists($v,$M->_fieldmap))
                {
                    $sql = str_replace($f['0'][$k],"`{$M->fieldname($v)}`",$sql);

                }
            }
        }
        return  $sql;
    }

    /**
     * @author tommy.jin
     */
    public function from_query($rssql,$where='',$fields="",$limit="",$order="",$group=""){
        if(is_array($group))
        {
            $group = $this->sql_group($group);
        }
        if(is_array($limit))
        {
            $limit = $this->sql_limit($limit);
        }
        $group = $this->parseField($group);

        $info = $this->table($rssql.' AS a')->group($group)->limit($limit)->select();

        return $this->parseResult($info);
    }


	/**
	 * @editer tommy.jin	2013-12-31
	 */
	public function parseField($name){
		//解析数组
		if (is_array($name)) {
			$new_name = array();
			foreach ($name as $key=>$val) {
				if(is_array($val) && $val[0]!='exp')
				{
					$new_name[] = $this->parseField($val);
				}else
				{
					$realkey = $this->fieldname($key);
					$new_name[$realkey] = $val;
				}
			}
			//dump($new_name);
			//errorlog($new_name, './aa.txt');
			return $new_name;
			//解析字符串
		}elseif(is_string($name)){
			preg_match_all('/<#([^#]*)#>/',$name,$w);
			foreach ($w['1'] as $k => $v){
				$name = str_replace($w['0'][$k],"`{$this->fieldname($v)}`",$name);		
			}
			return  $name;
			/*
			 if(preg_match('/\bAND\b/i',$where,$w)){
			$wherearray = explode($w['0'],$where);
			foreach($wherearray as $key => $value){
			$wherearr = explode('=',$value);
			$wsql = str_replace($wherearr['0'],$this->fieldname(trim($wherearr['0'])), $value);
			$sql .= $sql ? " $font $wsql " : " $wsql ";
			}
			}else{
			$wherearray = explode('=',$where);
			$wheresql = str_replace($wherearray['0'],$this->fieldname(trim($wherearray['0'])), $where);
			}
			*/
		}
	}
	

	

	
	


	
	/**
	 * @author tommy.jin	2014-01-14
	 */
	public function sql_fields($fields = "")
	{
		$sql_fields = '';		
		foreach($fields as $k => $v)
		{
			if($v == "*")
			{
				$sql_fields .= "{$v}";
			}else
			{
				$sql_fields .= "<#{$v}#>,";				
			}
		}
		$sql_fields = substr($sql_fields,'0','-1');
		return $sql_fields;
	}
	
	/**
	 * @author tommy.jin	2014-01-14
	 */
	public function sql_limit($limit = "")
	{
		foreach($limit as $k => $v)
		{
			$sql_limit = $k.",".$v;
		}
		return $sql_limit;
	}
	
	/**
	 * @author tommy.jin	2014-01-14
	 */
	public function sql_order($order = "")
	{
		$sql_order = '';
		foreach($order as $k => $v)
		{
			$sql_order .= "<#{$k}#> {$this->_where_fields[$v]},";
		}
		$sql_order = substr($sql_order,'0','-1');
		return $sql_order;
	}
	
	/**
	 * @author tommy.jin	2014-01-14
	 */
	public function sql_group($group = "")
	{
		$sql_group = "<#{$group['0']}#>";
		return $sql_group;
	}

    /**
     * @author tommy.jin	2014-01-14
     */
    public function sql_where($where = "")
    {
        $sql_where = '';
        $status = "";
        foreach($where as $k => $v)
        {
            if(is_array($v))
            {

                if(in_array($v['2'],array('7','8')))
                {
                    $sql_where .= " {$this->_where_fields[$v['0']]} <#{$v['1']}#> {$this->_where_fields[$v['2']]} ({$v['3']}) ";
                }elseif($v['2'] == '11')
                {
                    $sql_where .= " {$this->_where_fields[$v['0']]} <#{$v['1']}#> {$this->_where_fields[$v['2']]} '%{$v['3']}%' ";
                }else
                {
                    $sql_where .= " {$this->_where_fields[$v['0']]} <#{$v['1']}#> {$this->_where_fields[$v['2']]} '{$v['3']}' ";
                }
            }else
            {
                $sql_where .= " <#{$k}#> = '{$v}' AND ";
                $status = 1;
            }
        }
        if($status == 1)
        {
            $sql_where = substr($sql_where,'0','-4');
        }
        return $sql_where;
    }
	
	/**
	 * @author tommy.jin
	 */
	public function get_all_nums($where = ""){
		$rs = $this->get_info_all($where);
		$num = count($rs);
		return $num;
	}

}