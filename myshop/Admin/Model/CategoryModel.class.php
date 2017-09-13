<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
	// public function gettree(){
	// 	return $this->select();
	// }
	// 分类树
	public function gettree($p = 0 ,$lv=0){
        $t = array();
        foreach($this->select() as $k=>$v){
            if($v['parent_id'] == $p){
                $v['lv'] = $lv;
                $t[] = $v;
                //检查
                $t = array_merge($t,$this->gettree($v['cat_id'],$lv+1));
            }
        }
        return $t;
    }

    // 旁边树形分类
    public function loop($id=0) {
		$list = array();
		foreach($this->select() as $v) {
			if($v['parent_id'] == $id) {
			 	$v['son'] = $this->loop($v['cat_id']);
			 	if(empty($v['son'])) {
			 		unset($v['son']);
			 	}
			 	array_push($list, $v);
			}
		}
		return $list;
	}
}
?>