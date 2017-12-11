@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listar Bancos</div>

                <div class="panel-body">

                    @if($errors->has('message'))

                    <div class="alert alert-success" role="alert">
                        <strong>Bien</strong>
                         {{ $errors->first('message') }}
                    </div>
                     
                    @endif

                    @if (!isset($Bank))
                    <div class="alert alert-warning"  role="alert">
                        <strong>Atencion</strong>
                         no se pudo obtener la lista de entidades financieras, por favor intente más tarde
                     </div>

                    @endif
                    

                        <form action="create-transaction" method="POST" role="form">
                            {{ csrf_field() }}
                            
                            <center><legend>Metodo de Pago</legend></center>
 

                            <div class="form-group">
                                <label for="">Medio de pago</label>
                                <select class="form-control" name="metodo" >

                                    <option value="_PSE_">Débito a cuentas corrientes y ahorros (PSE)</option>
                                    
                                </select>
                            </div>

                            @if($errors->has('document'))

                            <input type="hidden" name="persona_identidad" value="{{ $errors->first('document') }}">

                            @endif
                            <div class="form-group">
                                <label for="">Tipo de persona</label>
                                <select class="form-control" name="bankInterface" required="true">
                                    <option value="0">Personas</option>
                                    <option value="1">Empresas</option>
                                </select>
                            </div>   

                            <div class="form-group">

                                <label for="">Entidad Financiera</label>
                                <select class="form-control is-invalid" name="bankCode" required="true">
                                 

                                 @if(isset($Bank))

                                 @foreach( $Bank as $banks )
                                    <option value="{{ $banks->bankCode }}" >{{ $banks->bankName }}</option>
                                 @endforeach
                                                                  
                                 @endif
                                
                                </select>
                                

                            </div>                        
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
