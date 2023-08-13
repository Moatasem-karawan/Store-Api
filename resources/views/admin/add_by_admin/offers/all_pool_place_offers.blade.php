@extends("layout.Cover")
@section("content")
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">العروض المميزة المقدمة من قبل الشاليهات</h5>

                    <!-- Default Accordion -->
                    @foreach($the_pools_places as $x=>$pool_place)
                       <a class="badge bg-success" href="{{route("add_temp_pools_offers",$pool_place->id)}}" style="margin-bottom: 10px">اضافة عروض تجارية</a>
                         ({{$pool_place->offer_periods->count()}})

                        <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$x}}" aria-expanded="true" aria-controls="collapseOne">
                                    عروض التجارية التي يقدمها  {{$pool_place->title}}
                                </button>
                            </h2>
                            <div id="collapseOne_{{$x}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="direction: rtl">

                                    @if($pool_place->offer_periods->count()>0)
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr style="background: #c2c3c6">
                                            <th scope="col">#</th>
                                            <th scope="col">الفترة المعروضة</th>
                                            <th scope="col">سعر القديم</th>
                                            <th scope="col">سعر الجديد</th>
                                            <th scope="col">الحالة</th>
                                            <th scope="col">#</th>

                                        </tr>
                                        </thead>
                                        <tbody>


                                            @foreach($pool_place->offer_periods as $offer)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$offer->period_pivot->the_period->title}}</td>
                                                    <td>{{$offer->period_pivot->price}}</td>
                                                    <td>{{$offer->new_price}}</td>
                                                    <td>@if($offer->state="1")
                                                            <div class="alert alert-success badge">ساري المفعول</div>
                                                            @else
                                                            <label class="alert alert-warning badge"> غير ساري المفعول</label>

                                                        @endif

                                                    </td>
                                                    <td><a class="btn btn-danger badge" href="{{route('delete_pool_offer_by_admin',$offer->id)}}">حذف</a></td>


                                                {{--                                                    //<td>{{$offer->new_price_product}}</td>--}}



                                            @endforeach
                                        </tbody>

                                    </table>
                                        @else
                                        <div CLASS="alert alert-danger"> لايقدم اي عروض تجارية!</div>
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