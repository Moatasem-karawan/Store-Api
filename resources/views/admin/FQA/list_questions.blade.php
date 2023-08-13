@extends("layout.Cover")
@section("content")

    <section class="section" style="direction: rtl">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form For Add Question</h5>

                        <!-- General Form Elements -->
                        <form action="{{route("save_fqa")}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Question</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="question">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Answer</label>
                                <div class="col-sm-10">
                                    <textarea type="email" class="form-control" style="height: 100px" name="answer"></textarea>
                                </div>

                            </div><button class="btn btn-danger" type="submit">Save</button></form>
                    </div></div></div></div></section>
    <section class="section">
        <div class="row">
            @if($fqa->count()!=0)
            @foreach($fqa as $item)
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <u><h5 class="card-title">{{$item->question}}</h5></u>
                            <p>{{$item->answer}}</p>

                            <!-- Basic Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                تعديل
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                                حذف
                            </button>
                            <div class="modal fade" id="basicModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Basic Modal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Text</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                            <button type="button" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Basic Modal-->

                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-danger">لم يتم اضافة اي سؤال</div>
                @endif
        </div></section>

    @endsection
