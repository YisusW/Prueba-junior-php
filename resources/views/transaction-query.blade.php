@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ver estado de la transacción</div>

                <div class="panel-body">

                    @if($errors->has('message'))

                    <div class="alert alert-danger" role="alert">
                        <strong>Estatus : {{ $errors->first('tag') }}!</strong>
                         {{ $errors->first('message') }}
                    </div>
                     
                    @endif
                    

                        <form action="{{  url('buscar-transaction-document')  }}" method="POST" role="form">
                            {{ csrf_field() }}
                            
                            <center><legend>Bucar Transacción - Documento</legend></center>
 

                            <div class="form-group">
                                <label for="">Tipo de documento de identificación</label>
                                <select class="form-control" name="tipoidentificacion">
                                        <option value="CC" >Cédula de ciudanía colombiana</option>
                                        <option value="CE" >Cédula de extranjería</option>
                                        <option value="TI" >Tarjeta de identidad</option>
                                        <option value="PPN" >Pasaporte</option>
                                        <option value="NIT" >Número de identificación tributaria</option>
                                        <option value="SSN" >Social Security Number</option>
                                </select>
                            </div>         

                            <div class="form-group">
                                <label for="">Número de identificación</label>
                                <input type="numeric" name="identificacion" class="form-control" autofocus>
                            </div> 
                       
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                            Consultar por persona 
                            </button>
                            </div>

                        </form>


                        <form action="{{  url('buscar-transaction-id')  }}" method="POST" role="form">
                            {{ csrf_field() }}
                            
                            <center><legend>Bucar Transacción - ID</legend></center>
    

                            <div class="form-group">
                                <label for="">Transacción ID</label>
                                <input type="numeric" name="transactionid" class="form-control" >
                            </div> 
                       
                            
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                            Consultar ID
                            </button>
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
