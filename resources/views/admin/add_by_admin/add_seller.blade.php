@extends("layout.Cover")
@section("content")

    @if ($errors->any())
        <div class="card">
            <div class="card-body" style="direction: rtl">

                <div class="alert alert-danger" style="margin-top: 15px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="col-lg-12" >

        <div class="card" style="direction: rtl">
            <form class="card-body" action="{{ route('store_seller_by_admin') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->




                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">اسم المشروع</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">وصف المشروع </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" style="height: 100px" name="description"></textarea>
                    </div>
                </div>
                <hr/>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label"  >اسم المالك</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Name owner" name="name">
                    </div>
                    ||

                    <label for="inputText" class="col-sm-1 col-form-label" >هاتف المحل </label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Phone" class="form-control" name="place_phone">
                    </div>

                </div>
                <div class="row mb-3" >
                    <label for="inputText" class="col-sm-2 col-form-label" >Email login</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    ||
                    <div class="col-sm-5">

                        <div class="row">
                            <div class="col-2">الصنف</div>
                            <div class="col-10"> <select   class="form-select" name="category_id" style="direction: rtl">
                                    <option selected>اختر نوع المصلحة التجارية</option>
                                    @foreach($category as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>

                                    @endforeach
                                </select></div>
                        </div>

                    </div>

                </div>
                <hr>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label"  >بداية العمل</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" placeholder="صباحا" name="from">
                    </div>

                    <label for="inputText" class="col-sm-1 col-form-label" >نهاية العمل</label>
                    <div class="col-sm-4">
                        <input type="number" placeholder="مساء" class="form-control" name="to">
                    </div>

                </div>







                <center><u><h4 class="text-danger">ايام العمل</h4></u></center>
                <br>
                <div class="row" style="margin-left: 20px;direction: ltr">
                    @foreach($days as $day)
                        <div class="form-check col-xl">
                            <input class="form-check-input" type="checkbox" value="{{$day->id}}"  id="{{$day->id}}" name="days[]" >
                            <label class="form-check-label" for="{{$day->id}}">
                                {{$day->day}}
                            </label>
                        </div>
                    @endforeach
                </div>



                <hr/>
                <hr>



                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">صور للمحل التجاري</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="file"/>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-sm-10">
                        <button  class="btn btn-danger" type="submit">ارسال الطلب</button>
                    </div>
                </div>




            </form></div>
    </div>



@endsection
