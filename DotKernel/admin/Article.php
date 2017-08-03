<?php

class Article extends Dot_Model
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	public function getArticleList($page = 1){
		$select = $this->db->select()
							->from('article');
		//$result = $this->db->fetchAll($select);
		$dotPaginator = new Dot_Paginator($select,$page,$this->settings->resultsPerPage);
		return $dotPaginator->getData();
	}

	public function addArticleDb($data){
		$this->db->insert('article',$data);
	}

	public function updateArticleDb($data,$id){
		$this->db->update('article',$data, 'id = '.$id);		
	}
	public function deleteArticle($id){
		$this->db->delete('article','id = '.$id);		
	}

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
	