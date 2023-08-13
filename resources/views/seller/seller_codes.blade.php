@extends("layout.Cover")
@section("content")
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{route('store_code_offers_by_seller')}}" method="post" >
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

                             <br><hr>

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





            @if($codes!=null && $codes->count()>0)

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div  style="padding:10px">
                                    <h5 class="card-title"> اكواد خصم  </h5>


                                    <div class="table-responsive-xl">
                                        <table class="table table-bordered" style="direction: rtl">
                                            <thead class="thead-dark" style="background: #2b2b2b ;color: white ">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الكود</th>
                                                <th scope="col">عدد مرات الاستخدام</th>

                                                <th scope="col">الخصم</th>

                                                <th scope="col">-</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($codes as $code)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$code->code}}<br>
                                                    @if($code->seller_place_id ==null)
                                                        تم اضافة هذا الكود بواسطة الادمن
                                                        هذا الكود يعمل في كل  {{$code->category->title}}
                                                        @endif
                                                    </td>
                                                    <td>{{$code->max_use}}/{{$code->usage}}<br>
                                                        عدد مرات الاستخدام  {{$code->usage}} <br>

                                                        عدد مرات المسموح بها {{$code->max_use}}
                                                    </td>

                                                    <td>{{$code->offer}} %</td>

                                                    <td>

                                                        @if(!$code->seller_place_id ==null)
                                                            <a href="#" class="btn bg-danger badge">حذف</a>
                                                                      @endif

                                                    </td>


                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>


                                    </div></div>



                            </div>

                        </div>
                    </div>
                </section>
                @else
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div  style="padding:10px">
                                    <h5 class="card-title"> اكواد خصم  </h5>


                                    <div class="table-responsive-xl">
                                        <table class="table table-bordered" style="direction: rtl">
                                            <thead class="thead-dark" style="background: #2b2b2b ;color: white ">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الكود</th>
                                                <th scope="col">عدد مرات الاستخدام</th>

                                                <th scope="col">الخصم</th>

                                                <th scope="col">-</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <div class="alert alert-warning">لم يتم اصافة اي كود خصم</div>


                                            </tbody>
                                        </table>


                                    </div></div>



                            </div>

                        </div>
                    </div>
                </section>

            @endif



@endsection