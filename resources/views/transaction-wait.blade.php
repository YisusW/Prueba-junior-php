@extends('layouts.app')


@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pagina de Espera</div>

                <div class="panel-body">

                    

                    <form role="form">

                        <center><legend>Esperando Estatus</legend></center>
                            

                        <div id="message-fresh" 
                            class="alert alert-success" style="display:none">
                                
                        </div>

                    @if(isset($results->returnCode))

                    <div id="message" class="alert alert-success" role="alert">
                        <strong>Estatus : Pendiente!</strong>
                        <br>
                         {{ $results->responseReasonText }}
                    </div>
                     
                    @endif                            
                                                        

                            @if(isset($results->bankURL))
                            <input id="transactionid" type="hidden" name="transactionid" value="{{$results->transactionID  }}" >
                            
                            @endif

                            <button id="query-manual" 
                            class="btn btn-primary"
                            type="reset">
                            consultar estatus</button>

                        </form>

                    @if(isset($results->bankURL))

                    <label for="">para proseguir con la transaccion  debes dar click aqui</label><br>
                    
                    <a href="{{ $results->bankURL }}" role="button" class="btn btn-default" target="_blank">
                        ir
                    </a>
                     
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        alert()    
        setInterval(hacer_verificacion_status, 300000); //300000 MS == 5 minutes
    
        $("#query-manual").click(function(event) {
            
            hacer_verificacion_status();
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

