<?php

/**
 * Created by Sublime Text 3.
 * User: Daoyan
 * Date: 16/10/27
 * Time: 下午3:27
 */

namespace Common\Model;

class LcTestModel extends CommonModel
{   
    protected $trueTableName="brd_lc_test";
    protected $_fieldmap = array(
        'tid'=>'id',
        'name'=>'title',
        'name2'=>'title2',
    );

    /**
     * 创建测试数据
     * @param 
     *
     * @return bool
     */
    public function createTest() {
        //数据插入订单表中
        $info_array = [
            'name'=>"test",
        ];
        if ($this->insert_info_one($info_array)) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * 创建多条测试数据
     * @param 
     *
     * @return bool
     */
    public function createTestList() {
        //数据插入订单表中
        $info_array = [
            ['name'=>"test1"],
            ['name'=>"test2"],
            ['name'=>"test3"],
        ];
        if ($this->insert_info_all($info_array)) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * 查询单条数据 演示
     * @param 
     *
     * @return array
     */
    public function getTest() {
        $where = [
            ['','tid',"3",1],
            ['1','name',"3","test"],
        ];
        $rs = [
            $this->get_info_one($where,["tid", "name"],["tid"=>"9","name"=>"10"]),  
            /*$this->get_info_one(["tid"=>1,"name"=>"test"],["tid", "name"],["tid"=>"9","name"=>"10"]),
            $this->get_info_one(["tid"=>1,"name"=>"test"],["tid", "name"]),
            $this->get_info_one(["tid"=>1,"name"=>"test"]),
            $this->get_info_one("<#name#> = 'test'",'max(<#tid#>) as maxid','<#tid#> desc,<#name#> desc'),
            $this->get_info_one("<#name#> = 'test'",'max(<#tid#>) as maxid'),
            $this->get_info_one("<#name#> = 'test'"),*/
        ];      
        return $rs;
    }

    /**
     * 查询多条数据 演示
     * @param 
     *
     * @return array
     */
    public function getTestList() {
        $rs = [
            $this->get_info_all("<#name#> = 'test'",'<#tid#>,<#name#>','0,3','<#name#> desc',"<#tid#>"),
            $this->get_info_all("<#name#> = 'test'",'<#tid#>,<#name#>','0,3','<#name#> desc'),
            $this->get_info_all("<#name#> = 'test'",'<#tid#>,<#name#>','0,3'),
            $this->get_info_all("<#name#> = 'test'",'<#tid#>,<#name#>'),
            $this->get_info_all("<#name#> = 'test' and <#tid#> = 1"),
            $this->get_info_all(["name"=>"test"],["tid", "name"],[0,3],["tid"=>"9","name"=>"10"],["tid"]),
            $this->get_info_all(["name"=>"test"],["tid", "name"],[0,3],["tid"=>"9","name"=>"10"]),
            $this->get_info_all(["name"=>"test"],["tid", "name"],[0,3]),
            $this->get_info_all(["name"=>"test"],["tid", "name"]),
            $this->get_info_all(["tid"=>1, "name"=>"test"]),
            $this->get_info_all_sql(["name"=>"test"],["tid", "name"],[0,3],["tid"=>"9","name"=>"10"],["tid"]),

        ];      
        return $rs;
    }

    /**
     * 查询数据总数 演示
     * @param 
     *
     * @return array
     */
    public function getTestNum() {
        $rs = [
            $this->get_all_nums("<#name#> = 'test'"),
            $this->get_all_nums(["name"=>"test"]),

        ];      
        return $rs;
    }

    /**
     * 复杂查询组合 演示
     * @param 
     *
     * @return array
     */
    public function getManyTableTest() {
        $rs = [
            $this->get_buildSql_all("",'<#tid#>,<#name#>','0,20','<#name#> desc',"<#tid#>","t.<#name#> = 'test2'",'t.<#tid#>,t.<#name#>','0,3','t.<#name#> desc',"t.<#tid#>"),

        ];      
        return $rs;
    }

    /**
     * 更新数据 演示
     * @param 
     *
     * @return int
     */
    public function updateTest() {
        $rs = [     
            $this->update_info(["name"=>"test2"],["name"=>"test4"]),
            //$this->update_info("<#name#>='test4'",["name"=>"test2"]),
            //$this->update_info("<#name#>='test2'",["name"=>"test4", "name2"=>""]),
        ];      
        return $rs;
    }

    /**
     * 删除数据 演示
     * @param 
     *
     * @return bool
     */
    public function deleteTest() {
        $rs = [
            $this->delete_info("<#tid#>=15"),
            //$this->delete_info(["tid"=>14]),

        ];      
        return $rs;
    }

    /**
     * 查询映射名 演示
     * @param 
     *
     * @return array
     */
    public function findName() {
        $rs = [
            $this->fieldname("name"),

        ];      
        return $rs;
    }

    /**
     * 测试数据sql执行
     * @param 
     *
     * @return array
     */
    public function sqlTest() {
        $sql = "select <#name#> from <@tests@> where <#tid#> = 1";
        return $this->sql_query($sql);
    }
    


}