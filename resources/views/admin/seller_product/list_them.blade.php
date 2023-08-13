@extends("layout.Cover")
@section("content")


    <center> <h1 class="txt">طلبات اضافة المنتجات للمحلات التجارية</h1></center>


    <div class="card">
        <div class="card-body" style="direction: rtl">
            <u><h5 class="card-title">قائمة مشاريع </h5></u>

            <!-- Table with hoverable rows -->
            <table class="table table-bordered border-primary" >
                <thead>
                <tr style="background: #c5c5c6">
                    <th scope="col">#</th>
                    <th scope="col">اسم المنتج</th>
                    <th scope="col">وصف المنتج</th>
                    <th scope="col">اسم المحل التجاري</th>
                    <th scope="col">السعر</th>
                    <th scope="col">ملاحظات</th>
                    <th scope="col">صورة المنتج</th>
                </tr>
                </thead>
                <tbody>
                @if($seller_products->count()>0)

                    @foreach($seller_products as $product)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>

                            <td>{{$product->provide_by_seller_place->title_of_place}}</td>


                            <td>{{$product->price}} شيكل </td>

                            <td>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <a href="{{route('accept_seller_order',$product->id)}}" class="badge bg-success" >قبول</a>


                                    </div>
                                    <div class="col-xl-4">
                                        <a href="#" class="badge bg-warning">رفض</a>


                                    </div>

                                </div>
                            </td>
                            <td><img src="{{asset("all_files/".$product->img->url)}}" width="100px" height="60px"> </td>

                        </tr>
                    @endforeach
                @else
                    <div class="alert alert-danger">لا يوجد طلبات اضافة منتجات</div>
                @endif


                </tbody>
            </table>
            <!-- End Table with hoverable rows -->

        </div>
    </div>

@endsection
