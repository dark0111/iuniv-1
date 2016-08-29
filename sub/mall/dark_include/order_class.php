<?
	class Cgoods 
	{ 
		var $goods_no;
		var $basket_no;
		var $goods_price;
		var $goods_count;
		var $goods_get_point;
	} 

	class Cbasket 
	{ 
		var $vgoods; 

		function add_basket($gn,$bn,$gp,$gc,$ggp)
		{ 
		   $this->vgoods[$bn] = new Cgoods; 
		   $this->vgoods[$bn]->goods_no=$gn; 
		   $this->vgoods[$bn]->basket_no=$bn; 
		   $this->vgoods[$bn]->goods_price=$gp; 
		   $this->vgoods[$bn]->goods_count=$gc; 
		   $this->vgoods[$bn]->goods_get_point=$ggp; 
		} 

		function basket_fetch() 
		{ 
			 $temp=current($this->vgoods); 
			 if (!$temp) reset($this->vgoods); 
			 else {next($this->vgoods);} 
			 return $temp; 
		}

		function basket_count() //하나 삭제하기 
		{ 
		  return count($this->vgoods); 
		}

		function basket_del($bn) //하나 삭제하기 
		{ 
		  unset($this->vgoods[$bn]); 
		}


		function basket_del_all() //전체 삭제
		{ 
		  unset($this->vgoods); 
		}
	} 
?>
