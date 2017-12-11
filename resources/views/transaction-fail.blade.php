@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
           @if(isset($message))

                         

    <div class="span12">
      <div class="hero-unit center">
          
          <h1>{{ $message }}
          	<small><font face="Tahoma" color="red">Error</font></small>
          </h1>
          <br />
          <a href="{{ url('/') }}" class="btn btn-large btn-info">Volver</a>
       </div>
        <br />
        <br />
 
    </div>


                     
            @endif                       
                           
        </div>
    </div>
</div>
@endsection
