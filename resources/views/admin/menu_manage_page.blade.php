@extends('admin.layout.app')

@section('content')
    @include('admin.inc.sidebar')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h5 id="InputHeader">Requesting Approved Fund Requisition</h5>
        </div>
        <hr class="my-0">

        <form method="post" id="upload_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="">
            <div class="p-3 h-100 overflow-auto side-bar">
                @php
                    $students = DB::table('users')
                        ->orderby('id', 'desc')
                        ->get();
                @endphp
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="inputCategory" class="sr-only"></label>
                        <select name="type" id="type" class="form-control select2singleModel" required="required">
                            <option value="">Select Students</option>
                            @foreach ($students as $v)
                                @php
                                    $order = DB::table('order')
                                        ->where('student_id', $v->id)
                                        ->first();
                                @endphp
                                <option value="{{ $v->id }}" price="{{ @$order->aprv_amnt }}">{{ $v->student_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="image w-100 text-center" onclick="chooseFile()" id="previewImage">
                    <div class="mt-5">
                        <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                        Document
                    </div>
                </div>
                <input type="file" name="ProductPic" class="ImageUpload d-none">
                <input type="text" id="itemId" name="itemId" class="d-none">

                {{-- <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="" class="sr-only">Approved Amount</label>
                        <input type="text" class="form-control w-100" id="aproved" disabled>
                    </div>
                </div> --}}

                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label>Amount</label>
                        <input type="text" class="form-control w-100" name="title" id="title"
                            placeholder="Enter Amount" required>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label>Recept Date</label>
                        <input type="date" class="form-control w-100" name="recept_date" id="recept_date" required>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label>Month</label>
                        <input type="text" class="form-control w-100" name="month" id="month" required>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label>Monthly Fee Amount</label>
                        <input type="text" class="form-control w-100" name="monthly_fee_amount" id="monthly_fee_amount" required>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label>Year</label>
                        <input type="text" class="form-control w-100" name="year" id="year" required>
                    </div>
                </div>

                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="inputCategory" class="sr-only"></label>
                        <textarea class="emptydetails form-control" name="long_details" id="summernote" placeholder="Description"></textarea>
                    </div>
                </div>

            </div>
            <div class="row border-top" id="InputButton">
                <button type="submit" class="btn btn-primary w-75 mx-auto mt-4 addProduct">Save</button>
            </div>
        </form>
    </nav>

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Requesting Approved Fund Requisition</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <button type="button" id="sidebarCollapse" class="btn btn-info float-right">
                                <i class="fas fa-plus"></i>
                                <span>Add </span>
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">No</th>
                                        <th scope="col" class="border-0">Student Name</th>
                                        <th scope="col" class="border-0">Comment</th>
                                        <th scope="col" class="border-0">Amount</th>
                                        <th scope="col" class="border-0">Recept Date</th>
                                        <th scope="col" class="border-0">Month Name</th>
                                        <th scope="col" class="border-0">Monthly Fee Amt</th>
                                        <th scope="col" class="border-0">Year</th>
                                        <th scope="col" class="border-0">Status</th>
                                        <th scope="col" class="border-0">Receipt View</th>
                                        <td scope="col" class="border-0">Action</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Requesting Approved Fund Requisition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modalText">
                </div>
            </div>
        </div>
    </div>

    


    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $(function() {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('menu-manage-view') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'student_name'
                    },
                    {
                        data: 'long_details'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'recept_date'
                    },
                    {
                        data: 'monthly_fee_amount'
                    },
                    {
                        data: 'month'
                    },
                    {
                        data: 'year'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'action'
                    }


                ]
            });
        });

        $('#summernote').summernote({
            placeholder: 'Enter your details',
            tabsize: 3,
            height: 200
        });

        $('#type').on('change', function() {
            let price = $('#type option:selected').attr('price');
            $('#aproved').val(price);
        });
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                $('#id').val('');
                $('#title').val('');
                $('#recept_date').val('');
                $('#short_details').val('');
                $('.emptydetails').val('');
                $("#id").val(' ');
                $("#itemId").val('');
                $("#type").val('');
                $("#title").val('');
                $("#short_details").val('');

                $('#summernote').summernote('code', ' ');
            });


        });

        function chooseFile() {
            $(".ImageUpload").click();
        }

        $(function() {
            $(".ImageUpload").change(function() {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    $('#previewImage').html(
                        '<img src="" class="img-thumbnail h-100 mx-auto" id="previewLogo">');
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#previewLogo').attr('src', e.target.result);
        }

        $(document).ready(function() {
            $('#upload_form').on('submit', function() {
                event.preventDefault();
                $('.addProduct').attr('disabled', 'true');
                $.ajax({
                    url: "{{ url('menu-manage-insert') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function(data) {
                        if (data == 2) {
                            Swal.fire(
                                'Insert!',
                                'Fund request success. Please wait for admin approval',
                                'success'
                            )
                        } else if (data == 1) {
                            Swal.fire(
                                'Update!',
                                'Menu Updated',
                                'success'
                            )
                        } else {
                            Swal.fire({
                                title: 'Image cant be larger than 1000kb !',
                                html: data,
                            })
                        }
                        $("#id").val(' ');
                        $("#itemId").val('');
                        $("#type").val('');
                        $("#title").val('');
                        $("#recept_date").val('');
                        $("#short_details").val('');
                        $('#previewImage').html(' ');
                        $('#summernote').summernote('code', ' ');
                        table.ajax.reload();
                        $('#sidebar').removeClass('active');
                        $('.overlay').removeClass('active');
                    }

                })
            });

            $(document).on('click', '.delete', function() {
                let id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ff4040',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('menu-manage-delete') }}",
                            type: 'get',
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This Menu has been deleted.',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        'Something Wrong',
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            });

            $(document).on('click', '.edit', function() {
                $('.collapse').collapse('show');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('menu-manage-edit') }}",
                    type: 'get',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#sidebar').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                        $('#InputHeader').html('Update basic info');
                        $('#previewImage').html('<img src="images/' + data.image +
                            '" class="img-thumbnail h-100 mx-auto" id="previewLogo">');
                        console.log(data);
                        $('#id').val(data.id);
                        $('#title').val(data.title);
                        $('#recept_date').val(data.recept_date);
                        $('#type').val(data.type);
                        $('#short_details').val(data.short_details);

                        $('#summernote').summernote('code', data.long_details);
                        $('#InputButton').html(
                            '<button type="submit" class="btn btn-primary w-75 mx-auto mt-4 UpdateProduct">Update</button>'
                        );
                    }
                });
            });
        });

        $('#sidebarCollapse').on('click', function() {
            $('.addProduct').removeAttr('disabled');
        })
    </script>
@endsection
