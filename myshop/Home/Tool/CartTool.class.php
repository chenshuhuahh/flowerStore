<?php  
namespace Home\Tool;
abstract class ACartTool {
	/**
	* 向购物车中添加1个商品
	* @param $goods_id int 商品id
	* @param $goods_name String 商品名
	* @param $shop_price float 价格
	* @return boolean
	*/
	abstract public function add($goods_id,$goods_name,$shop_price,$goods_img);
	/**
	* 修改购物中的商品数量
	* @param $goods_id int 商品id
	*/
	abstract public function changenum($goods_id,$goods_num);

	/**
	* 减少购物中的1个商品数量，如果减至0，则从购物车中删除此商品
	* @param $goods_id int 商品id
	*/
	abstract public function decr($goods_id);
	/**
	* 从购物车删除商品
	* @param $goods_id 商品id
	*/
	abstract public function del($goods_id);
	/**
	* 列出购物车所有的商品
	* @return Array
	*/
	abstract public function items();
	/**
	* 返回购物车中有几种商品
	* @return int
	*/abstract public function calcType();
	/**
	* 返回购物中商品的个数
	* @return int
	*/
	abstract public function calcCnt();
	/**
	* 返回购物车中商品的总价格
	* @return float
	*/
	abstract public function calcMoney();
	/**
	* 清空购物车
	* @return void
	*/
	abstract public function clear();
}

/**
* 
*/
class CartTool extends ACartTool
{
	public $item = array();
	//单例模式
	public static $ins = null;
	public static function getIns(){
		if(self::$ins == null){
			self::$ins = new self();
		}
		return self::$ins;
	}
	//构造函数
	final protected function __construct(){
		$this->item = session('?cart')?session('cart'):array();
	}
	/**
	* 向购物车中添加1个商品
	* @param $goods_id int 商品id
	* @param $goods_name String 商品名
	* @param $shop_price float 价格
	* @return boolean
	*/
	public function add($goods_id,$goods_name,$shop_price,$goods_img){
		if($this->item[$goods_id]){
			// if($goods_num != null){
			// 	$this->item[$goods_id]['num'] += $goods_num;
			// }else{
			$this->item[$goods_id]['num'] += 1;
			// }			
		}else {
			$goods['goods_name'] = $goods_name;
			$goods['shop_price'] = $shop_price;
			$goods['goods_img'] = $goods_img;
			// if($goods_num != null){
			// 	$goods['num'] = $goods_num;
			// }else{
			$goods['num'] = 1;
			// }			
			$this->item[$goods_id] = $goods;
		}
	}

	/**
	* 修改购物车中的商品数量
	* @param $goods_id int 商品id
	*/
	public function changenum($goods_id,$goods_num){
		if($this->item[$goods_id]){
			$this->item[$goods_id]['num'] = $goods_num;
		}
	}

	/**
	* 减少购物中的1个商品数量，如果减至0，则从购物车中删除此商品
	* @param $goods_id int 商品id
	*/
	public function decr($goods_id){
		if($this->item[$goods_id]){
			$this->item[$goods_id]['num'] -= 1;
		}
		if($this->item[$goods_id]['num'] <= 0){
			$this->del($goods_id);
		}
	}
	/**
	* 从购物车删除商品
	* @param $goods_id 商品id
	*/
	public function del($goods_id){
		unset($this->item[$goods_id]);
	}
	/**
	* 列出购物车所有的商品
	* @return Array
	*/
	public function items(){
		return $this->item;
	}
	/**
	* 返回购物车中有几种商品
	* @return int
	*/
	public function calcType(){
		return count($this->item);
	}
	/**
	* 返回购物中商品的个数
	* @return int
	*/
	public function calcCnt(){
		$n = 0;
		foreach ($this->item as $k => $v) {
			$n += $v['num'];
		}
		return $n;
	}
	/**
	* 返回购物车中商品的总价格
	* @return float
	*/
	public function calcMoney(){
		$n = 0;
		foreach ($this->item as $k => $v) {
			$n += $v['num'] * $v['shop_price'];
		}
		return $n;
	}
	/**
	* 清空购物车
	* @return void
	*/
	public function clear(){
		$this->item = array();
	}

	//析构函数
	public function __destruct() {
		session('cart' , $this->item);
	}
}

?>