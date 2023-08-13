
@extends("layout.Cover")
@section("content")
    <section class="section dashboard">
        <div class="row">

            <h1>{{$seller_place->title_of_place}} المنتجات التي يقدمها </h1>
            <hr/>
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-12 col-md-12">
                        <div class="card info-card sales-card">

                            <div class="card-body"style="padding: 10px;direction: rtl">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">المنتج</th>
                                        <th scope="col">السعر</th>
                                        <th scope="col">عددالطلبات المنتج</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($seller_place->products_seller as $product)
                                        <tr>
                                            <th scope="row">1</th>

                                            <td>{{$product->title}}</td>
                                            <td>{{$product->price }} شيكل -{{$product->ex_price}}</td>
                                            @if($product->orders_product!=null)
                                                <td>{{$product->orders_product->count()}}</td>

                                                @else
                                                <td>0</td>
                                                @endif

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->
                </div></div></div></section>

@endsection
