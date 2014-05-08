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
		
		$this->load->view('afegircategoria'); 
                $name = $this->input->post('name');
                $slug = $this->input->post('slug');
                $descripcio = $this->input->post('descripcio');
                if($name != null)
                $this->mod_categories->insertCategoria($name, $slug, $descripcio);
}

	function json()
    {
        $data['json'] = $this->mod_categories->getCategories();
        if (!$data['json']) show_404();

        $this->load->view('json_view', $data);
    }
    
	public function modificar()
	{
		
		$this->load->view('modificar'); 
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
