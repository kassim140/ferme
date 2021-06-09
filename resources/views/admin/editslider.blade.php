@extends('layouts.appadmin')
@section('contenu')
@section('title')
    ajouter slider
@stop
<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Ajouter slider</h2>
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

                {!! Form::open(['action' => 'SliderController@modifierslider', 'method' => 'POST', 'class' => 'cmxform', 'id'
                 => 'commentform', 'enctype' => 'multipart/form-data']) !!}
                {{ csrf_field() }}
                {{Form::hidden('id',$sliders->id)}}
                <div class="form-group">
                    {{ Form::label('', 'Decription one', ['for' => 'cname']) }}
                    {{ Form::text('description1', $sliders->description1, ['class' => 'form-control', 'id' => 'cname']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'Description two', ['form' => 'cname']) }}
                    {{ Form::text('description2', $sliders->description2, ['class' => 'form-control', 'id' => 'cname']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('', 'Image', ['for' => 'cname']) }}
                    {{ Form::file('slider_image', ['class' => 'form-control', 'id' => 'cname']) }}
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
