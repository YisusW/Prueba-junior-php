<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class personController extends Controller
{
    //

	protected $model ;

	public function __construct(){

	}

	private function getInstanceHome(){
		return new HomeController();
	}

	public function index(){

		return view('subscripcion');

	}
	
	public function store(Request $request){


		$this->model = new Person();

		$this->model->documentType = $request->tipoidentificacion;
		$this->model->document = $request->identificacion;
		$this->model->firstName = $request->firstname;
		$this->model->lastName = $request->apellidos;
		$this->model->emailAddress = $request->emailAddress;
		$this->model->address = $request->direccion;
		$this->model->city = $request->city;
		$this->model->province = $request->provincie;
		$this->model->country = '';
		$this->model->phone = $request->phone;
		$this->model->mobile = $request->phone;

		$message ; 

		if($this->model->save()){

			$document = $this->model->document; 

			$message ='Los datos fueron guardados correctamente';

			return redirect('/home')->withErrors(compact('message','document'));

		}else{

			$message ='Los sentimos, los datos no fueron guardados';

			return view('subscripcion')->with('message');
		}


		
	}
}
