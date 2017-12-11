@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Subscripcion</div>

                <div class="panel-body">

                    
                    <form action="subscrption-save" method="POST" role="form">
                            {{ csrf_field() }}
                            
                        <center><legend>Datos Persona</legend></center>
                            

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
                                <label for="">Nombres</label>
                                <input type="text" name="firstname" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Correo electrónico</label>
                                <input type="email" name="emailAddress" class="form-control">
                            </div>    

                            <div class="form-group">
                                <label for="">Dirección postal completa</label>
                                <textarea name="direccion" class="form-control" ></textarea>
                            </div>
                                                  
                            <div class="form-group">
                                <label for="">Nombre de la ciudad</label>
                                <input name="city" class="form-control" >
                            </div>
                             
                            <div class="form-group">
                                <label for="">Nombre de la provincia</label>
                                <input name="provincie" class="form-control" >
                            </div>
                            
                            <div class="form-group">
                                <label for="">Número de telefonía fija</label>
                                <input name="phone" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label for="">Número de telefonía móvil o celular</label>
                                <input name="movie" class="form-control" >
                            </div>
                        <button type="submit" class="btn btn-primary" >Guardar</button>
                        <button type="reset" class="btn btn-default" >Cancelar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


