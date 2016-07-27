<?php
namespace Common\Model;

use Common\Model\BaseModel;

class GoodCategoryModel extends BaseModel
{
    protected $tableName = "good_categorys";
    protected $_link = array(
    		'Category'=>array(
    				'mapping_type'=>self::BELONGS_TO,
    				'class_name'=>'GoodCategory',
    				'parent_key'=>'pid',
    			),
    	);
}
