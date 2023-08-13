@extends("layout.Cover")
@section("content")



    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <u><h1>تسجيل حجز خارجي</h1></u>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="section dashboard">

                        @if($owner_pace!=null)
                        <div class="card" style="direction: rtl">
                            <div class="card-body pt-3">

                                <h1></h1>

                                <div class="row">

                                    <div class="col-xl-8">
                                        <label>الفترة المحجوزة</label>
                                        <select class="form-select" aria-label="Default select example" id="the_period_id">
                                            <option selected disabled>الفترة المحجوزة</option>
                                            @foreach($owner_pace->the_periods as $period)
                                            <option value="{{$period->id}}">{{$period->title}}</option>
                                                @endforeach

                                        </select>
                                    </div>


                                    <br>
                                    <br>
                                    <div class="col-xl-4">
                                        <label>عدد الاشخاص</label>
                                        <input name="fullName" type="number" class="form-control" id="number_of_persons">

                                    </div>
                                    <br><br><br>
                                    <hr>
                                    <div class="col-xl-12">
                                        <label>موعد الحجز</label>
                                        <input name="fullName" type="date" class="form-control" id="date_reservation">

                                    </div>



                                    <div class="alert alert-danger col-12" style="margin-top: 10px" hidden id="state_reservation">fdfdff</div>


                                </div>
                            </div></div>
                            @else
                            يمكنك تسجيل حجوزات الشالية  الخارجية الخاص بك بعد تعبئة نموذج تقديم الطلب
                            <div class="alert alert-warning">الرجاء تسجيل الشالية الخاص بك بالنقر على تقديم طلب


                            </div>
                        @endif
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    @if($owner_pace!=null)
                    <button type="button" class="btn btn-success" id="take_reservation" onclick="take_reservation()">حجز</button>
                        @endif
                </div>
            </div>
        </div>
    </div>


    <section class="section dashboard">

        <div class="card" style="direction: rtl">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">حجوازت الشالية</button>
                    </li>



                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">معلومات الشالية</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">


                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr style="background:#c9c9c9 ">
                                <th scope="col">#</th>
                                <th scope="col">رقم الحجز</th>
                                <th scope="col">حالة الدفع</th>
                                <th scope="col">تاريخ الحجز</th>
                                <th scope="col">نوع الحجز</th>
                                <th scope="col">الموعد </th>
                                <th scope="col">عدد الاشخصاص </th>
                                <th scope="col">تم بواسطة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($owner_pace!=null&&$owner_pace->reservation!=null&&$owner_pace->reservation->count()>0)
                            @foreach($owner_pace->reservation as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->order_uuid}}</td>
                                    <td>@if($item->state_pay=="1")

                                            <label class="text-success">مدفوع</label>

                                            <label class="text-warning">(CASH) غير مدفوع</label>

                                        @endif

                                    </td>
                                    <td>{{$item->date_reservation}}</td>
                                    <td>@if($item->state_pool_order=="1")
                                            <label class="text-danger">خارجي-{{$item->period->title}}-({{$item->period->pivot($owner_pace->id)->first()->price??"تم حذف الفتره"}} ₪ )</label>
                                        @else
                                            <label class="text-success"> داخلي</label>

                                        @endif

                                    </td>
                                    <td>
                                       <?php $now=\Carbon\Carbon::now()->format('Y-m-d');
                                        $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $item->date_reservation);
                                        $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $now);
                                        $result = $date1->gte($date2);
                                        $days = now()->diffInDays(\Carbon\Carbon::parse($item->date_reservation));

                                        if($result){
                                            if ($days=="0"){
                                                $world="اليوم او غدا";

                                            }else{
                                            $world="باقي"."-".$days."-"."يوم";}
                                        }else{$world="انتهي ";}

                                        ?>
                                        {{$world}}
                                    </td>
                                    <td>{{$item->number_of_persons}}</td>
                                    <td>@if(is_null($item->user_id))
                                            <label class="text-danger">صاحب المكان</label>
                                        @else
                                            <label class="text-success">{{$item->user->name}}</label>

                                        @endif</td>


                                {{--                                                    //<td>{{$offer->new_price_product}}</td>--}}



                            @endforeach
                                @else
                                        <div class="alert alert-warning">لم يصل اي حجز!</div>
                                @endif

                            </tbody>
                        </table>
                    </div>



                    <div class="tab-pane fade pt-3" id="profile-settings">

                        <!-- Settings Form -->
                        @if($owner_pace!=null)
                            @if($remain_periods!=null&&$remain_periods->count()>0)
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#new_period">
                                اضافة فترة جديدة
                            </button>
                            <div class="modal fade" id="new_period" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post" action="{{route("new_period")}}">
                                            @csrf
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-6">
                                                    <label>الفترةالجديدة</label>
                                                    <select class="form-select" aria-label="Default select example" name="new_period">
                                                        <option selected disabled>الفترةالجديدة</option>
                                                        @foreach($remain_periods as $period)
                                                            <option value="{{$period->id}}">{{$period->title}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label>السعر </label>
                                                    <input type="number" class="form-control" name="price_new_period"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" >حفظ</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <form >
                                    <div class="row">
                                <div class="col-6">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">عنوان الشالية</label>
                                    <input name="password" type="text" class="form-control" value="{{$owner_pace->title}}">
                                </div>
                                    <div class="col-6">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">وصف الخاص بالشالية</label>
                                    <input name="password" type="text" class="form-control" value="{{$owner_pace->description}}">
                                </div>
                                        <div class="col-2"> <button class="btn-success badge" STYLE="color: #000000;margin: 10px">SAVE</button></div></div>
                                    </form>
                                <br>
                                <br> <br> <br>
                                <hr>
                                <p>الفترات التي يعمل بها الشالية</p>
                                    @foreach($owner_pace->the_periods as $my_period)

                                    <div  class="col-6">
                                        <input name="password" type="checkbox" class="form-check-input" value="{{$my_period->id}}" id="period_{{$my_period->id}}" checked/>
                                        <label  class="col-md-4 col-lg-3 col-form-label" for="period_{{$my_period->id}}"> {{$my_period->title}}-{{$my_period->pivot->price}}</label>
                                        <div>(<a class="btn btn-danger badge" href="{{route('delete_my_period',$my_period->id)}}">Delete</a>)</div>
                                    </div>
                                            @endforeach




                            </div>


                            @else
                            <div class="alert alert-danger">NO PLACE ADD!!</div>
                            @endif

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form><!-- End Change Password Form -->

                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>



             </section>
    @if($owner_pace!=null)
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>

        function take_reservation() {

            alert_div=document.getElementById('state_reservation');
            alert_div.hidden=true;
            btn=document.getElementById("take_reservation");
            btn.innerText="جاري معالجة الطلب";
            btn.disabled=true;

                $.ajax({
                    type: 'post',
                    url: '{{route('store_out-reservation')}}',
                    data: {
                        '_token':"{{csrf_token()}}",
                        'the_period_id': document.getElementById('the_period_id').value,
                        'date_reservation':document.getElementById('date_reservation').value,
                        'number_of_persons':document.getElementById('number_of_persons').value,

                    }, success: function (data) {
                        if(data.state==false){
                            btn.innerText="اعدالمحاولة";
                            btn.disabled=false;

                            alert_div.hidden=false;

                            alert_div.className="alert alert-danger col-12";
                            alert_div.innerText=data.msg;
                        }
                        if(data.state==true){
                            btn.innerText="حجز";
                            btn.disabled=false;
                            alert_div.hidden=false;
                            alert_div.className="alert alert-success col-12";
                            alert_div.innerText=data.msg;
                            location.reload();

                        }
                    },
                    error:function (data){
                        // send_btn_lecture.disabled=true;
                        // send_btn_lecture.innerHTML="send";
                    },});

        }


    </script>
    @endif
@endsection
