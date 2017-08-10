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

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage);
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

	// function that add a product with the established data from POST
	public function addProduct($data)
	{
		$this->db->insert('product',$data);
	}

	// function that selects from category
	public function selectCategory()
	{	
		$select=$this->db->select()
						 ->from('category');
		$result=$this->db->fetchAll($select);
		return $result;
	}

	// function that selects from brand
	public function selectBrand()
	{
		$select=$this->db->select()
						 ->from('brand');
		$result=$this->db->fetchAll($select);
		return $result;
	}

	// function that adds data from $data to the certain tabel that's selected in $database
	public function addData($data,$database)
	{
		$this->db->insert($database,$data);
	}

	// Function that edits a certain product based on $id and inserts data to be edited based on $data
	public function updateProductDb($data,$id)
	{
		$this->db->update('product',$data, 'id = '.$id);		
	}

	// Function that deletes a product based on his $id
	public function deleteProduct($id)
	{
		$this->db->delete('product','id = '.$id);		
	}

	public function activateProduct($id, $isActive)
	{	
		$this->db->update('product', array('isActive' => $isActive), 'id = ' . $id);
	}
}
