<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $client  ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->client = new SoapController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(! $this->client->verificar_service( 'bankDay' ) ){

            $Bank =  (object) $this->client->servicio_banco();

            return view('test-home')->with(compact('Bank'));
            
        } 
        else 
        {
            $Bank =  (object) $this->client->get_servicio( 'bankDay' );

            return view('test-home')->with(compact('Bank')); 

        }

        
    }
}
