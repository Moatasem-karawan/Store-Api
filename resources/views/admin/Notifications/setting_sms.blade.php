

<head>
@livewireStyles
</head>
<body>


@extends("layout.Cover")
@section("content")
    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NEW PHONE NUMBER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.store_free_number')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">


                                <center><b><label for="floatingName">رقم الهاتف</label></b></center>
                                <div class="form-floating">

                                    <input type="text" class="form-control" name="phone" placeholder="Your Name">
                                    <label for="floatingName"> </label>
                                </div>



                            </div>
                            <div class="col-md-4">

                                <center><b><label for="floatingName"> عدد الرسائل </label></b></center>

                                <div class="form-floating">

                                    <input type="text" class="form-control" name="count_msg" id="floatingName" placeholder="Your Name">
                                    <label for="floatingName"> </label>
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="col-md-12">

                                <div class="input-group">
                                    <span class="input-group-text">Device ID</span>
                                    <textarea class="form-control" name="device_id" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <br><br><br><br>                    <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text">TOKEN</span>
                                    <textarea class="form-control" name="token" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <br><br><br><br>                    <div class="col-md-12">

                                <center><b><label for="floatingName"> حالة الرقم</label></b></center>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="states" id="gridRadios1"  value="up" checked>
                                            <b><label class="form-check-label text-success" for="gridRadios1">
                                                    فعال
                                                </label></b>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="states" id="gridRadios2"     value="down" >
                                            <b><label class="form-check-label text-danger" for="gridRadios2">
                                                    غير فعال
                                                </label></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" >حفظ رقم الهاتف</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <livewire:admin.notifications />
@endsection


@livewireScripts
</body>
