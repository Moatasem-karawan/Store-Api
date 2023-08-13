@extends("layout.Cover")
@section("content")
    <?php $x=0;?>
    <center> <h1 class="txt">قائمة مشاريع النشطة والغير نشطة </h1></center>

        @if($seller_place->where("state","1")->count()>0)
            <?php
            $x++;
            ?>

            <div class="card">
                <div class="card-body" style="direction: rtl;padding: 15px">
                    <center> <u><h5 class="alert alert-success">قائمة مشاريع {{$category->title}} في الحالة الفعالة</h5></u></center>


                    <!-- Table with hoverable rows -->
                    <div class="table-responsive-lg">

                    <table class="table table-bordered border-secondary" >
                        <thead>
                        <tr style="background: #d1d2d5">
                            <th scope="col">#</th>
                            <th scope="col">اسم المصلحة</th>
                            <th scope="col">معلومات</th>
                            <th scope="col">المالك</th>
                            <th scope="col">فترات العمل - والاسعار</th>
                            <th scope="col"> عدد المنتجات التي يعرضها هذا المحل </th>
                            <th scope="col"> الحجوزات</th>
                            <th scope="col">الحالة</th>
                            <th scope="col">ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($seller_place->where("state","1") as $place_active)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$place_active->title_of_place}}</td>
                                <td>{{$place_active->seller_man->email}}
                                    <br>
                                    {{$place_active->seller_man->re_password ?? "ERROR"}}
                                    (  {{$place_active->region->region ?? "ERROR"}} -  {{ $place_active->area->area ?? "ERROR" }}  )
                                </td>

                                <td>{{$place_active->seller_man->name}}</td>
                                <td>
                                    ({{$place_active->time_work}})-
                                    @foreach($place_active->days as $day)
                                        {{$day->day}}
                                        @endforeach

                                </td>
                                <td>{{$place_active->products_seller->count()}}</td>
                                <td>{{$place_active->explorer}} مرة تم حجز هذا المشروع </td>
                                <td><label class="text-success"> نشط</label> </td>

                                <td>
                                    <div class="row">

                                        <div class="col-xl">
                                            <a href="{{route('sleep_seller_place',$place_active->id)}}" class="badge bg-warning">تعليق</a>


                                        </div>
                                        <div class="col-xl">
                                            <a href="{{route('show_seller_product',$place_active->id)}}" class="badge bg-danger">المنتجات</a>


                                        </div>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif



                        </tbody>
                    </table>
                    <!-- End Table with hoverable rows -->
                    </div>

                </div>
            </div>
            @if($seller_place->where("state","2")->count()>0)
                <?php
                $x++;
                ?>

                <div class="card">
                    <div class="card-body" style="direction: rtl;padding: 15px">
                        <center> <u><h5 class="alert alert-warning">قائمة مشاريع {{$category->title}} نشطة في حالة السكون</h5></u></center>


                        <!-- Table with hoverable rows -->
                        <div class="table-responsive-lg">
                        <table class="table table-bordered border-secondary" >
                            <thead>
                            <tr style="background: #d1d2d5">
                                <th scope="col">#</th>
                                <th scope="col">اسم المصلحة</th>
                                <th scope="col">وصف المصلحة</th>
                                <th scope="col">المالك</th>
                                <th scope="col">فترات العمل - والاسعار</th>
                                <th scope="col"> عدد المنتجات التي يعرضها هذا المحل </th>
                                <th scope="col"> الحجوزات</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">ملاحظات</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($seller_place->where("state","2") as $place_sleep)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$place_sleep->title_of_place}}</td>
                                    <td>{{$place_sleep->description_of_place}}</td>

                                    <td>{{$place_sleep->seller_man->name}}</td>
                                    <td>({{$place_sleep->time_work}})-
                                        @foreach($place_sleep->days as $day)
                                            {{$day->day}}
                                        @endforeach
                                    </td>
                                    <td>{{$place_sleep->products_seller->count()}}</td>
                                    <td>{{$place_sleep->explorer}} مرة تم حجز هذا المشروع </td>
                                    <td><label class="text-warning">
                                            سكون</label>
                                        <a href="{{route('accept_seller_place',$place_sleep->id)}}" class="badge bg-success">تفعيل</a>
                                    </td>

                                    <td>
                                        <div class="row">

                                            <div class="col-xl-6">

                                                <a href="{{route('delete_seller_pace',$place_sleep->id)}}" class="badge bg-danger">Delete</a>

                                            </div>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif



                            </tbody>
                        </table>
                        </div>
                        <!-- End Table with hoverable rows -->

                    </div>
                </div>



@endsection
