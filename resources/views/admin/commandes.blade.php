@extends('layouts.appadmin')
@section('title')
    Commandes
@stop
{{Form::hidden('', $increment = 1)}}
@section('contenu')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Commandes</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Nom du client</th>
                                            <th>Addresse</th>
                                            <th>Panier</th>
                                            <th>Paymen id</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$increment}}</td>
                                            <td>{{$order->nom}}</td>
                                            <td>{{$order->adresse}}</td>
                                            <td>
                                                @foreach ($order->panier->items as $item)
                                                {{$item['product_name'].' , '}}
                                                    
                                                @endforeach
                                            </td>
                                            <td>{{$order->payement_id}}</td>
                                            <td>
                                                <button class="btn btn-outline-primary"
                                                 onclick="window.location ='{{url('/voir_pdf/'.$order->id)}}'">View
                                                </button>
                                            </td>
                                        </tr>
                                        {{Form::hidden('', $increment = $increment +1)}}
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
