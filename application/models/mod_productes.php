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
	
	
	
	function insertProducte($fullname, $price, $categoria, $descripcio, $url){
		
		//array del producte (inserto producte)
        $data = array(
        'post_title'=> $fullname,
        'post_name'=> $url,
        'post_type'=> 'al_product');
        $this->db->insert('wp_posts', $data);
        $idproducte = $this->db->insert_id(); //agafo la id del producte que acabo de insertar
                
        //array del preu del producte (inserto preu)
        $insertarpreu = array(
        'post_id' => $idproducte,
        'meta_key'=> '_price',
        'meta_value'=> $_POST['price']);
        $this->db->insert('wp_postmeta', $insertarpreu);
        
        //array de la descripcio del producte (inserto descripcio)
        $insertardescripcio = array(
        'post_id' => $idproducte,
        'meta_key'=> '_desc',
        'meta_value'=> $descripcio);
        $this->db->insert('wp_postmeta', $insertardescripcio);
        
        //inserto el producte a la categoria
        $insertcategoria = array(
        'object_id'=> $idproducte,
        'term_taxonomy_id'=> $categoria);
        $this->db->insert('wp_term_relationships', $insertcategoria);
        
        //miro quans productes hi ha per mostraru despues
        
        $this->db->select('count(*)');
        $this->db->from('wp_term_relationships');
        $this->db->where('term_taxonomy_id',$categoria);
        $count = array(
        'count'=>$this->db->get()->row('count(*)'));
        
            
		$this->db->where('term_taxonomy_id', $categoria);
        $this->db->update('wp_term_taxonomy', $count);
        
        
        
        return ($this->db->affected_rows() > 0) ? false : true; //si ha afectat a algun registre ha funcionat, sino no.
        
	}
	
	
	function deleteProducte($actor_id)
    {
       $this->db->delete('producte', array('id_producte' => $ID));
     
    }
}

?>
    
    
