<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class HomeController extends Controller
{

    private $client  ;

    #private $redirect = 'https://registro.pse.com.co/PSEUserRegister/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->client = new SoapController();
    }

    private function getTransaction(){

       return new TransactionController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        if(! $this->client->verificar_service( 'bankDay' ) ){
            # El Servicio no se ha consumido aun!
            $Bank =  (object) $this->client->servicio_banco();

            return view('test-home')->with(compact('Bank'));
            
        } 
        else 
        {
            # El Servicio esta en CACHE su key es  'bankDay'
            $Bank =  (object) $this->client->get_servicio( 'bankDay' );
            
            return view('test-home')->with(compact('Bank')); 

        }
        
    } 

    public function getthisperson( $document ){

        return Person::where('document' , $document )->get([
            'documentType',
            'document',
            'firstName',
            'lastName',
            'emailAddress',
            'address',
            'city',
            'province',
            'country',
            'phone',
            'mobile'])->first()->toArray();
    }

    public function confirmacion_form( Request $request ){

        $persona = $this->getthisperson( $request->persona_identidad );
        
        $tras = array('bankCode' => $request->bankCode,
        
        'bankInterface' => $request->bankInterface ,
        
        'returnURL' => 'https://registro.pse.com.co/PSEUserRegister/' ,
        
        'reference' => 'Referencia única de pago',
        
        'description' => 'pruebas desde yisus-dev',
        
        'language' => 'es',
        
        'currency' => 'COP',
        
        'totalAmount' =>    (float)1000.0,
        
        'taxAmount' =>      (float)500.0,
        
        'devolutionBase' => (float)250.0,
        
        'tipAmount' =>      (float)250.0,
        
        'payer' =>   $persona,
        
        'buyer' =>   $persona,
        
        'shipping' =>$persona,
        
        'ipAddress' => $_SERVER['SERVER_ADDR'] ,
        
        'userAgent' => $_SERVER['HTTP_USER_AGENT'] );

        $results = $this->client->servicio_transaction( $tras );

        $results = $this->client->procesar_peticion( $results );

        $transaction = $this->getTransaction();

        $transaction->store( $results );

        return view('test-home')->name('booth');

    }
}
