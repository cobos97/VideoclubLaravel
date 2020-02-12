@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-4">
            <img class="img-fluid" src="{{$pelicula->poster}}" style="height:500px"/>
        </div>
        <div class="col-sm-8">
            <h2> {{$pelicula->title}} </h2>
            Año: {{$pelicula->year}}<br>
            Director: {{$pelicula->director}}<br><br>
            <b>Resumen: </b> {{$pelicula->synopsis}}<br><br>
            <b>Estado: </b>
            @if($pelicula->rented)
                Pelicula actualmente alquilada <br><br>
                {{--<a style="color: white" class="btn btn-danger">Devolver película</a>--}}
                <form action="{{action('CatalogController@putReturn', $pelicula->id)}}" method="POST"
                      style="display:inline"> {{ method_field('PUT') }} {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger" style="display:inline"> Devolver película</button>
                </form>
            @else
                Película disponible <br><br>
                {{--<a style="color: white" class="btn btn-danger">Alquilar película</a>--}}
                <form action="{{action('CatalogController@putRent', $pelicula->id)}}" method="POST"
                      style="display:inline"> {{ method_field('PUT') }} {{ csrf_field() }}
                    <button type="submit" class="btn btn-success" style="display:inline"> Alquilar película</button>
                </form>
            @endif

            <a style="color: white" class="btn btn-warning" href="{{url('/catalog/edit/'.$pelicula->id)}}">
                <i class="fas fa-spin fa-pencil-alt" aria-hidden="true" style="color: white"></i>
                Editar película
            </a>

            <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="POST"
                  style="display:inline"> {{ method_field('DELETE') }} {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="display:inline"> Borrar película</button>
            </form>

            <a class="btn btn-light" href="{{url('/catalog')}}">
                <i class="fas fa-chevron-left" aria-hidden="true"></i>
                Volver al listado
            </a>

        </div>
    </div>

@endsection