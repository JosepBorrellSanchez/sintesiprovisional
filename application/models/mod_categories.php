<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_Categories extends CI_Model{


    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function getProducte(){
		
		$query=$this->db->get('wp_posts');
		
		return $query;
	}
	
	function getCategoria(){
		$this->db->select('term_taxonomy_id');
		$this->db->from('wp_terms AS A');
		$this->db->join('wp_term_taxonomy AS B', 'A.term_id = B.term_id');
		$this->db->where('B.taxonomy = "al_product-cat"');
		$query = $this->db->get();
		
		//fer un array en los ID de categoria per a despues recorrel i actualitzar los counts..
		foreach ($query->row() as $categoria) {
        $this->db->select('count(*)');
        $this->db->from('wp_term_relationships');
        $this->db->where('term_taxonomy_id',$categoria);
        $count = array(
        'count'=>$this->db->get()->row('count(*)'));
	
        
            
		$this->db->where('term_taxonomy_id', $categoria);
        $this->db->update('wp_term_taxonomy', $count);
        
        
        
	}
		/*
		$this->db->select('*')
		$this->db->from('wp_terms AS A');
		$this->db->join('wp_term_taxonomy AS B', 'A.term_id = B.term_id');
		$this->db->where('B.taxonomy = "al_product-cat"');
		$query = $this->db->get();*/
		/* SELECT name
FROM `wp_terms` AS a
JOIN `wp_term_taxonomy` AS b
WHERE b.taxonomy = 'al_product-cat'
AND a.term_id = b.term_id
LIMIT 0 , 30
* */

$this->db->select('*');
		$this->db->from('wp_terms AS A');
		$this->db->join('wp_term_taxonomy AS B', 'A.term_id = B.term_id');
		$this->db->where('B.taxonomy = "al_product-cat"');
		$query = $this->db->get();
		
		return $query;
	}
	
	function getCategories(){
		$this->db->select('*');
		$this->db->from('wp_terms AS A');
		$this->db->join('wp_term_taxonomy AS B', 'A.term_id = B.term_id');
		$this->db->where('B.taxonomy = "al_product-cat"');
		$query = $this->db->get();
		/* SELECT name
FROM `wp_terms` AS a
JOIN `wp_term_taxonomy` AS b
WHERE b.taxonomy = 'al_product-cat'
AND a.term_id = b.term_id
LIMIT 0 , 30
* */

		return $query->result();
	}
	
	function getCategoriesjson(){
		$this->db->select('A.term_id');
		$this->db->select('name');
		$this->db->select('slug');
		$this->db->select('description');
		$this->db->from('wp_terms AS A');
		$this->db->join('wp_term_taxonomy AS B', 'A.term_id = B.term_id');
		$this->db->where('B.taxonomy = "al_product-cat"');
		$query = $this->db->get();
		/* SELECT name
FROM `wp_terms` AS a
JOIN `wp_term_taxonomy` AS b
WHERE b.taxonomy = 'al_product-cat'
AND a.term_id = b.term_id
LIMIT 0 , 30
* */

		return $query->result();
	}
	
	
	
	function insertCategoria($name, $url, $descripcio){
		//inserto la categoria (wp-terms)
        $data = array(
        'name'=> $name,
        'slug'=> $url);
        $this->db->insert('wp_terms', $data);
        
        //inserto la descripcio i la taxonomia (wp_term_taxonomy)
        $iddelatre = $this->db->insert_id();
        $algo = array(
        'term_id' => $iddelatre,
        'taxonomy'=> 'al_product-cat',
        'description'=>$descripcio);
        $this->db->insert('wp_term_taxonomy', $algo);
        return ($this->db->affected_rows() > 0) ? false : true; //si ha afectat a algun registre ha funcionat, sino no.
	}
	
	
	function borrar($ID)
    {
       $this->db->delete('wp_terms', array('term_id' => $ID));
       $this->db->select('term_taxonomy_id');
       $this->db->from('wp_term_taxonomy');
       $this->db->where('term_id',$ID);
       $xd = $this->db->get();
       $this->db->delete('wp_term_taxonomy', array('term_id' => $ID));
       $this->db->delete('wp_term_relationships', array('term_taxonomy_id' => $xd->row()->term_taxonomy_id));
       
     
    }
    function modificar($term_id, $name, $url, $descripcio)
    {
		
		$data = array('name' => $name,
					  'slug' => $url);
		$this->db->where('term_id',$term_id);
		$this->db->update('wp_terms', $data);
		
		
		$algo = array(
        'description'=>$descripcio);
        $this->db->where('term_id',$term_id);
        $this->db->update('wp_term_taxonomy', $algo);
		
		
		
	}
    
}

?>
    
    
