
@extends("layout.Cover")
@section("content")
    <a href="{{url('index/add/products/for/sellers/project')}}" class="text-danger">المحلات التجارية</a>
    <div class="card" style="direction:rtl ">
        <div class="card-body">

            <h5 class="card-title"> {{$the_sellers_place->title_of_place}} عروض خاصة ب  </h5>
            <h5 class="card-title"> {{$the_sellers_place->products_seller->count()}} (عدد المنتجات الحالي)</h5>

        </div>
    </div>
    <hr>
    <div class="card" style="direction:rtl ">
        <div class="card-body">
            <h5 class="card-title">Default Breadcrumbs</h5>
            <form class="row mb-30" action="{{route('store_offer_by_admin_for_seller')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <input name="seller_place_id" type="text" value="{{$id_seller_place}}" hidden>
                <div class="card-body">
                    <div class="repeater">

                        <div class="row">

                            <div class="col-6">
                                <label for="Name"
                                       class="mr-sm-2">اختيار المنتج : </label>
                                <select class="form-select" name="product_id" id="product_id" onchange="get_price()">
                                    <option selected value="not">المنتج المعروض</option>
                                    @foreach($the_sellers_place->products_seller as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>
                                        @endforeach
                                </select>
                            </div>




                            <div class="col-6">
                                <label for="Name_en" class="mr-sm-2">السعر القديم :</label>

                                <input class="form-control" type="text" name="price" required  id="last_price" disabled="" />

                            </div>

                            <br><br><br><br>

                            <div class="col-12">
                                <label for="Name_en" class="mr-sm-2">السعر الجديد :</label>

                                <input class="form-control" type="text" name="new_price" required />
                            </div>


                        </div>
                        <br> <br> <br>
                        <div class="row mb-3" style="border-bottom: #d70213 solid 1px;border-top : #d70213 solid 1px ;padding: 10px">

                            <div class="col-2"><label for="inputText" class="form-label" style="font-size: 25px">لكل</label></div>


                            <div class="col-4">
                                <input type="number" class="form-control" name="count_ex" id="count_ex" placeholder="حدد الكمية">



                            </div>



                            <div class="col-6">
                                <input class="form-control name_ex" type="text"  disabled />
                                <input class="form-control name_ex" type="text"  name="name_ex"  hidden/>

                            </div>

                        </div>







                        <br> <br>
                    </div>
                </div>


                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-link">Save</button>
                </div>




            </form>
        </div>
    </div>

{{--    <script src="{{ URL::asset('js/jquery-3.3.1.min.js') }}"></script>--}}
{{--    <!-- plugins-jquery -->--}}
{{--    <script src="{{ URL::asset('js/plugins-jquery.js') }}"></script>--}}
{{--    <!-- plugin_path -->--}}
{{--    <script>--}}
{{--        var plugin_path = 'js/';--}}

{{--    </script>--}}



{{--    <!-- custom -->--}}
{{--    <script src="{{ URL::asset('js/custom.js') }}"></script>--}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script>
        function get_price(){
            id_product=document.getElementById('product_id').value;
            console.log(id_product);
            if (id_product>0){

            $.ajax({
                type:'post',
                url:'{{route('ajax_get_product_price')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'id_product':id_product,

                },
                success:function (data){
                    if(data.state==true){
                      //  document.getElementById("last_price").value=data.price;
                        let price=document.getElementById("last_price");
                        price.value=data.price +""+"شيكل";
                        price.value=price.value+"-"+data.ex_price;
                        document.getElementsByClassName("name_ex")[0].value = data.name_ex;
                        document.getElementsByClassName("name_ex")[1].value = data.name_ex;

                        document.getElementById("count_ex").value = data.count_ex;

                    }

                }
            });}}
        </script>

@endsection
