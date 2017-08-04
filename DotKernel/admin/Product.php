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
		$this->db->insert('product',$data);
	}
}