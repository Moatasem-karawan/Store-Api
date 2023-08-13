@extends("layout.Cover")
@section("content")
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Default Accordion</h5>

                        <!-- Default Accordion -->
                        @foreach($pools as $x=>$pool)

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$x}}" aria-expanded="true" aria-controls="collapseOne">
                                          حجوزات    {{$pool->title}}
                                        </button>
                                    </h2>
                                    <div id="collapseOne_{{$x}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="direction: rtl">
                                            @if($pool->reservation->count()>0)
                                                <div class="table-responsive-lg">

                                                <table class="table table-hover" >
                                                    <thead>
                                                    <tr style="background: #c2c3c6">
                                                        <th scope="col">#</th>
                                                        <th scope="col">رقم الحجز</th>
                                                        <th scope="col">حالة الدفع</th>
                                                        <th scope="col">تاريخ الحجز</th>
                                                        <th scope="col">نوع الحجز</th>
                                                        <th scope="col">التسعير</th>
                                                        <th scope="col">تم بواسطة</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($pool->reservation as $item)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$item->order_uuid}}</td>
                                                            <td>
                                                                @if($item->state_pay=="0")
                                                                    <label class="text-danger"> غير مدفوعJawaal pay </label>
                                                                    @elseif($item->state_pay=="1")

                                                                        <label class="text-success">مدفوع Jawaal pay</label>
                                                                @elseif($item->state_pay=="2")
                                                                    <label class="text-warning">CASH PAY</label>
                                                                    @else
                                                                    <label class="text-danger">ERROR</label>

                                                                @endif

                                                            </td>
                                                            <td>{{$item->date_reservation}}</td>
                                                            <td>@if($item->state_pool_order=="1")
                                                                    <label class="text-danger">خارجي من صفحة التاجر-{{$item->period->title ?? "ERROR"}}-({{$item->price_order ?? "ERROR"}} ₪ )</label>

                                                                @else
                                                                    <label class="text-success"> حجز عن طريق التطبيق -{{$item->period->title ?? "ERROR"}}-({{$item->price_order ?? "ERROR"}} ₪ )</label>

                                                                @endif

                                                            </td>

                                                            <td>{{$item->state_price_order ?? "Error"}}</td>


                                                            <td>@if(is_null($item->user_id))
                                                                    <label class="text-danger">صاحب المكان</label>
                                                                @else
                                                                    <label class="text-success"> User</label>

                                                                @endif</td>


                                                        {{--                                                    //<td>{{$offer->new_price_product}}</td>--}}



                                                    @endforeach
                                                    </tbody>

                                                </table>
                                                </div>
                                            @else
                                                <div CLASS="alert alert-danger"> لايوجد حجوزات سابقة !</div>
                                            @endif





                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>

                    @endforeach<!-- End Default Accordion Example -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection