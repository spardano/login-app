@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection



<head>
    <title>Input Tandatangan Legal</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
  
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
  
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
  
</head>


@section('main-content') 

@include('alert-session')



   <div class="row">
       <div class="col-md-6 offset-md-3 mt-5">
           <div class="card">
               <div class="card-header">
                   <h5>Silahkan Tulis Tanda Tangan Legal Anda </h5>
               </div>
               <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('signaturepad.upload') }}">
                        @csrf
                        <div class="col-md-12">
                            <label class="" for="">Signature:</label>
                            <br/>
                            <div id="sig" ></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
               </div>
           </div>
       </div>
   </div>



<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>


@endsection

@section('bottom-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="http://gull-html-laravel.com/assets/js/modal.script.js"></script>
@endsection