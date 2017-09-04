<?php


class Cart extends Dot_Model
{
	public function getProduct($id) 
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('id= ?',$id);
		$result=$this->db->fetchRow($select);
		return $result;
	}
	public function getCart($id) 
	{
		$select=$this->db->select('userId')
						 ->from('cart')
						 ->where('userId= ?',$id);
		$result=$this->db->fetchRow($select);
		return $result;
	}

	public function getProductToCart($id) 
	{
		$select=$this->db->select()
						 ->from('cartproduct')
						 ->join('cart','cart.id = cartproduct.cartId');
		$result=$this->db->fetchAll($select);
		return $result;

	}

	public function addProductToCart($data, $cartId) 
	{	
		
		$dataProduct["cartId"] = $cartId;
		$dataProduct["productId"] = $data['id'];
		$dataProduct["name"] = $data['name'];
		$dataProduct["price"] = $data['price'];
		$dataProduct["quantity"] = 1;
		$dataProduct["stoc"] = $data['stoc'];

		$this->db->insert('cartproduct', $dataProduct);
		
	}

	public function deleteProduct($id)
	{
			$this->db->delete('cartproduct', array("productId = " . $id));
	}

	public function getProductCartDetails($id)
	{
		$select=$this->db->select()
						 ->from('cartproduct')
						 ->where('productId=?',$id);
		$result=$this->db->fetchRow($select); 
		return $result;
	}

	public function updateQuantity($data, $id)
	{	
		$this->db->update('cartproduct', $data, "productId= ". $id);
	}

	public function updateQuantityOfProduct($data, $id)
	{	
		$this->db->update('product', $data, "productId= ". $id);
	}
}