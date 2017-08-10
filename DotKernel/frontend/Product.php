<?php
class Product extends Dot_Model
{
	// constructor function
	public function __construct()
	{
		parent::__construct();
	}

	// function that joins 2 tables with the origin table "product" and lists them all with some rows changed
	public function getProductList($page=1)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name'])
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name']);

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage=10);
		return $dotPaginator->getData();
	}

	// function that shows product by id and joins with db category and brand
	public function getProductById($id)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('product.id= ?',$id)
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name'])
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name']);
		$result=$this->db->fetchRow($select);
		return $result;
	}
}
