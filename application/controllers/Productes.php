<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productes extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        
        $this->load->model('mod_categories');
        $this->load->model('mod_productes');
        $this->load->helper('url');
    }
// fer un vector i recorrel en lo for each, ha de portar 
// l'objecte persona 
	public function llistar()
	{	
		$users ['query'] = $this->mod_productes->getProducte();
		$this->load->view('llistaproductes', $users);
		
	}
	
	public function listcategories()
	{	
		$users ['query'] = $this->mod_categories->getCategoria();
		$this->load->view('list', $users);
	}

	public function crear()
	{
		function urls_amigables($url) {
			// Tranformamos todo a minusculas
			$url = strtolower($url);
			//Rememplazamos caracteres especiales latinos
			$find = array('á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù', 'ñ');
			$repl = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n');
			$url = str_replace ($find, $repl, $url);
			// Añaadimos los guiones
			$find = array(' ', '&', '\r\n', '\n', '+'); 
			$url = str_replace ($find, '-', $url);
			// Eliminamos y Reemplazamos demás caracteres especiales
			$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
			$repl = array('', '-', '');
			$url = preg_replace ($find, $repl, $url);
			return $url;
}

		$users ['query'] = $this->mod_categories->getCategoria();
		$this->load->view('afegir', $users); 
		
		
                $fullname = $this->input->post('fullname');
                $price = $this->input->post('price');
                $categoria = $this->input->post('categoria');
                $descripcio = $this->input->post('descripcio');
                //$count = $users->count;
                if($fullname != null && $price != null){
                $url = $fullname;
                $url = urls_amigables($url);
                $this->mod_productes->insertProducte($fullname, $price, $categoria, $descripcio, $url);}
                
                
}
	public function modificar($ID)
	{
		function urls_amigables($url) {
			// Tranformamos todo a minusculas
			$url = strtolower($url);
			//Rememplazamos caracteres especiales latinos
			$find = array('á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù', 'ñ');
			$repl = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n');
			$url = str_replace ($find, $repl, $url);
			// Añaadimos los guiones
			$find = array(' ', '&', '\r\n', '\n', '+'); 
			$url = str_replace ($find, '-', $url);
			// Eliminamos y Reemplazamos demás caracteres especiales
			$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
			$repl = array('', '-', '');
			$url = preg_replace ($find, $repl, $url);
			return $url;
}
		$users ['query'] = $this->mod_categories->getCategoria();
		$this->load->view('modificarproductes', $users); 
				$fullname = $this->input->post('fullname');
                $price = $this->input->post('price');
                $categoria = $this->input->post('categoria');
                $descripcio = $this->input->post('descripcio');
                //$count = $users->count;
                if($fullname != null && $price != null){
                $url = $fullname;
                $url = urls_amigables($url);
                $this->mod_productes->modificar($ID, $fullname, $price, $categoria, $descripcio, $url);
			}
}
	public function borrar($ID)
	{
                $this->mod_productes->borrar($ID);
                //com actualitzo la taula?
                $this->load->view('llistaproductes'); 
}


	public function grocery()
	{
		$this->load->view('example');
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
