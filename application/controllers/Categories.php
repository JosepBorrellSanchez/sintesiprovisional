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
	public function listusers()
	{	
			
		$users ['query'] = $this->users->getProducte();
		$this->load->view('list', $users);
	}

	public function crear()
	{
		
		$this->load->view('afegircategoria'); 
                $name = $this->input->post('name');
                $slug = $this->input->post('slug');
                if($name != null)
                $this->mod_categories->insertCategoria($name, $slug);
}
	public function modificar()
	{
		
		$this->load->view('modificar'); 
}
	public function eliminar($ID)
	{
                $this->users->deleteProducte($ID);
                $this->load->view('eliminar'); 
}

	public function grocery()
	{
		$this->load->view('example');
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
