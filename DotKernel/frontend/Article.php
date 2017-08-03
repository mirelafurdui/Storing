<?php

class Article extends Dot_Model 
{
	public function getArticleList(){
		$select = $this->db->select()
							->from('article');
		$result = $this->db->fetchAll($select);
		return $result;
	}

	//Get one article from DB by id
	public function getArticleById($id)
	{
		
		$select = $this->db->select()
							->from('article')
							->where('id = ?',$id);
							$result = $this->db->fetchRow($select);
		//Zend_Debug::dump($result,$label = null, $echo = true);
		return $result;
		//var_dump($result);
	}	
}