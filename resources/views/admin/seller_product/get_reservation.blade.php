
    @extends("layout.Cover")
    @section("content")
        <section class="section dashboard">
            <div class="row">

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
                                            <th scope="col">رقم الحجز</th>
                                            <th scope="col">الفترة المحجوزة</th>
                                            <th scope="col">تم الحجز بواسطة</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->orders as $order)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{$order->order_uuid}}</td>
                                                <td>{{$order->period->title}}</td>
                                                <td>ali</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->
                    </div></div></div></section>

@endsection
