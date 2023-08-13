@extends("layout.Cover")
@section("content")
    <div class="pagetitle">
        <h1>طلبات المحلات التجارية</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
 @foreach($category as $s=>$cat)
     @if($cat->seller_place !=null && $cat->seller_place->count()>0)
     <section class="section">
         <div class="row">
             <div class="col-lg-12">

                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">{{$cat->title}}</h5>

                         <!-- Default Accordion -->
                         @foreach($cat->seller_place->where("state","=","1") as $x=>$seller_place)
                           <u>  عدد الطلبات {{$seller_place->orders->count() ?? "Error"}}</u>
                             <div class="accordion" id="accordionExample">
                                 <div class="accordion-item">
                                     <h2 class="accordion-header" id="headingOne">
                                         <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$x.$s}}" aria-expanded="true" aria-controls="collapseOne">
                                             طلبات   {{$seller_place->title_of_place}}
                                         </button>
                                     </h2>
                                     <div id="collapseOne_{{$x.$s}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                         <div class="accordion-body" style="direction: rtl">
                                             @if($seller_place->orders!=null&&$seller_place->orders->count()>0)
                                                 <div class="table-responsive-lg">

                                                 <table class="table table-hover" >
                                                     <thead>
                                                     <tr style="background: #c2c3c6">
                                                         <th scope="col">#</th>
                                                         <th scope="col">المنتج</th>
                                                         <th scope="col">سعر المنتج</th>
                                                         <th scope="col">الكمية</th>
                                                         <th scope="col">السعر الاجمالي</th>

                                                         <th scope="col">الحالة</th>

                                                     </tr>
                                                     </thead>
                                                     <tbody>


                                                     @foreach($seller_place->orders as $order)
                                                         <tr>
                                                             <th scope="row">{{$loop->iteration}}</th>
                                                             <td>{{$order->product_seller->title}}</td>
                                                             <td>{{$price=$order->product_seller->price}}</td>

                                                             <td>{{$count=$order->count_product}}</td>
                                                             <td>{{$price*$count}}</td>
                                                             <td>@if($order->state_pay=="0")
                                                                     <div class="alert alert-danger badge">لم يتم الدفع</div>
                                                                 @elseif($order->state_pay=="1")
                                                                     <label class="alert alert-success badge"> تم الدفع بواسطة jawwal pay</label>
                                                                 @elseif($order->state_pay=="2")
                                                                     <label class="alert alert-warning badge"> الدفع بعد الاستلام</label>
                                                                 @else
                                                                     <label class="alert alert-danger badge"> ERROR</label>
                                                                 @endif

                                                             </td>


                                                         {{--                                                    //<td>{{$offer->new_price_product}}</td>--}}



                                                     @endforeach
                                                     </tbody>

                                                 </table>
                                                 </div>
                                             @else
                                                 <div CLASS="alert alert-danger">  لم يصل اي طلب !</div>
                                             @endif





                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <hr>

                     @endforeach<!-- End Default Accordion Example -->

                     </div>
                 </div>

             </div>
         </div>
     </section>
     @endif
    @endforeach
@endsection