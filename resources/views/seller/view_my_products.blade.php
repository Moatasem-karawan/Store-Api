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
    <div class="card">
        <div class="card-body" style="direction: rtl">
            <u> <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#basicModal">صنف جديد</button></u></div>

        <div style="padding: 15px">
        <ol class="list-group list-group-numbered">
            @if($seller->place!=null&&$seller->place->products_seller!=null)
                @foreach($seller->place->sub_category_seller as $x=>$s_cat)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$s_cat->title}}</div>

                        </div>
                        <span class="badge bg-danger rounded-pill"><a class="btn btn-danger" href="{{route('delete_sub_category',$s_cat->id)}}"><i class="bi bi-trash "></i></a></span>
                    </li>

                @endforeach
            @endif
        </ol></div>
    </div>

    <div class="card">
        <div class="card-body" style="direction: rtl">
            <u> <button type="button" class="btn btn-success mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#basicModal2">اضافة  منتج  جديد  && </button>
            </u>

            <!-- Table with hoverable rows -->
            <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered"  style="direction: rtl ;padding: 10px" >
                <thead>
                <tr style="background: #c9c9c9" >
                    <th scope="col">#</th>
                    <th scope="col">اسم المنتج </th>
                    <th scope="col">الصنف </th>
                    <th scope="col">السعر</th>
                    <th scope="col">عدد طلبات المنتج</th>
                    <th scope="col">حالة المنتج</th>

                    <th scope="col">عمليات</th>



                </tr>
                </thead>
                <tbody>
                @if($seller->place!=null&&$seller->place->products_seller!=null)
                    @foreach($seller->place->products_seller as $x=>$product)

                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$product->title}}</td>
                            <td>{{$product->sub_category->title}}</td>
                            <td>  <div style="min-width: 120px">{{$product->price}} <lable>شيكل</lable> -{{$product->ex_price ??"Error"}}</div></td>

                        <td>
                            @if($product->orders_product!=null)
                                {{$product->orders_product->count()}}
                                @else
                                {{__("0")}}
                                @endif

                        </td>
                            <td>
                                @if($product->state=="0")
                                    <div class="alert alert-primary badge">في انتظار القبول</div>
                                @elseif($product->state=="1")
                                    <div class="alert alert-success badge"> نشط</div>

                                @elseif($product->state=="2")
                                    <div class="alert alert-warning badge">سكون</div>
                                @elseif($product->state=="3")
                                    <div class="alert alert-danger badge">مرفوض!</div>


                                @endif

                            </td>

                            <td>

                                <button type="button" class="btn btn-danger badge" data-bs-toggle="modal" data-bs-target="#basicModal_{{$x}}">
                                   حذف
                                </button>
                                <div class="modal fade" id="basicModal_{{$x}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                               هل انت متاكد من عملية الحذف
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger" href="{{route('delete_my_products',$product->id)}}">yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            </td>

                            <!-- Basic Modal -->





                            @endforeach
                @else
                    <div class="alert alert-warning">لا يوجد منتجات </div>
                @endif
                </tbody>
            </table></div>
            <!-- End Table with hoverable rows -->

        </div>
    </div>
    <div class="modal fade" id="basicModal2" tabindex="-1" style="direction: rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="card-body" action="{{ route('store_product') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">الاسم</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">تعريف عن المنتج</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="description">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">السعر</label>
                            <div class="col-sm-10">
                                <div class="row"><div class="col-8"><input type="text" class="form-control" name="price"></div>
                                <div class="col-4"> <span class="input-group-text" id="basic-addon1">شيكل</span></div> </div>

                            </div>

                        </div>


                        <div class="row mb-3" style="border-bottom: #d70213 solid 1px;border-top : #d70213 solid 1px ;padding: 10px">

                            <div class="col-2"><label for="inputText" class="form-label">لكل</label></div>


                            <div class="col-4">
                                <input type="number" class="form-control" name="count_ex">



                            </div>



                            <div class="col-6">    <select  class="form-select" name="price_ex">
                                    <option selected>نوع التسعير</option>
                                    <option value="قطعة"> قطعة</option>
                                    <option value="قطع"> قطع</option>

                                    <option value="علبة"> علبة</option>
                                    <option value="علب"> علب</option>

                                    <option value=" لتر"> لتر</option>
                                    <option value=" كيلو"> كيلو</option>

                                    <option value="غير ذلك">غير ذلك</option>


                                </select></div>

                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">صنف</label>
                            <div class="col-sm-10">
                                <select id="inputState" class="form-select" name="sub_category_seller">
                                    <option selected>Choose...</option>
                                    @if($seller->place!=null&&$seller->place->sub_category_seller!=null)
                                        @foreach($seller->place->sub_category_seller as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">صورة المنتج</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="file">
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
    <div class="modal fade" id="basicModal" tabindex="-1" style="direction: rtl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="card-body" action="{{ route('store_sub_seller_category') }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">الاسم</label>
                            <div class="col-sm-10">
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

    @endsection