@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a href="{{route('admin.reporte')}}">Reportes</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    GESTIÓN DE REPORTES<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert bg-green alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Genere los diferentes reportes de la productividad académica de los docentes.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_MODULOS'))
                    <a href="{{route('reportes.acta')}}" class="btn bg-light-green waves-effect">
                        <div><span>GENEREAR ACTA</span><span class="ink animate"></span></div>
                    </a>  
                    @endif
                    @if(session()->exists('PAG_PAGINAS'))
                    <a href="{{route('reportes.productividad')}}" class="btn bg-light-green waves-effect">
                        <div><span>PRODUCTIVIDAD</span><span class="ink animate"></span></div>
                    </a>  
                    @endif
                    @if(session()->exists('PAG_GRUPOS-ROLES'))
                    <a href="{{route('grupousuario.index')}}" class="btn bg-light-green waves-effect">
                        <div><span>PRODUCTIVIDAD POR ESTADO</span><span class="ink animate"></span></div>
                    </a>  
                    @endif
                    @if(session()->exists('PAG_PRIVILEGIOS'))
                    <a href="{{route('grupousuario.privilegios')}}" class="btn bg-light-green waves-effect">
                        <div><span>PRODUCTIVIDAD POR DOCENTE</span><span class="ink animate"></span></div>
                    </a>  
                    @endif
                    @if(session()->exists('PAG_USUARIOS'))
                    <a href="{{route('usuario.index')}}" class="btn bg-light-green waves-effect" data-toggle="tooltip" data-placement="top" title="Tenga en cuenta que al cargar gran cantidad de registros puede hacer que el navegador se bloquee y deba esperar a que este cargue todos los registros de la base de datos para continuar la navegación.">
                        <div><span>POR TIPO DE PRODUCTIVIDAD</span><span class="ink animate"></span></div>
                    </a> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection