<?php
class Product extends Dot_Model
{
	// constructor function
	public function __construct()
	{
		parent::__construct();
	}

	// function that joins 2 tables with the origin table "product" and lists them all with some rows changed + shows only if isactive=1
	public function getProductList($page=1)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('product.isactive= ?',1)
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name'])
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name']);

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage);
		return $dotPaginator->getData();
	}

	// function that shows product by id and joins with db category and brand + shows only if isactive=1
	public function getProductById($id)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('product.id= ?',$id)
						 ->where('product.isactive= ?',1)
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name'])
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name']);
		$result=$this->db->fetchRow($select);
		return $result;
	}
	// function that gets products from a certain brand using joins + shows only if isactive=1
	public function getProductByBrand($id,$page=1)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('idBrand= ?',$id)
						 ->where('product.isactive= ?',1)
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name'])
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name']);

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage=10);
		return $dotPaginator->getData();

	}
	// function that gets products from a certain category using joins + shows only if isactive=1
	public function getProductByCategory($id,$page=1)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('idCategory= ?',$id)
						 ->where('product.isactive= ?',1)
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name'])
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name']);

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage=10);
		return $dotPaginator->getData();
	}

	// function that gets everything from category
	public function getCategoryList($page=1)
	{
		$select=$this->db->select()
						 ->from('category');

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage=10);
		return $dotPaginator->getData();
	}

	// function that gets everything from brand
	public function getBrandList($page=1)
	{
		$select=$this->db->select()
						 ->from('brand');
						 
		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage=10);
		return $dotPaginator->getData();
	}
}
