@extends("layout.Cover")
@section("content")
<section>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Basic Modal</h5>
            <p>Toggle a working modal demo by clicking the button below. It will slide down and fade in from the top of the page</p>

            <!-- Basic Modal -->
            <button type="button"  class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#basicModal">
                Basic Modal
            </button>
            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{route("store_category")}}" enctype="multipart/form-data" method="post">
                        @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Basic Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="direction: rtl">

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">عنوان الصنف</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                 </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">الوصف</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="description" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Your Name</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="files[]" multiple required>
                                </div>
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
                    </form>
            </div>

            </div><!-- End Basic Modal-->

        </div>
    </div>


    <div class="col-lg-12" style="direction: rtl">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Table with all category</h5>
                <div class="table-responsive-lg">

                <!-- Table with stripped rows -->
                <table class="table table-striped table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">العنوان</th>
                        <th scope="col">الوصف</th>
                        <th>ملاحظات</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categorys as $category)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$category->title}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <div class="row">

                                    <div class="col-xl">
                                        <a href="{{route('show_all_products_two_type',$category->id)}}" class="badge bg-success">كل المشاريع</a>

                                    </div>


                                    <div class="col-xl">
                                        <a href="#"><li class="bi bi-trash-fill text-danger"></li></a>


                                    </div>
                                    <div class="col-xl">
                                        <a href="#"><li class="bi bi-pencil-square text-success"></li></a>


                                    </div>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
                </div>

            </div>
        </div>

    </div>

</section>

@endsection
