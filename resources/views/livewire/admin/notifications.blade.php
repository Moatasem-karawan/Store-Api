<div>


    <section class="section">
        <div class="row">
            <div class="col-lg-7" style="direction: rtl">

                <div class="card">
                    <div class="card-body">

                        <b><h5 class="card-title left">جميع الارقام المتاحة</h5></b>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#basicModal">اضافة رقم جديد</button>

                        <br>
                        <br>


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم الهاتف</th>
                                <th scope="col">عدد الرسائل المتبقي</th>
                                <th scope="col">حالة الرقم</th>
                                <th scope="col">الاعدادت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($phones)&&$phones->count()>0)
                                @foreach($phones as $phone)


                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$phone->phone}}</td>
                                        <td>{{$phone->remain_messages}}</td>
                                        <td>
                                           @if($phone->states=="up")
                                               <label class="text-success"> {{$phone->states}}</label>
                                               @elseif($phone->states=="down")
                                                <label class="text-danger"> {{$phone->states}}</label>

                                            @else
                                                {{$phone->states}}
                                            @endif



                                        </td>
                                        <td> <button  class="btn btn-primary" wire:click="show_phone_number_information('{{$phone->id}}')"><i class="ri-chat-settings-fill"></i></button>
                                            <button  class="btn btn-danger" wire:click="delete_free_number('{{$phone->id}}')"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>

                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            @if($update_mode==true)
            <div class="col-xl-5">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title"><i class="ri-chat-settings-fill"></i> Setting </h5>


                        <div class="row g-3" action="#">
                            <div class="col-md-10">


                                <center><b><label for="floatingName">رقم الهاتف</label></b></center>
                                <div class="form-floating">

                                    <input type="text" class="form-control" wire:model="phone" placeholder="Your Name">
                                    <label for="floatingName"> </label>
                                </div>



                            </div>
                            <div class="col-md-2">

                                <center><b><label for="floatingName">MSG</label></b></center>

                                <div class="form-floating">

                                    <input type="text" class="form-control" wire:model="count_msg" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName"> </label>
                                </div>
                            </div>


                            <div class="col-md-12">

                                <div class="input-group">
                                    <span class="input-group-text">Device ID</span>
                                    <textarea class="form-control" wire:model="device_id" aria-label="With textarea"></textarea>
                                </div>
                            </div>

                            <br>

                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text">TOKEN</span>
                                    <textarea class="form-control" wire:model="phone_token" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <center><b><label for="floatingName"> حالة الرقم</label></b></center>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" wire:model="states"  value="up" checked>
                                            <b><label class="form-check-label text-success" for="gridRadios1">
                                                    فعال
                                                </label></b>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"    wire:model="states" value="down" >
                                            <b><label class="form-check-label text-danger" for="gridRadios2">
                                                    غير فعال
                                                </label></b>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="text-center">
                                <button  class="btn btn-primary" wire:click="save_update_information()">Update Now</button>
                            </div>
                        </div><!-- End floating Labels Form -->

                    </div>
                </div>


            </div>
                @endif

        </div>
    </section>


</div>
