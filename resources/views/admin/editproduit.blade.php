@extends('layouts.appadmin')
@section('contenu')
@section('title')
    Editer produit
@stop
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Editer produit</h2>
                @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{ Session::get('status') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->All() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['action' => 'ProductController@modifierproduit', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentform', 'enctype' => 'multipart/form-data']) !!}
                {{ csrf_field() }}
                {{Form::hidden('id',$product->id)}}
                <div class="form-group">
                    {{ Form::label('', 'Nom du produit', ['for' => 'cname']) }}
                    {{ Form::text('product_name', $product->product_name, ['class' => 'form-control', 'id' => 'cname']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'Prix du produit', ['form' => 'cname']) }}
                    {{ Form::number('product_price', $product->product_price, ['class' => 'form-control', 'id' => 'cname']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'Catégorie du produit', ['for' => 'cname']) }}
                    {{ Form::select('product_category', $categories, $product->product_category, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'Image', ['for' => 'cname']) }}
                    {{ Form::file('product_image', ['class' => 'form-control', 'id' => 'cname']) }}
                </div>
                {{ Form::submit('Modifier', ['class' => 'btn btn-primary']) }}
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
