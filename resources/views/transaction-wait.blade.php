@extends('layouts.app')


@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-body">

                    

                    <form role="form">

                        <center><legend>Debug</legend></center>
                            

                    @if(isset($results->returnCode))

                    <div id="message" class="alert alert-warning" role="alert">
                        <strong>Estatus : Pendiente!</strong>
                        <br>
                         {{ $results->responseReasonText }}
                    </div>

                    <label for="">para proseguir con la transaccion  debes dar click en el boton ir</label><br>

                    <a id="url" href="{{ $results->bankURL }}" role="button" class="btn btn-success" target="_blank">
                        ir
                    </a>
                     
                    @endif                            
                                                        

                            @if(isset($results->bankURL))
                            <div class="form-group">
                                <label for="">Transacción Id</label>
                                <input type="numeric" 
                                name="idtransaction" 
                                class="form-control" 
                                value="{{$results->transactionID  }}"
                                readonly>
                            </div> 

                            <div class="form-group">
                                <label for="">trazabilityCode</label>
                                <input type="numeric" 
                                id="idtransaction" 
                                class="form-control" 
                                value="{{$results->trazabilityCode  }}"
                                readonly>
                            </div>

                            <div class="form-group">
                                <label for="">soliciteDate</label>
                                <input type="numeric" 
                                id="soliciteDate" 
                                class="form-control" 
                                value=""
                                readonly>
                            </div>

                            <div class="form-group">
                                <label for="">bankProcessDate</label>
                                <input type="numeric" 
                                id="bankProcessDate" 
                                class="form-control" 
                                value=""
                                readonly>
                            </div> 

                            
                            <div class="form-group">
                                <label for="">transactionState</label>
                                <select id="status" class="form-control" >
                                </select>
                            </div>                             

                            <div class="form-group">
                                <label for="">authorizationID</label>
                                
                                <input type="numeric" 
                                id="authorizationID" 
                                class="form-control" 
                                value=""\>
                            </div> 

                            

                            <input id="transactionid" type="hidden" name="transactionid" value="{{$results->transactionID  }}"  >
                            
                            @endif

                            <button id="query-manual" 
                            class="btn btn-primary"
                            >Call</button>

                            <button id="query-ppe" 
                            class="btn btn-primary"
                            > Return to PPE</button>
                            <br><br>

                        <div id="message-fresh" 

                            class="alert alert-danger" style="display:none">
                                
                        </div>

                        </form>

                    @if(isset($results->bankURL))


                    <a id="newurl" href="" role="button" class="btn btn-success" style="display:none"></a>
                     
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
   
        setInterval(hacer_verificacion_status, 300000); //300000 MS == 5 minutes
    
        $("#query-manual").click ( function (event) {

            event.preventDefault();

            hacer_verificacion_status();
        });

        $('#query-ppe').click(function(event) {
            /* Act on the event */
            event.preventDefault();

        });
    });


    function hacer_verificacion_status(){

        idTransaction = $("#transactionid").val();

        $.ajax({
            url: 'veri-transaction',
            type: 'GET',
            data: { idTransaction : idTransaction},
        })
        .done(function( response ) {
            console.log(response);
            
            if( response ){

                $("#message").fadeOut('slow');

                $("#message-fresh").html('<strong>Estatus : '+response.tag+'!</strong>'+
                        '<br>'+response.message);

                if(response.result.transactionState=='OK'){

                    $('#url').remove();
                    $("#query-manual").remove();
                }

                if( response.result.bankProcessDate ){

                    $('#soliciteDate').val(response.result.bankProcessDate);
                    $('#bankProcessDate').val(response.result.bankProcessDate);
                    
                    
                    $('#status').html('<option>'+response.result.transactionState+'</option>');
                    
                    $('#authorizationID').val(response.result.autorization);

                }
                $("#message-fresh").fadeIn('slow');
            }

        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
    
</script>

@endsection

