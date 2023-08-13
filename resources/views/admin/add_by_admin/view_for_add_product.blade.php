
@extends("layout.Cover")
@section("content")
    <div class="modal fade" id="basicModal" tabindex="-1" style="direction: rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="card-body" action="{{ route('add_sub_category_by_admin') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">الاسم</label>
                            <div class="col-sm-10">
                                <input name="seller_place_id" type="text" value="{{$seller_place_id}}" hidden>
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary" >ارسل</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div><!-- End Basic Modal-->
    <a href="{{url('index/add/products/for/sellers/project')}}" class="text-danger">المحلات التجارية</a>
    <div class="card" style="direction:rtl ">
        <div class="card-body">

            <h5 class="card-title"> {{$seller_place->title_of_place}} اضافة منتجات </h5>
            <h5 class="card-title"> {{$seller_place->products_seller->count()}} (عدد المنتجات الحالي)</h5>

        </div>
    </div>
    <hr>
    <div class="card" style="direction:rtl ">
        <div class="card-body">

            <button type="button" class="btn btn-danger m-3" data-bs-toggle="modal" data-bs-target="#basicModal">
               اضافة صنف جديد لهذا المطعم
            </button>

    <form class="row mb-30" action="{{route('store_product_by_admin')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input name="seller_place_id" type="text" value="{{$seller_place_id}}" hidden>
        <div class="card-body">
            <div class="repeater">

                        <div class="row">


                            <div class="col-4">
                                <label for="Name"
                                       class="mr-sm-2">اسم المنتج: </label>
                                <input class="form-control" type="text" name="title" required />
                            </div>

                            <div class="col-4">
                                <label for="Name"
                                       class="mr-sm-2">وصف للمنتج:</label>
                                <input class="form-control" type="text" name="description" required />
                            </div>



                            <div class="col-4">
                                <label for="Name_en" class="mr-sm-2">السعر :</label>

                                <input class="form-control" type="text" name="price" required />

                            </div>



                            <br> <br> <br>
                            <div class="row mb-3" style="border-bottom: #d70213 solid 1px;border-top : #d70213 solid 1px ;padding: 10px">

                                <div class="col-2"><label for="inputText" class="form-label" style="font-size: 25px">لكل</label></div>


                                <div class="col-4">
                                    <input type="number" class="form-control" name="count_ex" placeholder="حدد الكمية">



                                </div>



                                <div class="col-6">    <select  class="form-select" name="ex_price">
                                        <option selected>نوع التسعير</option>
                                        <option value="قطعة"> قطعة</option>
                                        <option value=" لتر"> لتر</option>
                                        <option value=" كيلو"> كيلو</option>

                                        <option value="غير ذلك">غير ذلك</option>


                                    </select></div>

                            </div>







                            <br> <br>
                            <div class="col-6">
                                <label for="Name"
                                       class="mr-sm-2">حدد الصنف: </label>
                                <select class="form-select"  name="sub_category">
                                    @if($seller_place->sub_category_seller!=null && $seller_place->sub_category_seller->count()>0)

                                    @foreach($seller_place->sub_category_seller as $sub_category)
                                        @if($loop->first)
                                                <option> اختر صنف المنتج</option>
                                            @endif
                                        <option value="{{$sub_category->id}}">{{$sub_category->title}}</option>
                                    @endforeach


                                        @else
                                        <option>لا يمكنك اضافة منتجات</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="Name_en" class="mr-sm-2"> IMG:</label>

                                <div class="custom-file">
                                    <input class="form-control" type="file" id="formFile" name="file"/>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>


                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-link">Save</button>
                </div>




    </form>
    </div>
    </div>

    <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';

    </script>



    <!-- custom -->
    <script src="{{ URL::asset('js/custom.js') }}"></script>

@endsection
