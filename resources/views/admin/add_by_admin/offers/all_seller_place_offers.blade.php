@extends("layout.Cover")
@section("content")

@foreach($all_cat as $x1=>$cat)
    @if($cat->active_seller_place!=null && $cat->active_seller_place->count()>0)
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">عروض {{ $cat->title ??"ERROR 404"}}  </h5>

                        <!-- Default Accordion -->

                        @foreach($cat->active_seller_place as $x2=>$seller_place)
                            <a class="badge bg-success" href="{{route("view_add_offer_by_admin_for_seller",$seller_place->id)}}" style="margin-bottom: 10px">اضافة عروض تجارية</a>
                            ({{$seller_place->product_offers->count() ?? "ERROR"}})


                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$x1.$x2}}" aria-expanded="true" aria-controls="collapseOne">
                                            عروض التجارية التي يقدمها  {{$seller_place->title_of_place}}
                                        </button>
                                    </h2>
                                    <div id="collapseOne_{{$x1.$x2}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" style="direction: rtl">
                                            @if($seller_place->product_offers!=null&&$seller_place->product_offers->count()>0)
                                                <table class="table table-hover" >
                                                    <thead>
                                                    <tr style="background: #c2c3c6">
                                                        <th scope="col">#</th>
                                                        <th scope="col">المنتج</th>
                                                        <th scope="col">سعر المنتج القديم</th>
                                                        <th scope="col">سعر المنتج الجديد</th>
                                                        <th scope="col">الحالة</th>
                                                        <th scope="col">#</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($seller_place->product_offers as $offer)
                                                        <tr>
                                                            <th scope="row">{{$loop->iteration}}</th>
                                                            <td>{{$offer->product->title}}</td>
                                                            <td>{{$offer->product->price ?? "Error"}}-{{$offer->product->ex_price ?? "Error"}}</td>
                                                            <td>{{$offer->new_price_product ?? "Error"}}-{{$offer->ex_price ?? "Error"}}</td>
                                                            <td>@if($offer->state="1")
                                                                    <div class="alert alert-success badge">ساري المفعول</div>
                                                                @else
                                                                    <label class="alert alert-warning badge"> غير ساري المفعول</label>

                                                                @endif

                                                            </td>
                                                            <td><a class="btn btn-danger badge" href="{{route('delete_seller_offer_by_admin',$offer->id)}}">حذف</a></td>


                                                        {{--                                                    //<td>{{$offer->new_price_product}}</td>--}}



                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            @else
                                                <div CLASS="alert alert-danger"> No OFFERS !</div>
                                            @endif





                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>

                    @endforeach


                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif
    @endforeach
@endsection