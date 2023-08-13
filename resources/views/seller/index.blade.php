@extends("layout.Cover")
@section("content")




    <section class="section dashboard">
        <div class="card" style="direction: rtl">
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown" style="font-size: 20px"><i class="bi bi-three-dots text-success"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                    </li>

                   @if($seller->place!=null)
                        <li class="dropdown-header text-start">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="payment_after_delivery" value="{{$seller->place->delivery_state}}" onclick="change_states()" @if($seller->place->delivery_state=="1") checked @endif>
                                @if($seller->place->delivery_state=="0")
                               <label class="form-check-label text-danger" for="payment_after_delivery" id="lable_lable" >لانوفر الدفع بعد التوصيل</label>
                                    @elseif($seller->place->delivery_state=="1")
                                    <label class="form-check-label text-success" for="payment_after_delivery" id="lable_lable" >نوفر الدفع بعد التوصيل</label>
                                    @else
                                    <label > ERROR </label>

                                @endif
                            </div>
                        </li>

                        <hr>
                    @endif

                </ul>

            </div>
            <br>


            <div class="card-body pb-0">


                <h5 class="card-title">{{$seller->category->title??"ERROR 404"}} &amp;  <span class="text-success">| {{$seller->place->title_of_place??"لم يتم اضفة المشروع الخاص بك"}}</span></h5>

                <div class="news">

                    @if($seller->place!=null)

                        <div class="post-item clearfix">
                            <img src="{{asset("all_files/".$seller->place->img->url)}}" alt="">
                            <div class="row">
                                <div class="col-xl"><h4><a href="#">{{$seller->place->description_of_place??"لم يتم اضفة المشروع الخاص بك"}}</a></h4></div>
                                <div class="col-xl" ><u><h6 class="text-danger"></h6></u></div>
                            </div>

                            <hr>
                            @if($seller->place!=null)
                            ايام العمل
                            ({{$seller->place->time_work}})
                            <div class="row">

                                @foreach($seller->place->days as $item)
                                <div class="col-3" ><u><h6 class="text-danger">{{$item->day}}</h6></u></div>
                                    @endforeach

                            </div>
                                @endif
                        </div>
                        <hr/>

                        @else
                        <div class="alert alert-danger">لا يوجد منتجات خاصة بك</div>
                        @endif

                </div><!-- End sidebar recent posts-->

            </div>
        </div><!-- End News & Updates -->



                            <div class="card">
                                <div  style="direction: rtl ;padding: 10px">
                                    ملاحظة يتم قبول اي طلب تم دفعة الكترونيا
                                    <u><h5 class="card-title text-success " >طلبات التوصيل (المقبولة-مدفوع الكترونيا) </h5></u>

                                    <!-- Table with hoverable rows -->
                                    <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered " >
                                        <thead>
                                        <tr style="background: #c9c9c9" >
                                            <th scope="col">#</th>
                                            <th scope="col">رقم الطلب</th>
                                            <th scope="col">المنتج</th>
                                            <th scope="col">الكمية</th>
                                            <th scope="col">التكلفة</th>
                                            <th scope="col" style="min-width: 200px">المكان</th>
                                            <th scope="col">حالة الدفع</th>
                                            <th scope="col">حالة الطلب</th>
                                            <th scope="col">المستخدم</th>
                                            <th scope="col">عمليات</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($seller->place!=null&&$orders=$seller->place->orders!=null)
                                     @foreach($seller->place->orders->where("accept_order","=","1") as $order)

                                         <tr>
                                         <td>{{$loop->iteration}}</td>
                                         <td>{{$order->order_uuid}}</td>
                                         <td>{{$order->product_seller->title}}</td>
                                         <td>{{$order->ex_price_order}}</td>
                                         <td>{{$order->price_order ."  " ."شكيل" ?? "ERROR"}}<br>{{$order->state_price_order ?? "ERROR"}}</td>
                                         <td>{{$order->location_description}}-<a href="https://www.google.com/maps/@31.4471777,34.4053569,13z" ><i class="bx bx-location-plus "></i> </a> </td>
{{--                                         stat pay--}}
                                         <td>
                                             @if($order->state_pay=="0")
                                                 <div class="alert alert-danger badge ">لم يتم الدفع</div>
                                             @elseif($order->state_pay=="1")
                                                 <div class="alert alert-success badge ">تم الدفع jawwal pay</div>
                                             @elseif($order->state_pay=="2")
                                                 <div class="alert alert-warning badge ">الدفع بعد الاستلام</div>

                                                 @else
                                                 <div class="alert alert-danger badge ">Error404</div>
                                             @endif
                                         </td>

