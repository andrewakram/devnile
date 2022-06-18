@extends('supervisor.index')

@section('style')

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <!-- Bootstrap-Iconpicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css" integrity="sha512-0SX0Pen2FCs00cKFFb4q3GLyh3RNiuuLjKJJD56/Lr1WcsEV8sOtMSUftHsR6yC9xHRV7aS0l8ds7GVg6Xod0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{--    <link rel="stylesheet" href="{{asset('admin')}}/dist/assets/css/bootstrap-iconpicker.min.css"/>--}}
@endsection

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center fw-bolder fs-3 my-1" style="color: #5482d5">
                        تعديل منتج
                    </h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('supervisor.home')}}" class="text-muted text-hover-primary">الرئيسية</a>
                        </li>
                        <!--end::Item-->
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('supervisor.products')}}" class="text-muted text-hover-primary">الاقسام</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->
                <form action="{{route('supervisor.products.update')}}" method="post" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" >
                @csrf
                    <input type="hidden" name="row_id" value="{{$row->id}}">
                <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>الصورة</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url({{$row->MainImage->image}})"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="إختر الصورة">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="main_image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden"  />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="إلغاء الصورة">
														<i class="bi bi-x fs-2"></i>
													</span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف الصورة">
														<i class="bi bi-x fs-2"></i>
													</span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Description-->
                                <div class="text-danger fs-7"> *.png - *.jpg - *.jpeg </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->

                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>القسم</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-info w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                </div>
                                <!--begin::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select2-->
                                <select name="category_id" required
                                        class="category_id form-select p-5 m-5"
                                        data-control="" data-hide-search="false"
                                        data-placeholder="إختر القسم">
                                    <option></option>
                                    @foreach($categories as $key => $category)
                                        <option
                                            value="{{$category->id}}" {{$category->id == $row->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                                <!--begin::Description-->
                            {{--                                <div class="text-muted fs-7">Set the product status.</div>--}}
                            <!--end::Description-->
                                <!--begin::Datepicker-->
                            {{--                                <div class="d-none mt-10">--}}
                            {{--                                    <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select publishing date and time</label>--}}
                            {{--                                    <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />--}}
                            {{--                                </div>--}}
                            <!--end::Datepicker-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                    <!--end::Aside column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>بيانات المنتج</h2>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">إسم المنتج</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="name" class="form-control mb-2"
                                                       placeholder="إسم المنتج" value="{{$row->name}}"/>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                            </div>
                                            <!--end::Input group-->


                                        </div>
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">وصف المنتج</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <textarea name="description" placeholder="وصف المنتج" class="form-control mb-2">{{$row->description}}</textarea>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->

                                </div>
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                        <div class="clearfix"></div>
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-12 gap-lg-12">
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general2"
                                     role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <!--begin::General options-->
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <button id="add-addition" type="button" class="btn btn-success">
                                                        <i class="fa fa-plus"></i>
                                                        إضافة صورة إضافية أخري
                                                    </button>
                                                </div>
                                            </div>
                                            <br>

                                            <!--begin::Card body-->
                                            <div class="card-body append-div pt-0">




                                            </div>
                                            <hr>
                                            @foreach($row->Images as $item)
                                                @if($item->type == 'sub')
                                                    <!--begin::Thumbnail settings-->
                                                    <div class="card card_{{$item->id}} card-flush py-4">
                                                        <!--begin::Card header-->
                                                        <div class="card-header">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
                                                                <h2>الصورة</h2>
                                                            </div>
                                                            <!--end::Card title-->
                                                        </div>
                                                        <!--end::Card header-->
                                                        <!--begin::Card body-->
                                                        <div class="card-body text-center pt-0">
                                                            <!--begin::Image input-->
                                                            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="display: inline-block">
                                                                <!--begin::Preview existing avatar-->
                                                                <div class="image-input-wrapper w-150px h-150px" style="background-image: url({{$item->image}})">
                                                                    <a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="{{$item->id}}"  title="حذف">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <!--end::Image input-->

                                                        </div>
                                                        <!--end::Card body-->

                                                    </div>
                                                    <!--end::Thumbnail settings-->
                                                @endif
                                            @endforeach
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->

                                    </div>
                                </div>
                                <!--end::Tab pane-->
                            </div>

                        </div>
                        <!--end::Main column-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('supervisor.products')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">عودة</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">حفظ</span>
                                <span class="indicator-progress">إنتظر قليلا . . .
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

@endsection

@section('script')

    <script>
        $(document).on("click", "#add-addition", function () {
            plus_item();
        });

        $(document).on("click", ".delete-addition", function () {
            $( this ).closest( ".addition" ).remove();
        });

        function plus_item() {
            var new_item = '<div class="image-input image-input-empty image-input-outline m-5 p-5"\n' +
                '                                     data-kt-image-input="true"\n' +
                '                                     >\n' +
                '                                    <!--begin::Preview existing avatar-->\n' +
                '                                    <div class="image-input-wrapper w-150px h-150px"></div>\n' +
                '                                    <!--end::Preview existing avatar-->\n' +
                '                                    <!--begin::Label-->\n' +
                '                                    <label\n' +
                '                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"\n' +
                '                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"\n' +
                '                                        title="إختر الصورة">\n' +
                '                                        <i class="bi bi-pencil-fill fs-7"></i>\n' +
                '                                        <!--begin::Inputs-->\n' +
                '                                        <input type="file" name="image[]" accept=".png, .jpg, .jpeg"/>\n' +
                '                                        <input type="hidden" name="avatar_remove"/>\n' +
                '                                        <!--end::Inputs-->\n' +
                '                                    </label>\n' +
                '                                    <!--end::Label-->\n' +
                '                                    <!--begin::Cancel-->\n' +
                '                                    <span\n' +
                '                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"\n' +
                '                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"\n' +
                '                                        title="إلغاء الصورة">\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="bi bi-x fs-2"></i>\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t</span>\n' +
                '                                    <!--end::Cancel-->\n' +
                '                                    <!--begin::Remove-->\n' +
                '                                    <span\n' +
                '                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"\n' +
                '                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="حذف الصورة">\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class="bi bi-x fs-2"></i>\n' +
                '\t\t\t\t\t\t\t\t\t\t\t\t\t</span>\n' +
                '                                    <!--end::Remove-->\n' +
                '</div>';

            $('.append-div').append(new_item);
        }
    </script>

    {{-- Delete --}}
    <script>
        $(document).on("click", ".delete", function () {
            var row_id = $(this).data('id');
            $(".modal-body #row_id").val(row_id);
        });

        $('.delete_btn').on('click',function () {
            $('#delete_form').submit();
        })
    </script>

    <script>
        $(document).on("click", ".delete", function () {
            var id = $(this).data('id');
            var btn = $(this);
            Swal.fire({
                title: "تحذير.هل انت متأكد؟!",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f64e60",
                confirmButtonText: "نعم",
                cancelButtonText: "لا",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function (result) {
                if (result.value) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{route('supervisor.products.image.delete')}}',
                        type: "post",
                        data: {'row_id':  id, _token: CSRF_TOKEN},
                        dataType: "JSON",
                        success: function (data) {
                            if (data.message == "Success") {
                                $(".card_"+id).remove();
                                Swal.fire("نجاح", "تم الحذف بنجاح", "success");
                                // location.reload();
                            } else {
                                Swal.fire("نأسف", "حدث خطأ ما اثناء الحذف", "error");
                            }
                        },
                        fail: function (xhrerrorThrown) {
                            Swal.fire("نأسف", "حدث خطأ ما اثناء الحذف", "error");
                        }
                    });
                    // result.dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                } else if (result.dismiss === 'cancel') {
                    Swal.fire("ألغاء", "تم الالغاء", "error");
                }
            });
        });

    </script>
@endsection
