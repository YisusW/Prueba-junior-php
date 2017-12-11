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

  private function getService(){

		$servicio="https://test.placetopay.com/soap/pse/?wsdl"; //url del servicio
		
		$client = new \SoapClient( $servicio );

		$client->__setLocation('https://test.placetopay.com/soap/pse/');
		
		return  $client;

  }


  private function getAuth(){

		$parametros=array(); //parametros de la llamada

		$parametros['login']	= $this->login;
		$parametros['tranKey']	= $this->tranKey;
		$parametros['seed']		= $this->seed;

	return $parametros ;
  }
  	/*-----------------------------------------------------------------------
  	!
    !		- FUNCION PARA CONSUMIR SERVICIOS DE GET BANK LIST
    !
    ------------------------------------------------------------------------*/


    function servicio_banco ()
    {

		$client = $this->getService();
		
		$minutos = 1440;
    
    $Authentication = $this->getAuth() ;
		
    $Bank = $client->getBankList( array( 'auth' => $Authentication ) );//llamamos al métdo que nos interesa con los parámetros
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

  	/*-----------------------------------------------------------------------
    !
    !		- FUNCION PARA CONSUMIR SERVICIOS DE CREAR TRANSACCION
    !
    ------------------------------------------------------------------------*/

    function servicio_transaction ( $transaction_person )
    {


    $client = $this->getService();

    //$result = $client->getBankList( $this->getAuth() );
    $Authentication = $this->getAuth() ;
    
		$result = $client->createTransaction( array( 'auth' => $Authentication , 'transaction' => $transaction_person ) );//llamamos al métdo que nos interesa con los parámetros 
		
		return $result;
	}

  function procesar_peticion( $result ){
    
      $datos = (array) $result;
            
            foreach ($datos as $key => $value) {
                 # code...
                $datos = (object) $value;
             }             

      return $datos ;
  }


}
