@extends('master')
@section('css')
@endsection
@section('body')
<div class="container">
	<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Documentos</h3>
        </div>   
        <ul class="list-group">
            <li class="list-group-item">
                <div class="row toggle" data-toggle="detail-1">
                    <div class="col-xs-10">
                        <a class="navbar-brand" href="{{  url('/catastro') }}">Catastro</a>
                    </div>
                    <div class="col-xs-2"><i class="fa fa-chevron-down pull-right"></i></div>
                </div>
            </li>
        </ul>
	</div>
</div>
@endsection