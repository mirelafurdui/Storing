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
	
	public function getIdCart($userId)
	{
		$select=$this->db->select('id')
						 ->from('cart')
						 ->where('userId= ?',$userId);
		$result=$this->db->fetchRow($select);
		return $result;
	}
	public function getProductToCart($id) 
	{
		$select=$this->db->select()
						 ->from('cartproduct')
						 ->where('cartId=?',$id);
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

	public function updateQuantityOfProduct($data, $id)
	{	
		$this->db->update('product', $data, "productId= ". $id);
	}
	public function deleteProduct($id, $cartId)
	{
			$this->db->delete('cartproduct', array("productId = " . $id, 'cartId = '. $cartId));
	}

	public function getProductCartDetails($id,$cartId)
	{
		$select=$this->db->select()
						 ->from('cartproduct')
						 ->where('productId=?',$id)
						 ->where('cartId=?', $cartId);
		$result=$this->db->fetchRow($select); 
		return $result;
	}

	public function getUserDetails($userId) 
	{
		$select=$this->db->select()
						 ->from('user')
						 ->where('id=?',$userId);
		$result=$this->db->fetchRow($select); 
		return $result;
	}

	public function getCartID($id) 
	{
		$select=$this->db->select('id')
						 ->from('cart')
						 ->where('userId=?',$id);
		$result=$this->db->fetchRow($select); 
		return $result;
	}
	public function updateQuantity($data, $productId, $cartId)
	{	
		$where['productId = ?'] = $productId;
		$where['cartId = ?']  = $cartId;
		$this->db->update("cartproduct", $data, $where);
	}

	public function testIfProductExistInTheCart($productId, $cartId)
	{
		$select=$this->db->select()
						 ->from('cartproduct')
						 ->where('productId=?',$productId)
						 ->where('cartId=?',$cartId);
		$result=$this->db->fetchRow($select); 
		if (empty($result)) {
			return 0;
		}else{
			return 1;
			
		}
	}
	public function decreasesNumberProduct($q,$productId)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('id=?',$productId);
		$result=$this->db->fetchRow($select); 
		$result['stoc'] = $result['stoc']-$q;
		$this->db->update("product", $result, "id= ". $productId);
	}

	public function deleteCart($productId, $idCart)
	{
		$this->db->delete('cartproduct', array("productId = " . $productId, 'cartId = '. $idCart));
	}
}