@extends("layout.Cover")
@section("content")
    <div class="pagetitle">
        <h1>اضافة منتجات للمحلات التجارية</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    @foreach($categorys as $x=>$category)
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$category->title}}</h5>

                        <!-- Default Accordion -->




                            @if($category->seller_place!=null && $category->seller_place->count()>0)



                                            @foreach($category->seller_place->where("state","=","1") as $place)
                                                <div class="col-lg-12">

                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$place->title_of_place}}</h5>
                                                            <div class="row">
                                                                <div class="col-xl-9"> <h6>عدد المنتجات التي يقدمها </h6>
                                                                    {{$place->products_seller->count()}}
                                                                </div>
                                                                <div class="col-xl-3"><a href="{{route('view_for_add_product',$place->id)}}"><span class="btn btn-success">اضافة منتج جديد</span> </a> </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach




                            @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
    <hr>
    @endforeach




    {{--    @foreach($categorys as $x=>$category)--}}


{{--        @if($category->active_seller_place!=null && $category->active_seller_place->count()>0)--}}

{{--                            @foreach($category->active_seller_place as $place)--}}
{{--                                <div class="col-lg-12">--}}

{{--                                    <div class="card">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <h5 class="card-title">{{$place->title_of_place}}</h5>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-xl-9"> <h6>عدد المنتجات التي يقدمها </h6>--}}
{{--                                                    {{$place->products_seller->count()}}--}}
{{--                                                </div>--}}
{{--                                                <div class="col-xl-3"><a href="{{route('view_for_add_product',$place->id)}}"><span class="btn btn-success">اضافة منتج جديد</span> </a> </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

{{--        @endif--}}
{{--        @endforeach--}}



@endsection
