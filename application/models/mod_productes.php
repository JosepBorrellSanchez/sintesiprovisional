<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_productes extends CI_Model{


    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function getProducte(){
		
		$query=$this->db->get('wp_posts');
		
		return $query;
	}
	
	
	
	function insertProducte($fullname, $price, $categoria){
		
		//array del producte (inserto producte)
        $data = array(
        'post_title'=> $_POST['fullname'],
        'post_type'=> 'al_product');
        $this->db->insert('wp_posts', $data);
        $idproducte = $this->db->insert_id(); //agafo la id del producte que acabo de insertar
                
        //array del preu del producte (inserto preu)
        $insertarpreu = array(
        'post_id' => $idproducte,
        'meta_key'=> '_price',
        'meta_value'=> $_POST['price']);
        $this->db->insert('wp_postmeta', $insertarpreu);
        
        //inserto el producte a la categoria
        /*
        $this->db->select('term_taxonomy_id');
		$this->db->from('wp_terms AS A');
		$this->db->join('wp_term_taxonomy AS B', 'A.term_id = B.term_id');
		$this->db->where('B.taxonomy = "al_product-cat"');
		$this->db->where('A.name ="bolleria"');
		$categoria = $this->db->get()->term_taxonomy_id;*/
		$query = $this->db->query('SELECT term_taxonomy_id FROM wp_terms AS A join wp_term_taxonomy AS B ON A.term_id = B.term_id where B.taxonomy = "al_product-cat" AND A.name ='.$_POST["categoria"]);
		foreach ($query->result() as $row)
		$categoria = $row->term_taxonomy_id;

        $insertcategoria = array(
        'object_id'=> $idproducte,
        'term_taxonomy_id'=> $categoria);
        $this->db->insert('wp_term_relationships', $insertcategoria);
        
        
        return ($this->db->affected_rows() > 0) ? false : true; //si ha afectat a algun registre ha funcionat, sino no.
        
	}
	
	
	function deleteProducte($actor_id)
    {
       $this->db->delete('producte', array('id_producte' => $ID));
     
    }
}

?>
    
    