{{--                                         stat order--}}
                                         <td>
                                             @if($order->state_order=="1")
                                                 <div class="alert alert-success badge ">جاري التوصيل</div>
                                         @else
                                                 <div class="alert alert-danger badge ">لم يتم التوصيل</div>
                                             @endif
                                         </td>
                                         <td>{{$order->user->name}}-{{$order->user->phone}}</td>
                                         <td>
                                             @if($order->state_order=="0")
                                         <a class="btn btn-danger badge" href="{{route("order_done",$order->id)}}">تم التجهيز</a>
                                                 @else
                                                 <span class="btn btn-success badge" >الطلب جاهز!</span>
                                                 <a class="btn btn-warning badge" href="{{route("order_backed_off",$order->id)}}">تراجع</a>
                                             @endif



                                         </td>

                                         </tr>
                                            @endforeach
                                            @else
                                            <div class="alert alert-warning">لم يصل اي طلب</div>
                                            @endif
                                        </tbody>
                                    </table>
                                    </div>
                                    <!-- End Table with hoverable rows -->

                                </div>
                            </div>
        <div class="card">
            <div  style="direction: rtl ;padding: 10px">
                <u><h5 class="card-title text-danger">طلبات التوصيل المعلقة (دفع عند الاستلام) </h5></u>

                <!-- Table with hoverable rows -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered " >
                        <thead>
                        <tr style="background: #c9c9c9" >
                            <th scope="col">#</th>
                            <th scope="col">رقم الطلب</th>
                            <th scope="col">المنتج</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">التكلفة</th>
                            <th scope="col" style="min-width: 200px">المكان</th>
                            <th scope="col">حالة الدفع</th>
                            <th scope="col">حالة الطلب</th>
                            <th scope="col">المستخدم</th>
                            <th scope="col">عمليات</th>


                        </tr>
                        </thead>
                        <tbody>
                        @if($seller->place!=null&&$orders=$seller->place->orders!=null)
                            @foreach($seller->place->orders->where("accept_order","=","0") as $order)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$order->order_uuid}}</td>
                                    <td>{{$order->product_seller->title}} <br> {{$order->count_ex}} {{$order->name_ex}}</td>
                                    <td>{{$order->state_price_order ?? "ERROR"}}</td>
                                    <td>{{$order->price_order ."  " ."شكيل" ?? "ERROR"}}<br>{{$order->ex_price_order}}</td>
                                    <td>{{$order->location_description}}-<a href={{"https://www.google.com/maps/@x.yz"}} ><i class="bx bx-location-plus "></i> </a> </td>
                                    {{--                                         stat pay--}}
                                    <td>
                                        @if($order->state_pay=="0")
                                            <div class="alert alert-danger badge ">لم يتم الدفع</div>
                                        @elseif($order->state_pay=="1")
                                            <div class="alert alert-success badge ">تم الدفع jawwal pay</div>
                                        @elseif($order->state_pay=="2")
                                            <div class="alert alert-warning badge ">الدفع بعد الاستلام</div>

                                        @else
                                            <div class="alert alert-danger badge ">Error404</div>
                                        @endif
                                    </td>

                                    {{--                                         stat order--}}
                                    <td>
                                        @if($order->state_order=="1")
                                            <div class="alert alert-success badge ">جاري التوصيل</div>
                                        @else
                                            <div class="alert alert-danger badge ">لم يتم التوصيل</div>
                                        @endif
                                    </td>
                                    <td>{{$order->user->name}}-{{$order->user->phone}}</td>
                                    <td>
                                        @if($order->state_order=="0")
                                            <a class="btn btn-danger badge" href="{{route("order_done",$order->id)}}">تم التجهيز</a>
                                        @else
                                            <span class="btn btn-success badge" >الطلب جاهز!</span>
                                            <a class="btn btn-warning badge" href="{{route("order_backed_off",$order->id)}}">تراجع</a>
                                        @endif



                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <div class="alert alert-warning">لم يصل اي طلب</div>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- End Table with hoverable rows -->

            </div>
        </div>





    </section>



    <!-- Basic Modal -->


















    @if($seller->place!=null)
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        <script>
        id_seller_place='{{$seller->place->id}}';
        function change_states() {
            btn=document.getElementById("payment_after_delivery");
            if (btn.value=="0"){
                lable=document.getElementById('lable_lable');
                lable.innerText="نوفر الدفع بعد الاستلام";
                lable.className="form-check-label text-success";
                btn.value="1";
                $.ajax({
                    type: 'post',
                    url: '{{route('change_state_place')}}',
                    data: {
                        '_token':"{{csrf_token()}}",
                        'state': btn.value,

                    },});
            }
            else if(btn.value=="1"){

                lable=document.getElementById('lable_lable');
                lable.innerText="لا نوفر الدفع بعد الاستلام";
                lable.className="form-check-label text-danger";

                btn.value="0";
                $.ajax({
                    type: 'post',
                    url: '{{route('change_state_place')}}',
                    data: {
                        '_token':"{{csrf_token()}}",
                        'state': btn.value,

                    },});

            }
            else{

            }
        }


    </script>
@endif

@endsection
