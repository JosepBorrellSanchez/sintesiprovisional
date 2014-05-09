<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('mod_categories');
        $this->load->helper('url');
    }
// fer un vector i recorrel en lo for each, ha de portar 
// l'objecte persona 
	public function llistar()
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
		
		
		$this->load->view('afegircategoria'); 
                $name = $this->input->post('name');
                $url = $name;
                //$slug = $this->input->post('slug');
                $descripcio = $this->input->post('descripcio');
                $url = urls_amigables($url);
                if($name != null)
                $this->mod_categories->insertCategoria($name, $url, $descripcio);
}

	function json()
    {
        $data['json'] = $this->mod_categories->getCategories();
        if (!$data['json']) show_404();

        $this->load->view('json_view', $data);
    }
    
	public function modificar($term_id)
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
		
		$this->load->view('modificarcategoria'); 
		$name = $this->input->post('name');
                $url = $name;
                //$slug = $this->input->post('slug');
                $descripcio = $this->input->post('descripcio');
                $url = urls_amigables($url);
                if($name != null)
                $this->mod_categories->modificar($term_id, $name, $url, $descripcio);
}
	public function borrar($ID)
	{
                $this->mod_categories->borrar($ID);
                //com actualitzo la taula?
                $this->load->view('list'); 
}

	public function grocery()
	{
		$this->load->view('example');
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
