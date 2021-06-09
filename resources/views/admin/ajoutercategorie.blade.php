@extends('layouts.appadmin')
@section('contenu')
@section('title')
    ajouter catégorie
@stop
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Ajouter catégorie</h2>
                @if (Session::has('status'))
                    <div class=" alert alert-success">
                        {{ Session::get('status') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['action' => 'CategoryController@sauvercategorie',
                   'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentform']) !!}
                {{ csrf_field() }}
                <div class="form-group">
                    {{ Form::label('', 'Nom de la categorie', ['for' => 'cname']) }}
                    {{ Form::text('category_name', '', ['class' => 'form-control', 'id' => 'cname']) }}
                </div>
                {{ Form::submit('Ajouter', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script>
@endsection
