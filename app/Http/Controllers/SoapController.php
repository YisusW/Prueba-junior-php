<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Cache;


class SoapController extends Controller
{
/**
   * @var SoapWrapper
   */
  protected $soapWrapper;
  
  protected $login;
  protected $tranKey;
  protected $seed;
  protected $additional;


  /**
   * SoapController constructor.
   *
   * @param SoapWrapper $soapWrapper
   */
  public function __construct( )
  {

    $this->login = '6dd490faf9cb87a9862245da41170ff2' ;

    $this->seed = date('c') ;

    $this->tranKey = sha1( $this->seed . '024h1IlD'  );

  }



    function servicio_banco ()
    {

		$servicio="https://test.placetopay.com/soap/pse/?wsdl"; //url del servicio
		$parametros=array(); //parametros de la llamada

		$parametros['login']=$this->login;
		$parametros['tranKey']=$this->tranKey;
		$parametros['seed']=$this->seed; 
		
		$client = new \SoapClient($servicio );
		$client->__setLocation('https://test.placetopay.com/soap/pse/');

		
		$minutos = 1440;

		$Bank = $client->getBankList( array( 'auth' => $parametros ) );//llamamos al métdo que nos interesa con los parámetros
		$Bank = Cache::remember( 'bankDay', $minutos, function () use ($Bank) {
	    	return $Bank;
		});

	
	return $this->parsearData( $Bank );
	}

    function verificar_service ( $key ){

    	return (Cache::has($key)) ;
    }


    function get_servicio ( $key ){

    	return  $this->parsearData( (Cache::get($key)) ) ;
    }    

    function parsearData ( $result_services ){

    	$datos = (array) $result_services;
            
            foreach ($datos as $key => $value) {
                 # code...

                $datos = (object) $value;
             }             
             foreach ($datos as $key => $value) {
                 # code...

                $datos = (object) $value;
             } 
             

    	return $datos ;
    }


}
