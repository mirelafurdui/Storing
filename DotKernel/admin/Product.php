<?php
class Product extends Dot_Model
{
	// constructor function
	public function __construct()
	{
		parent::__construct();
	}

	public function getProductList($page=1)
	{
		$select=$this->db->select()
						 ->from('product');
		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage);
		return $dotPaginator->getData();
	}

	public function getProductById($id)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('id= ?',$id);
		$result=$this->db->fetchRow($select);
		return $result;
	}
	public function addProduct($data)
	{
		//var_dump($data); exit;
		$this->db->insert('product',$data);
	}

	public function selectCategory()
	{	
		$select=$this->db->select()
						 ->from('category');
		$result=$this->db->fetchAll($select);
		return $result;
	}

	public function selectBrand()
	{
		$select=$this->db->select()
						 ->from('brand');
		$result=$this->db->fetchAll($select);
		return $result;
	}
}