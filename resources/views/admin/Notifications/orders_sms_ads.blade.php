
@extends("layout.Cover")
@section("content")
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<center>
        <div class="col-md-10">
            <div class="form-floating mb-3">
                <select class="form-select" id="select_element" onchange="change_()" aria-label="State">
                    <option selected>تصنيف البيانات</option>
                    <option value="pending_orders">الطلبات المعلقة </option>
                    <option value="accept_orders">الطلبات المقبولة</option>
                </select>
                <label for="floatingSelect">State</label>
            </div>
        </div></center>

<div id="pending_orders"  class="all_forms">
    <center>
    <div class="col-lg-10" style="direction: rtl">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-warning">Table with stripped rows</h5>


                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Age</th>
                        <th scope="col">Start Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ads->where("states","=","pending") as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->message_of_ads}}</td>
                            <td>{{$item->count_receivers}}</td>
                            <td>47</td>
                            <td><div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('accept_sms_ads_order',$item->id)}}">Accept</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>
</div></center>
</div>






<div id="accept_orders" style="display: none" class="all_forms" >
    <center>
        <div class="col-lg-10" style="direction: rtl">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-success">Table with stripped rows</h5>


                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nhame</th>
                            <th scope="col">Position</th>
                            <th scope="col">Age</th>
                            <th scope="col">Start Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ads->where("states","=","accept") as $item)
                            <tr>
                                <th scope="row">5</th>
                                <td>Raheem Lehner</td>
                                <td>Dynamic Division Officer</td>
                                <td>47</td>
                                <td>2011-04-19</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div></center>
</div>






    <script>



        function change_() {

            let all_forms=document.getElementsByClassName("all_forms");
            // Hide
            for (x=0 ; x<all_forms.length ;x++){
                all_forms[x].style.display = 'none'
            }
            select_element=document.getElementById("select_element");

            if (select_element.value=="pending_orders"){
                document.getElementById("pending_orders").style.display="block";

            } else if(select_element.value=="accept_orders"){
                document.getElementById("accept_orders").style.display="block";

            }
            else {}

        }

    </script>

{{--    <script>--}}
{{--        function store_random_numbers() {--}}
{{--            if (document.getElementById("new_random_numbers").value!=""){--}}
{{--                send_btn=document.getElementById("send_btn");--}}
{{--                $.ajax({--}}

{{--                    url: '{{route('store_new_random_number')}}',--}}
{{--                    type: 'post',--}}
{{--                    data: {--}}
{{--                        '_token':"{{csrf_token()}}",--}}
{{--                        "new_random_numbers":document.getElementById("new_random_numbers").value,--}}

{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        if(data.state==true){--}}
{{--                            send_btn.disabled=false;--}}
{{--                            send_btn.innerText="sending...";--}}
{{--                            send_btn.className="btn btn-success";--}}
{{--                            location.reload();--}}

{{--                        }--}}
{{--                        if(data.state==false){--}}
{{--                            send_btn.disabled=false;--}}
{{--                            send_btn.innerHTML="خطا في المعلومات";--}}
{{--                            send_btn.className="btn btn-warning";--}}


{{--                        }--}}
{{--                    },--}}
{{--                    error:function (data){--}}
{{--                        // send_btn_lecture.disabled=true;--}}
{{--                        // send_btn_lecture.innerHTML="send";--}}
{{--                    },--}}


{{--                });--}}
{{--            }else {window.alert("NO DATA")}}--}}
{{--        function delete_selected_numbers() {--}}
{{--            let selected=document.getElementsByClassName('check_box');--}}
{{--            let ids=[];--}}
{{--            for (x=0;x<selected.length;x++){--}}
{{--                if (selected[x].checked==true){--}}
{{--                    ids.push(selected[x].value);}--}}

{{--            }--}}
{{--            console.log(ids.length);--}}




{{--        }--}}
{{--        function check_all() {--}}
{{--            let selected=document.getElementsByClassName('check_box');--}}
{{--            let check_all=document.getElementById('check_all');--}}


{{--            if (check_all.checked==true){--}}
{{--                for (x=0;x<selected.length;x++){--}}
{{--                    selected[x].checked = true;--}}

{{--                }}--}}
{{--            else{--}}
{{--                for (x=0;x<selected.length;x++){--}}
{{--                    selected[x].checked = false;--}}

{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--    </script>--}}

@endsection