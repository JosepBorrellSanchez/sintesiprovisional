<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productes extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('mod_productes');
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
	
	public function listcategories()
	{	
			
		$users ['query'] = $this->mod_categories->getCategoria();
		$this->load->view('list', $users);
	}

	public function crear()
	{
		$users ['query'] = $this->mod_categories->getCategoria();
		$this->load->view('afegir', $users); 
		
		
                $fullname = $this->input->post('fullname');
                $price = $this->input->post('price');
                $categoria = $this->input->post('categoria');
                if($fullname != null && $price != null)
                $this->mod_productes->insertProducte($fullname, $price, $categoria);
                
                
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
