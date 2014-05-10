<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_productes extends CI_Model{


    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function getProducte(){
		
		/*
		 * SELECT a.ID, a.post_title AS nom, b.meta_value AS descripcio, c.meta_value AS preu, a.post_name AS link
FROM wp_posts a, wp_postmeta b
JOIN wp_postmeta c ON c.post_id = b.post_id
WHERE a.post_type = "al_product"
AND c.meta_key = "_price"
AND b.meta_key = "_desc"
AND b.post_id = a.ID
LIMIT 0 , 30
* */

		$this->db->select('a.ID');
		$this->db->select('a.post_title as nom');
		$this->db->select('b.meta_value as descripcio');
		$this->db->select('c.meta_value as preu');
		$this->db->select('a.post_name as link');
		$this->db->from('wp_posts AS a');
		$this->db->from('wp_postmeta AS b');
		$this->db->join('wp_postmeta AS c', 'c.post_id = b.post_id');
		$this->db->where('a.post_type = "al_product"');
		$this->db->where('c.meta_key', '_price');
		$this->db->where('b.meta_key','_desc');
		$this->db->where('b.post_id = `a`.`ID`');
		$query=$this->db->get();
		
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
        'meta_value'=> $price);
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
        
        /*
        //miro quans productes hi ha per mostraru despues
        $this->db->select('count(*)');
        $this->db->from('wp_term_relationships');
        $this->db->where('term_taxonomy_id',$categoria);
        $count = array(
        'count'=>$this->db->get()->row('count(*)'));
        
            
		$this->db->where('term_taxonomy_id', $categoria);
        $this->db->update('wp_term_taxonomy', $count);
        */
        
        
        return ($this->db->affected_rows() > 0) ? false : true; //si ha afectat a algun registre ha funcionat, sino no.
        
	}
	
	
	function borrar($ID)
    {
       $this->db->delete('wp_posts', array('ID' => $ID));
       $this->db->delete('wp_postmeta', array('post_id' => $ID));
       $this->db->delete('wp_term_relationships', array('object_id' => $ID));
       
     
    }
    
    function modificar($ID, $fullname, $price, $categoria, $descripcio, $url)
    {
				
		//array del producte (modifico producte)
        $data = array(
        'post_title'=> $fullname,
        'post_name'=> $url);
        $this->db->where('ID',$ID);
        $this->db->update('wp_posts', $data);
        
        //array del preu del producte (modifico preu)
        $modpreu = array(
        'meta_value'=> $price);
        $this->db->where('post_id',$ID);
        $this->db->where('meta_key','_price');
        $this->db->update('wp_postmeta', $modpreu);
        
        //array de la descripcio del producte (modifico descripcio)
        $moddescripcio = array(
        'meta_value'=> $descripcio);
        $this->db->where('post_id',$ID);
        $this->db->where('meta_key','_desc');
        $this->db->update('wp_postmeta', $moddescripcio);
		
		//modifico la categoria
        $insertcategoria = array(
        'term_taxonomy_id'=> $categoria);
        $this->db->where('object_id',$ID);
        $this->db->update('wp_term_relationships', $insertcategoria);
				
		//miro quans productes hi ha per mostraru despues
        $this->db->select('count(*)');
        $this->db->from('wp_term_relationships');
        $this->db->where('term_taxonomy_id',$categoria);
        $count = array(
        'count'=>$this->db->get()->row('count(*)'));
        
            
		$this->db->where('term_taxonomy_id', $categoria);
        $this->db->update('wp_term_taxonomy', $count);
		
		
	}
}

?>
    
    
