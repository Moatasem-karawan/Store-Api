@extends("layout.Cover")
@section("content")
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{route('store_code_offers')}}" method="post" >
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate CODE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="direction: rtl">
                    <div class="col-12">
                        <label> الكود </label>
                        <input type="text" class="form-control" name="code" placeholder="CODE">
                    </div>
                        <br><br><br>  <br><hr>
                        <div class="col-6">
                            <label> عدد مرات الاستخدام </label>
                            <input type="number" class="form-control" name="max_use">
                        </div>
                        <div class="col-6">
                            <label> الخصم </label><br>
                             <u>(<label class="text-danger"> % </label>)</u>
                            
                            <input type="number" class="form-control" name="offer" placeholder="%">
                        </div>

                        <br><br><br>  <br><hr>

                    <div class="col-6">
                        <label> الكود يعمل في اي قسم ؟ </label>

                        <select id="id_category" class="form-select" name="category_id" onchange="get_place()">
                            <option selected>Choose...</option>
                             @foreach($categorys as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                                 @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label> تحديد المصلحة ان وجد </label>

                        <select id="places"   class="form-select" name="places_id">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
 </form>

        </div>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#basicModal">كود جديد</button>


                    </div>



                </div>

            </div>
        </div>
    </section>

  @foreach($categorys as $category)
      @if($category->hashcode=="8000")
          @if($category->pool_codes!=null && $category->pool_codes->count()>0)

              <section class="section">
                  <div class="row">
                      <div class="col-lg-12">

                          <div class="card">
                              <div style="padding:10px">
                                  <h5 class="card-title"> اكواد خصم {{$category->title}}  </h5>

                                <div class="table-responsive-xl">
                                  <table class="table table-bordered" style="direction: rtl">
                                      <thead class="thead-dark" style="background: #2b2b2b ;color: white ">
                                      <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">الكود</th>
                                          <th scope="col">عدد مرات الاستخدام</th>

                                          <th scope="col">الخصم</th>
                                          <th scope="col">المحل التجاري </th>
                                          <th scope="col">- </th>


                                      </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($category->pool_codes as $code)
                                          <tr>
                                              <th scope="row">{{$loop->iteration}}</th>
                                              <td>{{$code->code}}</td>
                                              <td>{{$code->max_use}}/{{$code->usage}}</td>

                                              <td>{{$code->offer}}</td>

                                              <td>{{$code->pool_place->title ?? "الكل"}}</td>
                                              <td> <a href="#" class="btn bg-danger badge">حذف</td>



                                          </tr>
                                      @endforeach

                                      </tbody>
                                  </table></div>


                              </div>



                          </div>

                      </div>
                  </div>
              </section>
          @endif
      @endif


      @if($category->hashcode!="8000")
      @if($category->seller_codes!=null && $category->seller_codes->count()>0)

          <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div  style="padding:10px">
                          <h5 class="card-title"> اكواد خصم {{$category->title}}  </h5>


                              <div class="table-responsive-xl">
                          <table class="table table-bordered" style="direction: rtl">
                              <thead class="thead-dark" style="background: #2b2b2b ;color: white ">
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">الكود</th>
                                  <th scope="col">عدد مرات الاستخدام</th>

                                  <th scope="col">الخصم</th>
                                  <th scope="col">الشالية </th>
                                  <th scope="col">-</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($category->seller_codes as $code)
                                  <tr>
                                      <th scope="row">{{$loop->iteration}}</th>
                                      <td>{{$code->code}}</td>
                                      <td>{{$code->max_use}}/{{$code->usage}}</td>

                                      <td>{{$code->offer}} %</td>

                                      <td>{{$code->seller_place->title_of_place ?? "الكل"}}</td>
                                      <td> <a href="#" class="btn bg-danger badge">حذف</td>


                                  </tr>
                              @endforeach

                              </tbody>
                          </table>


                      </div></div>



                  </div>

              </div>
          </div>
      </section>
      @endif
      @endif
    @endforeach
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>
        function  get_place(){
            id_category=document.getElementById("id_category").value;
            console.log(id_category);
            if(id_category>0){

                $.ajax({
                    type: 'post',
                    url: '{{route('ajax_get_place_of_category')}}',
                    data: {
                        '_token':"{{csrf_token()}}",
                        'id_category': id_category,


                    },
                    success: function (data) {
                        if(data.state==true){
                            var sub_category=document.getElementById("places");
                            sub_category.innerHTML="<option selected disabled>Choose....</option>";
                            sub_category.innerHTML= sub_category.innerHTML+"<option value='all' >الكل</option>";

                            data.data.forEach(element =>sub_category.innerHTML=sub_category.innerHTML+"<option value="+element["id"]+">" + element["title"] + '</option>');
                        }
                    },
                    error:function (data){
                        document.getElementById("h done").style.display="block";
                        document.getElementById("h done").innerText="لم تضبط معنا حاول مره اخرى";
                        document.getElementById("save").disabled=false;
                    },





                });

            }
        }
    </script>
@endsection