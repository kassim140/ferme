@extends('layouts.appadmin')
@section('title')
    Produits
@stop
@section('contenu')
    {{ Form::hidden('', $increment = 1) }}
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Produits</h4>
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Image</th>
                                    <th>Nom du produit</th>
                                    <th>Catégorie du produit</th>
                                    <th>Prix</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $increment }}</td>
                                        <td><img src="/storage/product_images/{{ $product->product_image }}"
                                                alt="{{ $product->product_image }}"> </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_category }}</td>
                                        <td>${{ $product->product_price }}</td>
                                        @if ($product->status == 1)
                                            <td>
                                                <label class="badge badge-success">Active</label>
                                            </td>
                                        @else
                                            <td>
                                                <label class="badge badge-danger">Désactivé</label>
                                            </td>
                                        @endif
                                        <td>

                                            <button class="btn btn-outline-primary">View</button>

                                            <button class="btn btn-outline-primary"
                                                onclick="window.location ='{{ url('/editproduit/' . $product->id) }}'">edit</button>
                                            <a href="{{ url('/deleteproduct/' . $product->id) }}" id="delete"
                                                class="btn btn-outline-danger">Delete</a>

                                            @if ($product->status == 1)
                                                <button class="btn btn-outline-warning"
                                                    onclick="window.location ='{{ url('/desactiveproduit/' . $product->id) }}'">
                                                    <a
                                                        href="{{ url('/desactiveproduit/' . $product->id) }}">Désactiver</a>
                                                </button>
                                            @else
                                                <button class="btn btn-outline-success"
                                                    onclick="window.location ='{{ url('/activeproduit/' . $product->id) }}'">
                                                    <a
                                                        href="{{ url('/activeproduit/' . $product->id) }}">Activer</a></button>

                                            @endif
                                        </td>
                                    </tr>
                                    {{ Form::hidden('', $increment = $increment + 1) }}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="backend/js/data-table.js"></script>
@endsection
