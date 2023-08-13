
@extends("layout.Cover")
@section("content")
<div class="row">




    <div class="col-6">
        <a href="#" onclick="random_sms()">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">رسالة  <label>SMS</label>
                    عشوائية</h5>
            </div>
        </div>   </a></div>



    <div class="col-6">

        <a href="#" onclick="show_form_for_specific_number()">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">رسالة <label>SMS</label>
                        الى رقم محدد</h5>
                </div>
            </div>
        </a>
    </div>



    <div class="col-6">    <a href="#" onclick="show_or_add_random_numbers()"><div class="card" >
            <div class="card-body">
                <h5 class="card-title">(عرض -اضافة) ارقام عشوائية</h5>
            </div>
        </div>   </a>
    </div>



    <div class="col-6">    <a href="#" onclick="sms_for_traders_or_users()"><div class="card">
            <div class="card-body">
                <h5 class="card-title">رسالة <label>SMS</label>
                    لتجار او مستخدمين</h5>
            </div>
        </div>   </a>
    </div>






</div>


    <div class="all_forms" id="sms_for_specific_number" style="display: none">


        <form action="{{\Illuminate\Support\Facades\URL::signedRoute("send_free_sms_by_admin")}}"  method="post">
            @csrf
        <div class="input-group mb-3">

            <input type="text" class="form-control" name="to" placeholder="مثال على الرقم - 0594419959" aria-describedby="basic-addon3">
        </div>

        <div class="input-group">
            <span class="input-group-text">نص الرسالة</span>
            <textarea class="form-control" name="message" aria-label="With textarea"></textarea>
        </div>

        <br>
        <div class="row mb-3">
            <div class="col-sm-12">
                <select class="form-select" aria-label="Default select example" name="selected_number">
                    @if(isset($phones) &&$phones->count()>0)
                    <option selected>رقم ارسال الرسالة</option>
                    @foreach($phones as $phone)
                       <option value="{{$phone->id}}"> {{$phone->phone}}</option>
                    @endforeach
                        @else
                        <option selected class="text-danger">لا يمكنك الارسال</option>

                    @endif
                </select>
            </div>
        </div>
        <button class="btn btn-outline-success" type="submit">SEND SMS</button></form>
    </div>



<div class="all_forms" id="random_sms" style="display: none">
    as
</div>



<div class="all_forms" id="sms_for_traders_or_users" style="display: none">
    spicefific number3
</div>



<div class="all_forms" id="show_or_add_random_numbers" style="display: none">

    <div class="card">
        <div class="card-body">
            <div class="row" >
                <div>
                <h5 class="card-title">قائمة الارقام العشوائية </h5></div>


            </div>
{{--        @if(isset($phones_ads) &&$phones_ads->count()>0)--}}
{{--            {{$phones_ads->count()}}--}}
{{--            @else--}}
{{--        {{0}}@endif--}}

            <!-- List group With Checkboxes and radios -->
            <ul class="list-group">
                <li class="list-group-item">
                    <input class="form-check-input me-1 "  onclick="check_all()" type="checkbox" id="check_all" aria-label="...">
                    تحديد الكل
                </li>
                @if(isset($phones_ads) &&$phones_ads->count()>0)
                    @foreach($phones_ads as $phone)

                        <li class="list-group-item">
                            <input class="form-check-input me-1 check_box"  type="checkbox" value="{{$phone->id}}" aria-label="...">

                            {{$phone->phone}}

                            <span class="badge bg-primary rounded-pill " style="margin-left: 30px">{{$phone->count_rec_msg}}</span>
                        </li>

                    @endforeach
                @endif


            </ul><!-- End List Checkboxes and radios -->

            <br>


            <div class="input-group">
                <span class="input-group-text">الارقام المضافة (-)</span>
                <textarea class="form-control" id="new_random_numbers" aria-label="With textarea"></textarea>
            </div>
            <br>

            <button class="btn btn-outline-success" onclick="store_random_numbers()" id="send_btn">اضافة الارقام</button>
            <button class="btn btn-outline-danger" style="margin-left: 60px" onclick="delete_selected_numbers()" id="send_btn"> حذف الارقام المحددة </button>


        </div>
    </div>

</div>
<script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        let all_forms=document.getElementsByClassName("all_forms");
        // Hide
        for (x=0 ; x<all_forms.length ;x++){
            all_forms[x].style.display = 'none'
        }
        function show_form_for_specific_number() {
            let all_forms=document.getElementsByClassName("all_forms");
            // Hide
           for (x=0 ; x<all_forms.length ;x++){
               all_forms[x].style.display = 'none'
           }
            document.getElementById("sms_for_specific_number").style.display = 'block';
        }
        function sms_for_traders_or_users() {
            let all_forms=document.getElementsByClassName("all_forms");
            // Hide
            for (x=0 ; x<all_forms.length ;x++){
                all_forms[x].style.display = 'none'
            }
            document.getElementById("sms_for_traders_or_users").style.display = 'block';
        }

        function random_sms() {
            let all_forms=document.getElementsByClassName("all_forms");
            // Hide
            for (x=0 ; x<all_forms.length ;x++){
                all_forms[x].style.display = 'none'
            }
            document.getElementById("random_sms").style.display = 'block';
        }

        function show_or_add_random_numbers() {
            let all_forms=document.getElementsByClassName("all_forms");
            // Hide
            for (x=0 ; x<all_forms.length ;x++){
                all_forms[x].style.display = 'none'
            }
            document.getElementById("show_or_add_random_numbers").style.display = 'block';
        }
    </script>

    <script>
        function store_random_numbers() {
            if (document.getElementById("new_random_numbers").value!=""){
                send_btn=document.getElementById("send_btn");
            $.ajax({

                url: '{{route('store_new_random_number')}}',
                type: 'post',
                data: {
                    '_token':"{{csrf_token()}}",
                    "new_random_numbers":document.getElementById("new_random_numbers").value,

                },
                success: function (data) {
                    if(data.state==true){
                        send_btn.disabled=false;
                        send_btn.innerText="sending...";
                        send_btn.className="btn btn-success";
                        location.reload();

                    }
                    if(data.state==false){
                        send_btn.disabled=false;
                        send_btn.innerHTML="خطا في المعلومات";
                        send_btn.className="btn btn-warning";


                    }
                },
                error:function (data){
                    // send_btn_lecture.disabled=true;
                    // send_btn_lecture.innerHTML="send";
                },


            });
        }else {window.alert("NO DATA")}}
        function delete_selected_numbers() {
           let selected=document.getElementsByClassName('check_box');
           let ids=[];
           for (x=0;x<selected.length;x++){
               if (selected[x].checked==true){
               ids.push(selected[x].value);}

           }
           console.log(ids.length);




        }
        function check_all() {
            let selected=document.getElementsByClassName('check_box');
            let check_all=document.getElementById('check_all');


            if (check_all.checked==true){
            for (x=0;x<selected.length;x++){
               selected[x].checked = true;

            }}
            else{
                    for (x=0;x<selected.length;x++){
                        selected[x].checked = false;

                    }
                }
            }

    </script>

@endsection