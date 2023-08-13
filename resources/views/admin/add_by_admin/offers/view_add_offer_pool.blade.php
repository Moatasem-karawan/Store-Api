
@extends("layout.Cover")
@section("content")
    <a href="{{url('index/add/products/for/sellers/project')}}" class="text-danger">المحلات التجارية</a>
    <div class="card" style="direction:rtl ">
        <div class="card-body">

            <h5 class="card-title"> {{$the_pool_place->title}} عروض خاصة ب  </h5>

        </div>
    </div>
    <hr>
    <div class="card" style="direction:rtl ">
        <div class="card-body">
            <h5 class="card-title">Default Breadcrumbs</h5>
            <form class="row mb-30" action="{{route('store_offer_pool_by_admin')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <input name="pool_place_id" type="text" value="{{$the_pool_place->id}}" hidden>
                <div class="card-body">
                    <div class="repeater">

                        <div class="row">

                            <div class="col">
                                <label for="Name"
                                       class="mr-sm-2">اختيار الفترة : </label>
                                <select class="form-select" name="period_id" id="product_id" onchange="get_price()">
                                    <option selected value="not">المنتج المعروض</option>
                                    @foreach($the_pool_place->the_periods as $period)
                                        <option value="{{$period->id}}">{{$period->title}}</option>
                                        @endforeach
                                </select>
                            </div>




                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">السعر القديم :</label>

                                <input class="form-control" type="text" name="price" required  id="last_price" disabled="" />

                            </div>

                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">السعر الجديد :</label>

                                <input class="form-control" type="text" name="new_price" required />
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">تاريخ نهاية العرض :</label>

                                <input class="form-control" type="date"  required />

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
            id_period=document.getElementById('product_id').value;
           // console.log(id_product);
            if (id_period>0){

            $.ajax({
                type:'post',
                url:'{{route('ajax_get_period_price')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'id_period':id_period,
                    "id_pool":'{{$the_pool_place->id}}'

                },
                success:function (data){
                    if(data.state==true){
                        document.getElementById("last_price").value=data.price;

                    }

                }
            });}}
        </script>

@endsection
