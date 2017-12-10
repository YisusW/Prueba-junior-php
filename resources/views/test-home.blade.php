@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listar Bancos</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                        <form action="" method="POST" role="form">
                            
                            <center><legend>Listar Bancos</legend></center>
                        
                            <div class="form-group">
                                <label for="">Opción de pago</label>
                                <select class="form-control">

                                    <option value="pse">PSE</option>

                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Tipo de cuenta</label>
                                <select class="form-control" name="type_count">
                                    <option value="hum">Personas</option>
                                    <option value="emp">Empresas</option>
                                </select>
                            </div>   

                            <div class="form-group">
                                                                
                                <label for="">Entidad Financiera</label>
                                <select class="form-control" name="bank">
                                 

                                 @if(isset($Bank))

                                 @foreach( $Bank as $banks )
                                    <option value="{{ $banks->bankCode }}" >{{ $banks->bankName }}</option>
                                 @endforeach
                                 @endif
                                
                                </select>
                            </div>                        
                            
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
