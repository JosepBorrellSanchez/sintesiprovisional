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

		return $query;
	}
	
	
	function insertCategoria($name, $slug, $descripcio){
		//inserto la categoria (wp-terms)
        $data = array(
        'name'=> $name,
        'slug'=> $slug);
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
	
	
	function deleteProducte($actor_id)
    {
       $this->db->delete('producte', array('id_producte' => $ID));
     
    }
}

?>
    
    
