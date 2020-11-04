<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->agent->is_robot())
		{
			show_error("Dispositivo desconocido.", 403, "Acceso denegado");
			die('Forbidden');
		}

		// Loads
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('main_model');
	}

	public function Index()
	{
		redirect('/');
	}

	public function Login()
	{	
		if ($this->session->userdata('id') != null) { redirect('/');}

		$data = new stdClass();
		$data->page = "login";
		$data->username = $this->input->post('user');
		$data->password = $this->input->post('pass');

		// rules
		$this->form_validation->set_rules('user', 'Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->load->view("header", $data);
			$this->load->view("user/login", $data);
			$this->load->view("footer", $data);
			return;
		}

		$queryData = [
			$data->username, 
			hash("SHA256", $data->password)
		];

		$loginData = $this->main_model->ExecuteSP("Login", $queryData );

		if (empty($loginData))
		{
			$data->error = "Usuario o Contraseña incorrecta";
			$this->load->view("header", $data);
			$this->load->view("user/login", $data);
			$this->load->view("footer", $data);
			return;
		}

		$newSessionData = array(
			'id' 		=> $loginData[0]->id_usuario,
			'user' 		=> $loginData[0]->user,
			'apellido' 	=> $loginData[0]->apellido,
			'nombre' 	=> $loginData[0]->nombre,
			'email' 	=> $loginData[0]->email,
			'activo'	=> $loginData[0]->activo,
			'rol'		=> $loginData[0]->poderes,
			'sistemas'	=> $loginData[0]->sistemas,
			'vigencia'  => $loginData[0]->vigencia
		);	

		$this->session->set_userdata($newSessionData);
		
		if(is_null($this->session->userdata('vigencia')))
		{
			redirect('/user/change_password');
		}
		else
		{
			
			if(strtotime($this->session->userdata('vigencia')) <= strtotime(date('Y-m-d'))) 
			{
				redirect('/user/change_password');
			}
			
			$last_page = $this->session->userdata('last_page');
			if ($last_page != null && $last_page != "") 
			{
				redirect($last_page);
			} 
			else 
			{
				redirect('/');
			}
		}
	}
	
	public function change_password()
	{
		if ($this->session->userdata('id') == null) { redirect('/');}

		$data = new stdClass();
		$data->page = "login";
		$data->pass = $this->input->post('pass');
		$data->rpass = $this->input->post('rpass');

		// rules
		$this->form_validation->set_rules('pass', 'Contraseña', 'min_length[8]|required');
		$this->form_validation->set_rules('rpass', 'Contraseña', 'required');

		if ($this->form_validation->run() == false) 
		{
			$this->load->view("header", $data);
			$this->load->view("user/change_password", $data);
			$this->load->view("footer", $data);
		}
		else
		{
			try
			{
				if($data->pass != $data->rpass)
				{
					throw new Exception("Las contraseñas no coinciden.");
				}

				$queryData = [
					intval($this->session->userdata('id')),
					hash("SHA256", $data->pass)
				];

				$return = $this->main_model->ExecuteSP("UpdatePassword", $queryData);

				if(empty($return)) {
					throw new Exception("Se produjo un error al cambiar la contraseña.");
					return;
				}
				
				if(!isset($return[0]->ban))
				{
					throw new Exception("Se produjo un error al cambiar la contraseña.");
					return;
				}
				
				redirect("user/logout");
			}
			catch (Exception $e)
			{
				$data->error = $e->getMessage();
				$this->load->view('header', $data);
				$this->load->view('user/change_password', $data);
				$this->load->view('footer', $data);
			}
		}

	}

	public function forgot_password()
	{
		if ($this->session->userdata('id') != null) { redirect('/'); }

		$data = new stdClass();
		$data->page = "login";
		$data->username = $this->input->post('username');
		$data->email = $this->input->post('email');

		// rules
		$this->form_validation->set_rules('username', 'Contraseña', 'required');
		$this->form_validation->set_rules('email', 'Contraseña', 'required');

		if ($this->form_validation->run() == false)
		{
			$this->load->view("header", $data);
			$this->load->view("user/forgot_password", $data);
			$this->load->view("footer", $data);
		}
		else
		{
			try
			{
				$newpass = GetRandomString();
				
				$queryData = [
					$data->username,
					$data->email,
					hash("SHA256", $newpass)
				];

				$return = $this->main_model->ExecuteSP("BlanquearPassword", $queryData);

				if (empty($return))
				{
					throw new Exception("Usuario y/o email incorrecto.");
					return;
				}

				if (!isset($return[0]->ban))
				{
					throw new Exception("Usuario y/o email incorrecto.");
					return;
				}
				
				$this->enviarPassword($data->email, $newpass, $data->username);
				$data->ok = true;
				
				$this->load->view('header', $data);
				$this->load->view('user/forgot_password', $data);
				$this->load->view('footer', $data);
			}
			catch (Exception $e)
			{
				$data->error = $e->getMessage();
				$this->load->view('header', $data);
				$this->load->view('user/forgot_password', $data);
				$this->load->view('footer', $data);
			}
		}
	}

	private function enviarPassword($destino, $pass, $user)
	{
		$this->load->library('email');

		$data = array(
			'password' => $pass,
			'usuario' => $user
		);

		$mensaje = $this->load->view('user/mail_password', $data, true);

		$this->email->clear();

		$this->email->to($destino);
		$this->email->from('info@laslomas.com.ar', "Sanatorio Las Lomas");
		$this->email->subject('Contraseña Restablecida');
		$this->email->message($mensaje);
		$this->email->send();

		$this->email->print_debugger();
	}

	public function Logout()
	{
		if ($this->session->userdata('id') != null)
		{
			$this->session->sess_destroy();
		}

		redirect("/");
	}
}

?>