@extends("layout.Cover")
@section("content")

    <section class="section dashboard">
        <div class="row">


            <!-- Left side columns -->
            <div class="col-lg-12">


{{--                   @foreach($categorys as $category)--}}
{{--                       @if($category->active_product->count()>0)--}}

{{--                        <center><a href="{{route('show_all_products',$category->id)}}"><h3>({{$category->title}}) <li class="bi bi-arrow-up-right-circle-fill"></li></h3></a></center>--}}
{{--                        <div class="row">--}}
{{--                        @foreach($category->active_product()->orderBy("explorer","DESC")->take(3)->get() as $seller_product)--}}
{{--                        <div class="col-xxl-4 col-md-6">--}}

{{--                            <div class="card info-card sales-card">--}}

{{--                                <div class="filter">--}}
{{--                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>--}}
{{--                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
{{--                                        <li class="dropdown-header text-start">--}}
{{--                                            <h6>Filter</h6>--}}
{{--                                        </li>--}}

{{--                                        <li><a class="dropdown-item" href="#">Today</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">This Month</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">This Year</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}

{{--                                <div class="card-body">--}}
{{--                                    <h5 class="card-title"> {{$seller_product->owner->name}}  مالك  {{$seller_product->title}} <h6>| {{$loop->iteration}}</h6></h5>--}}

{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">--}}
{{--                                            <i class="bi bi-people text-success"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="ps-3">--}}
{{--                                            <h6>{{$seller_product->explorer}} </h6>--}}
{{--                                             <span class="text-muted small pt-2 ps-1">مرة تم حجز هذا المكان</span>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                            @endforeach--}}
{{--                           <hr/>--}}
{{--                        @endif--}}

{{--                       @endforeach<!-- End Sales Card -->--}}

                            <div class="card">
                                <div class="card-body" style="direction: rtl">
                                    <u><h5 class="card-title">استفسارات المستخدمين</h5></u>

                                    <!-- Table with hoverable rows -->
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr style="background: #128C7E">
                                            <th scope="col">#</th>
                                            <th scope="col">الرسالة</th>
                                            <th scope="col">رقم المرسل</th>
                                            <th scope="col">واتساب</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       @foreach($msgs as $msg)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$msg->msg}}</td>
                                            <td>{{$msg->phone}}</td>
                                            <td><a href="https://wa.me/{{$msg->phone}}?text={{$msg->msg}}"><li class="bi bi-whatsapp text-success"></li></a></td>
                                        </tr>
                                           @endforeach

                                        </tbody>
                                    </table>
                                    <!-- End Table with hoverable rows -->

                                </div>
                            </div>




                </div></div></section>
    @endsection
