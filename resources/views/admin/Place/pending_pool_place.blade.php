@extends("layout.Cover")
@section("content")

    <center> <h1 class="txt"> طلبات الانضمام الشاليهات</h1></center>

    <div class="card">
        <div class="card-body" style="direction: rtl">
            <u><h5 class="card-title">قائمة الطلبات المعلقة</h5></u>

            <!-- Table with hoverable rows -->
            <div class="table-responsive-lg">
            <table class="table table-hover" >
                <thead>
                <tr style="background: #c2c3c6">
                    <th scope="col">#</th>
                    <th scope="col">اسم المصلحة</th>
                    <th scope="col">وصف المصلحة</th>
                    <th scope="col">اسم المتقدم</th>
                    <th scope="col">الفترات - والاسعار</th>

                    <th scope="col">ملاحظات</th>
                </tr>
                </thead>
                <tbody>
                @if($pool_place->count()>0)

                    @foreach($pool_place as $place_pool)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$place_pool->title}}</td>
                            <td>{{$place_pool->description}}</td>

                            <td>{{$place_pool->owner->name}}</td>
                            <td>
                                @foreach($place_pool->the_periods as $period)


                                    {{$period->title}}-{{$period->pivot->price}}<br>
                                @endforeach
                            </td>


                            <td>
                                <div class="row">
                                    <div class="col-xl-3">
                                        <a href="{{route('accept_pool_place',$place_pool->id)}}" class="badge  bg-success" >قبول</a>


                                    </div>
                                    <div class="col-xl-3">
                                        <a href="" class="btn btn-danger">رفض</a>


                                    </div>
                                    <div class="col-xl-3">
                                        <a href="{{route('show_pool_files',$place_pool->id)}}" class="badge  bg-info">المرفقات</a>


                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="alert alert-danger">لا يوجد طلبات</div>
                @endif


                </tbody>
            </table>
            </div>
            <!-- End Table with hoverable rows -->

        </div>
    </div>

@endsection
