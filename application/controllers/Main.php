<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		ValidateSession();
		$this->load->model("main_model");
	}

	public function Index()
	{
		$data = new stdClass();
		$queryData = [intval($this->session->userdata("id"))];
		$data->tickets = $this->main_model->ExecuteSP("GetTicketsPorUsuario", $queryData);
		$data->estadisticas = $this->main_model->ExecuteSP("GetEstadisticasPorUsuario", $queryData);
		$data->nota = $this->main_model->ExecuteSP("GetNota", $queryData);
	
		$header = new stdClass();
		$header->page = "home";

		$footer = new stdClass();
		$footer->scripts = $this->load->view("scripts", ["scripts" => ['userTicket'] ], true);

		$this->load->view('header', $header);
		$this->load->view('main/main', $data);
		$this->load->view('footer', $footer);
	}

	public function Tickets()
	{
		$desde = $this->input->get("desde");
		$hasta = $this->input->get("hasta");
		$estado = $this->input->get("estado");
		$prioridad = $this->input->get("prioridad");
		$target = $this->input->get("target");

		if ($desde == "") $desde = Date("Y-m-d");
		if ($hasta == "") $hasta = Date("Y-m-d");
		if ($estado == "") $estado = "0";
		if ($prioridad == "") $prioridad = "0";
		
		$data = new stdClass();
		$queryData = [
			$desde,
			$hasta,
			intval($estado),
			intval($prioridad)
		];
		
		$data->tickets = $this->main_model->ExecuteSP("GetTickets", $queryData);
		$data->prioridades = $this->main_model->ExecuteSP("GetPrioridades");
		$data->estados = $this->main_model->ExecuteSP("GetEstados");
		$data->desde = $desde;
		$data->hasta = $hasta;
		$data->estado = $estado;
		$data->prioridad = $prioridad;
		$data->target = $target;

		$header = new stdClass();
		$header->page = "tickets";

		$footer = new stdClass();
		$footer->scripts = $this->load->view("scripts", ["scripts" => ['tickets'] ], true);

		$this->load->view('header', $header);
		$this->load->view('main/tickets', $data);
		$this->load->view('footer', $footer);
	}

	public function SetNota()
	{
		$nota = $this->input->post("nota");

		$queryData = [
			intval($this->session->userdata("id")),
			$nota
		];

		$response = $this->main_model->ExecuteSP("SetNota", $queryData);

		$return = new stdClass();
		$return->ban = 0;
		if(isset($response[0]->bandera))
		{
			$return->ban = $response[0]->bandera;
		}
		
		$return->csrfhash = $this->security->get_csrf_hash();

		$this->output
			->set_content_type('application/json')
        	->set_output( json_encode( $return ) );
	}

	public function UpdateTicket()
	{
		$id = $this->input->post("id");
		$responsable = $this->input->post("responsable");
		$interno = $this->input->post("interno");
		$terminal = $this->input->post("terminal");
		$email = $this->input->post("email");

		if($id == "") return;
		
		$queryData = [
			intval($id),
			intval($responsable),
			$interno,
			$terminal,
			$email,
			intval($this->session->userdata("id"))
		];

		$response = $this->main_model->ExecuteSP("UpdateTicket", $queryData);

		$return = new stdClass();
		$return->ban = 0;
		if (isset($response[0]->bandera)) {
			$return->ban = $response[0]->bandera;
		}

		$return->csrfhash = $this->security->get_csrf_hash();

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($return));
	}

	public function CerrarTicket()
	{
		$id = $this->input->post("id");
		$resolucion = $this->input->post("resolucion");

		if ($id == "") return;

		$queryData = [
			intval($id),
			$resolucion,
			intval($this->session->userdata("id"))
		];

		$response = $this->main_model->ExecuteSP("CerrarTicket", $queryData);

		$return = new stdClass();
		$return->ban = 0;
		if (isset($response[0]->bandera)) {
			$return->ban = $response[0]->bandera;
		}

		$return->csrfhash = $this->security->get_csrf_hash();

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($return));
	}

	public function ticket($id = "")
	{
		if($id == "")
		{
			http_response_code(400);
			return;
		}
	
		$data = new stdClass();
		$queryData = [intval($id)];

		$response = $this->main_model->ExecuteSP("GetTicket", $queryData);
		$data->ticket = $response[0];
		$data->observaciones = $this->main_model->ExecuteSP("GetObservacionesTicket", $queryData);
		$data->usuarios = $this->main_model->ExecuteSP("GetUsuariosTickets");
		$data->id = $id;

		$header = new stdClass();
		$header->page = "ticket";

		$footer = new stdClass();
		$footer->scripts = $this->load->view("scripts", ["scripts" => ['ticket'] ], true);

		$this->load->view('header', $header);
		$this->load->view('main/ticket', $data);
		$this->load->view('footer', $footer);
	}

	public function Nuevo()
	{
		// Loads
		$this->load->helper('form');
		$this->load->library('form_validation');

		// Validation rules
		$config = array(
			array(
				'field' => 'fecha',
				'label' => 'Fecha',
				'rules' => 'required'
			),
			array(
				'field' => 'hora',
				'label' => 'Hora',
				'rules' => 'required'
			),
			array(
				'field' => 'prioridad',
				'label' => 'Prioridad',
				'rules' => 'required'
			),
			array(
				'field' => 'tipo',
				'label' => 'Tipo',
				'rules' => 'required'
			),
			array(
				'field' => 'equipo',
				'label' => 'Equipo',
				'rules' => 'required'
			),
			array(
				'field' => 'categoria',
				'label' => 'Categoria',
				'rules' => 'required'
			),
			array(
				'field' => 'solicitante',
				'label' => 'Solicitante',
				'rules' => 'required|max_length[255]'
			),
			array(
				'field' => 'descripcion',
				'label' => 'Descripcion',
				'rules' => 'required|max_length[255]'
			),
			array(
				'field' => 'responsable',
				'label' => 'Responsable',
				'rules' => 'required'
			),
			array(
				'field' => 'sede',
				'label' => 'Sede',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config);
		
		$data = new stdClass();
		
		// Inputs
		$data->fecha = $this->input->post("fecha");
		$data->hora = $this->input->post("hora");
		$data->responsable = $this->input->post("responsable");
		$data->prioridad = $this->input->post("prioridad");
		$data->tipo = $this->input->post("tipo");
		$data->equipo = $this->input->post("equipo");
		$data->categoria = $this->input->post("categoria");
		$data->solicitante = $this->input->post("solicitante");
		$data->descripcion = $this->input->post("descripcion");
		$data->interno = $this->input->post("interno");
		$data->terminal = $this->input->post("terminal");
		$data->email = $this->input->post("email");
		$data->sector = $this->input->post("sector");
		$data->sede = $this->input->post("sede");

		$data->page = "nuevoticket";
		$data->prioridades = $this->main_model->ExecuteSP("GetPrioridades");
		$data->tipos = $this->main_model->ExecuteSP("GetTipos");
		$data->equipos = $this->main_model->ExecuteSP("GetEquipos");
		$data->categorias = $this->main_model->ExecuteSP("GetCategorias");
		$data->usuarios = $this->main_model->ExecuteSP("GetUsuariosTickets");
		$data->sectores = $this->main_model->ExecuteSP("GetSectores");
		$data->sedes = $this->main_model->ExecuteSP("GetSedes");

		$data->scripts = $this->load->view("scripts", ["scripts" => ['nuevoticket']], true);

		if ($this->form_validation->run() == false) 
		{
			$this->load->view('header', $data);
			$this->load->view('main/nuevo_ticket', $data);
			$this->load->view('footer', $data);
		}
		else
		{
			try
			{
				if($data->interno == "" && $data->email == "")
				{
					throw new Exception("Debe ingresar el interno y/o el email para poder continuar.");
				}

				$queryData = [
					intval($this->session->userdata("id")),
					intval($data->responsable),
					$data->solicitante,
					$data->descripcion,
					$data->fecha,
					$data->hora,
					$data->interno,
					$data->terminal,
					$data->email,
					intval($data->prioridad),
					intval($data->tipo),
					intval($data->equipo),
					intval($data->categoria),
					intval($data->sector),
					intval($data->sede)
				];

				$response = $this->main_model->ExecuteSP("SetTicket", $queryData);
				
				if(!isset($response[0]->id))
				{
					throw new Exception("No se ha podido grabar el ticket solicitado.");
				}

				$data->fecha = "";
				$data->hora = "";
				$data->responsable = "";
				$data->prioridad = "";
				$data->tipo = "";
				$data->equipo = "";
				$data->categoria = "";
				$data->solicitante = "";
				$data->descripcion = "";
				$data->interno = "";
				$data->terminal = "";
				$data->email = "";
				$data->sector = "";
				$data->sede = "";
				$data->ok = $response[0]->id;

				$this->load->view('header', $data);
				$this->load->view('main/nuevo_ticket', $data);
				$this->load->view('footer', $data);
			}
			catch (Exception $e)
			{
				$data->error = $e->getMessage();
				$this->load->view('header', $data);
				$this->load->view('main/nuevo_ticket', $data);
				$this->load->view('footer', $data);
			}
		}
	}

	public function Estadisticas()
	{
		$data = new stdClass();
		$data->page = "estadisticas";
		$data->scripts = $this->load->view("scripts", ["scripts" => ['Chart.bundle.min','estadisticas'] ], true);

		$this->load->view('header', $data);
		$this->load->view('reservas/estadisticas', $data);
		$this->load->view('footer', $data);
	}

	public function Administracion()
	{
		$data = new stdClass();
		$data->page = "administracion";

		$this->load->view('header', $data);
		$this->load->view('reservas/home');
		$this->load->view('footer');
	}
	
	public function SetObservacion()
	{
		$id = $this->input->post("id");
		$observacion = $this->input->post("observacion");
		if($id == "" || $observacion == "") return;

		$queryData = [intval($id), $observacion, intval($this->session->userdata("id"))];
		$return = $this->main_model->ExecuteSP("SetObservacion", $queryData);
		$return["csrfhash"] = $this->security->get_csrf_hash();

		$this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($return));
	}
	
	public function Exportar_tickets() {
		$desde = $this->input->get("desde");
		$hasta = $this->input->get("hasta");
		$estado = $this->input->get("estado");
		$prioridad = $this->input->get("prioridad");

		if ($desde == "") $desde = Date("Y-m-d");
		if ($hasta == "") $hasta = Date("Y-m-d");
		if ($estado == "") $estado = "0";
		if ($prioridad == "") $prioridad = "0";

		$queryData = [
			$desde,
			$hasta,
			intval($estado),
			intval($prioridad)
		];
		$tickets = $this->main_model->ExecuteSP("GetTickets", $queryData);

		$this->load->library('excel');
		$this->excel->to_excel($tickets, 'Tickets_' . $desde . '_' . $hasta);
	}
}
