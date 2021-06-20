<?php  
class Product extends ViewModel{
	public $productCategory;
	public $product;
	function __construct(){
		$this->productCategory = $this->getModel('ProductCategoryDAL');
		$this->product = $this->getModel('ProductDAL');
	}
	public function Index(){
		$listCateJSON = json_decode($this->productCategory->getListCate(),true);
		$listProductJSON = json_decode($this->product->getProduct(),true);
		$this->loadView('Shared','Layout',[
			'title'=>'Product',
			'page'=>'Product/Index',
			'listCate'=>$listCateJSON,
			'listProduct'=>$listProductJSON
		]);
	}
	public function Detail($productID){
		$productJSON = json_decode($this->product->getProductByID($productID),true);
		$relatedProductJSON = json_decode($this->product->getRelatedProduct($productJSON['IDCate']),true);
		$this->loadView('Shared','Layout',[
			'title'=>$productJSON['ProductName'],
			'page'=>'Product/Detail',
			'single'=>$productJSON,
			'relatedProduct'=>$relatedProductJSON
		]);
	}
	public function TopView(){
		$listViewJSON = json_decode($this->product->getTopView(100),true);
		$this->loadView('Shared','Layout',[
			'title'=>'TopView',
			'page'=>'Product/TopView',
			'listView'=>$listViewJSON
		]);
	}
	public function HotProduct(){
		$listHotJSON = json_decode($this->product->getTopHot(100),true);
		$this->loadView('Shared','Layout',[
			'title'=>'HotProduct',
			'page'=>'Product/HotProduct',
			'listHot'=>$listHotJSON,
		]);
	}
	public function NewProduct(){
		$listNewJSON = json_decode($this->product->getTopNew(100),true);
		$this->loadView('Shared','Layout',[
			'title'=>'NewProduct',
			'page'=>'Product/NewProduct',
			'listNew'=>$listNewJSON,
		]);
	}
}
?>