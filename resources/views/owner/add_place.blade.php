@extends("layout.Cover")
@section("content")
    <link href="{{asset('/filepond/filepond.css')}}" rel="stylesheet" />
    <div class="col-lg-12" style="direction: rtl">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">تسجيل المشروع التجاري الخاص</h5>

                <!-- General Form Elements -->

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">عنوان الشالية الخاص بك</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">وصف للشالية الخاص بك</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" style="height: 100px" id="description"></textarea>
                        </div>
                    </div>









                    <hr/>
                 <div class="row mb-3">
                     <label class="col-sm-2 col-form-label">اخيار فترات العمل والاسعار</label>
                     <div class="row">
                         @foreach($periods as $item)
                             <div class="col-xl">
                                 <label>فترة</label>
                                 <select class="form-select period">
                                     <option selected> الفترة</option>
                                     @foreach($periods as $item)
                                     <option value="{{$item->id}}">{{$item->title}}({{$item->time}})</option>
                                         @endforeach
                                 </select>

                                 <label>السعر ₪</label>
                                 <input type="text" class="form-control price"/>

                             </div>
                             @endforeach
                     </div>
                 </div>

                    <hr>
                    <div class="row mb-3">
                        <u><p class="text-danger">عدد الصور المسموح رفعها 3 لكل دقيقة</p></u>
                        <label class="col-sm-2 col-form-label">ادراج صور الشالية</label>
                        <div class="col-sm-10">
                        <fieldset>
                            <legend>Files</legend>

                            <!-- a list of already uploaded files -->
                            <ol>

                            </ol>

                            <!-- our filepond input -->

                            <input type="file"  name="avatar"  required multiple />
                        </fieldset></div></div>



                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Submit Button</label>
                        <div class="col-sm-10">
                            <button  class="btn btn-danger" id="save_data">ارسال الطلب</button>
                        </div>
                    </div>


            </div>
        </div>

    </div>
    <script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="{{asset('/filepond/filepond.js')}}"></script>
    <script>
        my_period=[];
        my_price=[];

        let files=[];
        const fieldsetElement = document.querySelector('fieldset');
        const pond2 = FilePond.create(fieldsetElement);
        console.log(pond2.files);
        const inputElement = document.querySelector('input[id="avatar"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '/upload_files_from_owner',
                timeout: false,
                process: {
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                    },
                    withCredentials: false,
                    onload: (response) => {files.push(response);console.log(files);},
                    onerror: (response) => console.log("404"),

                },
                // revert: './revert',
                // restore: './restore/',
                // load: './load/',
                // fetch: './fetch/',
            },});
        $(document).on("click","#save_data",function (e) {
            e.preventDefault();
            my_period=[];
            my_price=[];

            let all_period=document.getElementsByClassName("form-select period");
            for (var i = 0; i < all_period.length; i++) {
                console.log(all_period[i].value);
                if(all_period[i].value>0){
                    my_period.push(all_period[i].value)}
            }

            let all_price=document.getElementsByClassName("form-control price");
            for (var ii = 0; ii < all_price.length; ii++) {
                console.log(all_price[ii].value);
                if(all_price[ii].value!=""){

                    my_price.push(all_price[ii].value)}
            }




            let send_btn=document.getElementById('save_data');
            send_btn.disabled=true;
          //  send_btn.disabled=true;
            send_btn.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' ;


              $.ajax({

                  url: '/owner/save/owner/place',
                  type: 'post',
                  data: {
                      '_token':"{{csrf_token()}}",
                      "title":document.getElementById("title").value,
                      "description":document.getElementById("description").value,
                      "files":files,
                      "my_price":my_price,
                      "my_period":my_period,
                  },
                  success: function (data) {
                      if(data.state==true){
                          //send_btn.disabled=false;
                          send_btn.innerHTML="تم الارسال بنجاح";
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


        });

    </script>
    @endsection
