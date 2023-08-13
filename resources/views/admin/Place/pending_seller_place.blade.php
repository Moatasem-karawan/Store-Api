@extends("layout.Cover")
@section("content")
@foreach($cat as $category)
    @if($category->seller_place->where("state","=","0")!=null &&$category->seller_place->where("state","=","0")->count()>0)
    <center> <h1 class="txt">طلبات الانضمام</h1></center>

    <div class="card">
        <div  style="direction: rtl ;padding: 10px;">
            <u><h5 class="card-title">{{$category->title}} </h5></u>

            <!-- Table with hoverable rows -->
            <div class="table-responsive-lg">
            <table class="table table-hover table-bordered" >
                <thead>
                <tr style="background: #cbcccf">
                    <th scope="col">#</th>
                    <th scope="col">اسم المصلحة</th>
                    <th scope="col">وصف المصلحة</th>
                    <th scope="col">اسم المتقدم</th>
                    <th scope="col">ساعات العمل</th>
                    <th scope="col">الهاتف الخاص بالمصحلة</th>
                    <th scope="col">ملاحظات</th>
                </tr>
                </thead>
                <tbody>


                @foreach($category->seller_place->where("state","=","0") as $seller_place)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$seller_place->title_of_place}}</td>
                        <td>{{$seller_place->description_of_place}}
                        <br>
                        {{$seller_place->region->region ?? "Erro"}} - {{$seller_place->area->area}}</td>

                        <td>{{$seller_place->seller_man->name}}</td>
                        <td>
                           {{$seller_place->time_work}}
                            <hr>
                            @foreach($seller_place->days as $day)
                                {{$day->day}}-
                                @endforeach
                        </td>
                        <td>{{$seller_place->place_phone}}</td>

                        <td>
                            <div class="row">
                                <div class="col-xl-3">
                                    <a href="{{route('accept_seller_place',$seller_place->id)}}" class="badge bg-success" >قبول</a>


                                </div>
                                <div class="col-xl-3">
                                    <a href="#" class="badge bg-danger">رفض</a>


                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach



                </tbody>
            </table>
            </div>
            <!-- End Table with hoverable rows -->

        </div>
    </div>
    @endif
    @endforeach

@endsection
