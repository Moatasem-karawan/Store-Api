@extends("layout.Cover")
@section("content")
    <section class="section dashboard">


                            <div class="card">
                                <div class="card-body" style="direction: rtl">
                                    <u><h5 class="card-title">استفسارات المستخدمين</h5></u>

                                    <!-- Table with hoverable rows -->
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">اسم المشروع</th>
                                            <th scope="col">وصف المشروع</th>
                                            <th scope="col">عدد الحجوزات</th>

                                            <th scope="col">الحالة</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$product->title}}</td>
                                                <td>{{$product->description}}</td>
                                                <td>{{$product->explorer}}</td>
                                                <td>
                                                    @if($product->state=="0")
                                                        <div class="text-danger">غير مفعل</div>
                                                        @elseif($product->state=="1")
                                                        <div class="text-success">نشط</div>
                                                    @elseif($product->state=="2")
                                                        <div class="text-warning">غير نشط</div>
                                                    @elseif($product->state=="4")
                                                        <div class="text-danger">مرفوض ! </div>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                    <!-- End Table with hoverable rows -->

                                </div>
                            </div>




             </section>

@endsection
