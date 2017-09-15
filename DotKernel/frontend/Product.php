<?php
class Product extends Dot_Model
{
	// constructor function
	public function __construct()
	{
		parent::__construct();
	}

	// function that joins 2 tables with the origin table "product" and lists them all with some rows changed + shows only if isactive=1
	public function getProductList($page=1,$number)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('product.isactive= ?', 1)
						 ->join('category', 'category.id = product.idCategory',['categoryName'=>'name'])
						 ->join('brand', 'brand.id = product.idBrand',['brandName'=>'name']);

		$dotPaginator = new Dot_Paginator($select,$page,$number);
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
	// function that will get every comment that's linked to the certain product
	public function getCommentByProduct($id,$page=1)
	{
		$select=$this->db->select()
						 ->from('comment')
						 ->where('comment.productId= ?',$id)
						 ->where('comment.isActive= ?',1)
						 ->join('user', 'user.id = comment.userId', ['username'=>'username','image'=>'image']);

		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage=5);

		return $dotPaginator->getData();
	}
	// this function will add comments to a certain product
	public function addCommentToCertainProduct($data, $loggedUser, $productId)
	{
		$select=$this->db->select()
						 ->from('comment' , new Zend_Db_Expr('COUNT(userId) as maxPostPerUser'))
						 ->where('userId= ?', $loggedUser)
						 ->where('productId= ?', $productId)
						 ->where('comment.isActive= ?',1);
		$result=$this->db->fetchAll($select);
		$maxPostPerUser=$result['0']['maxPostPerUser'];
		// this checks if the sum of the review from a user is 0. If it's zero it can add a review if it's 1 it can't
		if (intval($maxPostPerUser == 0)) {
			$this->db->insert('comment', $data);
		}
		return $maxPostPerUser;
	}
	// this function will edit a certain comment
	public function editCommentToCertainProduct($data,$commentId, $userId)
	{
        $where[]="commentId = $commentId";
        $where[]="userId = $userId";
		$this->db->update('comment', $data, $where);
	}
	// this function will delete a certain comment
	public function deleteCommentToCertainProduct($commentId,$userId)
	{
		$this->db->delete('comment', array("id = " . $commentId, 
											"userId = " . $userId));
	}
	// update function for like and dislike if no like or dislike create
	public function voteACertainComment($data, $id, $userId)
	{
		$select=$this->db->select()
						 ->from('likeElements')
						 ->where('commentId= ?',$id)
						 ->where('userId= ?',$userId);
		$result=$this->db->fetchOne($select);
		// insert function in case that the result doesn't exist
		if($result == false) {
			//insert
			$details= array('userId' => $userId,
							'ifLikeUnlike' => $data,
							'commentId' => $id
						   );
			$this->db->insert('likeElements', $details);
		} else {
			// without the $where users would stack when they had the same like quantity
			// this will update the likes if they exist
			$where[]="commentId = $id";
			$where[]="userId = $userId";
			$update=$this->db->update('likeElements',array('ifLikeUnlike' => $data), $where);
		}
	}
	// function that counts the likes
	public function sumLikesForComment()
	{
		$select = $this->db->select()
						   ->from('likeElements', new Zend_Db_Expr('SUM(ifLikeUnlike) as totalLike,commentId'))
						   // this groups the id's so that it doesn't dillute the result
						   ->group('commentId');
		$sum=$this->db->fetchAll($select);
		$finalData = [];
		// foreach for a better representation of the result
		foreach ($sum as $key => $value) {
			$finalData[$value['commentId']] = $value['totalLike'];
		}
		return $finalData;
	}
	// this shows the average of the rating
	public function averageRating($id)
	{
		$avg=$this->db->select()
					  ->from('comment', new Zend_Db_Expr('AVG(rating) as averageRating'))
					  ->where('productId= ?',$id);
		$average=$this->db->fetchAll($avg);
		$finalData = [];
		// foreach for a better representation of the result
		foreach ($average as $key => $value) {
			$finalData = $value['averageRating'];
		}
		return $finalData;
	}
	public function searchProduct($page = 1, $productName, $number)
	{
		$select=$this->db->select()
						 ->from('product')
						 ->where('name LIKE ?', "%{$productName}%");
		
		$result=$this->db->fetchAll($select); 
		
		$dotPaginator = new Dot_Paginator($select,$page,$number);
		return $dotPaginator->getData();
	}
	// this function will get the sum for one cart
	public function sumProductsFromCart($cartId) 
	{	
		$select=$this->db->select()
						 ->from('cartproduct', new Zend_Db_Expr('COUNT(id) as totalProducts'))
						 ->where('cartId= ?', $cartId);
		$result=$this->db->fetchAll($select);

		return ($result[0]['totalProducts']) ?? 0;
	}

    // this function will add products to the wishlist
    public function addProductToWishlist($productId, $userId, $valid)
    {
        // this is the given data to be inserted into the wishlist
        $dataProduct["productId"] = $productId;
        $dataProduct["userId"] = $userId;
        $dataProduct["ifWishlist"] = $valid;

        // this will search for the product in the wishlist and it will count it
        $select=$this->db->select()
            ->from('wishlist', new Zend_Db_Expr('COUNT(productId) as maxProductOnWishlist'))
            ->where('productId= ?', $productId)
            ->where('userId= ?', $userId);
        $result=$this->db->fetchAll($select);

        // this will add the product to the wishlist if it doesn't exist
        if ($result['0']['maxProductOnWishlist'] == 0) {
            $this->db->insert('wishlist', $dataProduct);
        }

        return $result['0']['maxProductOnWishlist'];
    }

    // this function will select product and id

    public function getTheWishlist($productId, $userId)
    {
        // this will show the wishlist for a certain product for a certain user
        $select=$this->db->select()
                         ->from('wishlist')
                         ->where('productId= ?', $productId)
                         ->where('userId= ?', $userId);
        $result=$this->db->fetchRow($select);

        // this will show that if your product is in the wishlist it will return 1 but if it does not it will return 0
        $details = $result['ifWishlist'] ?? $result['0'];
        return $details;
    }
}
