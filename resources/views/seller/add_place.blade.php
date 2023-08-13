@extends("layout.Cover")
@section("content")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-12" >

        <div class="card">
            <form class="card-body" action="{{ route('store_place') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <h5 class="card-title">General Form Elements</h5>

                <!-- General Form Elements -->




                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">اسم المشروع الخاص بك</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">وصف المشروع الخاص بك</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" style="height: 100px" name="description" required></textarea>
                        </div>
                    </div>
                <hr/>
                <div class="row mb-3">
                    <center><u><h4 class="text-danger">ساعات الدوام </h4></u></center>
                    <label for="inputText" class="col-sm-2 col-form-label"  >from (صباحا)</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" placeholder="صباحا" name="from" required>
                    </div>

                    <label for="inputText" class="col-sm-1 col-form-label" >to (مساءً)</label>
                    <div class="col-sm-4">
                        <input type="number" placeholder="مساءً" class="form-control" name="to" required>
                    </div>

                </div>
                <hr>







                <center><u><h4 class="text-danger">ايام العمل</h4></u></center>
                <br>
                        <div class="row" style="margin-left: 20px">
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
                    <label for="inputPassword" class="col-sm-2 col-form-label">صورة المشروع الخاص بك</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="file" required/>
                    </div>
                </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Submit Button</label>
                        <div class="col-sm-10">
                            <button  class="btn btn-danger" type="submit">ارسال الطلب</button>
                        </div>
                    </div>




            </form></div>
        </div>



    @endsection
