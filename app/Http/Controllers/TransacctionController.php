<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;

class TransacctionController extends Controller
{

    private $client  ;

    #private $redirect = 'https://registro.pse.com.co/PSEUserRegister/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private function getSoapClient()
    {
       $this->client = new SoapController();
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('transaction-query');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $datos , $persona_id )
    {
        //
        $instance = new Transactions();

        $instance->returnCode    = $datos->returnCode;
        $instance->bankURL = $datos->bankURL;
        $instance->transactionID = $datos->transactionID;
        $instance->sessionID = $datos->sessionID;
        $instance->bankFactor = $datos->bankFactor;
        $instance->trazabilityCode = $datos->trazabilityCode;
        $instance->responseCode = $datos->responseCode;  
        $instance->responseReasonText = $datos->responseReasonText;
        $instance->persons_id = $persona_id;

        if( $instance->save() ){

             return true;
        }else{

             return false;
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request , Transactions $transactions)
    {
        //
        $id = \App\Person::where( 'document', $request->identificacion )
        ->where( 'documentType', $request->tipoidentificacion )
        ->get(['id'])->first()->id;
                

        $idtransacction = $transactions->where('persons_id' , $id)->get(['transactionID'])->first()->transactionID;

        $this->getSoapClient();

        $result = $this->client->servicio_status_transaction( $idtransacction );

        $tag= $result->transactionState;
       
        $message= $result->responseReasonText;

        return view('transaction-query')
            ->withErrors(compact('message' , 'tag'));

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function showown( Request $request , Transactions $transactions)
    {
        //
        $idtransacction = $transactions->where('transactionID' , $request->transactionid)->get(['transactionID'])->first()->transactionID;

        $this->getSoapClient();

        $result = $this->client->servicio_status_transaction( $idtransacction );

        $tag= $result->transactionState;
        
        $message= $result->responseReasonText;

        return view('transaction-query')
            ->withErrors(compact('message' , 'tag'));
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function getStatusThis( Request $request , Transactions $transactions)
    {
        //

        $idtransacction = $request->idTransaction ;

        $this->getSoapClient();

        $result = $this->client->servicio_status_transaction( $idtransacction );

        $this->update( $result );

        $result->autorization = 12;

        if( $result->transactionState == 'NOT_AUTHORIZED' ){

            $result->autorization = 0001;
        }

        $tag = $result->transactionState;
        
        $message= $result->responseReasonText;


            return response()->json([ 
                'tag' => $tag, 
                'message' => $message , 
                'result' => $result
             ]);
        

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update( $datos )
    {
        //
        
        $instance = Transactions::where( 'transactionID', $datos->transactionID )->get()->first();

        $instance->trazabilityCode = $datos->trazabilityCode;
        $instance->responseCode = $datos->responseCode;  
        $instance->responseReasonText = $datos->responseReasonText;
        
        $instance->update() ;
  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
