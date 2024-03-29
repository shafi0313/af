@extends('admin.layout.app')
@section('content')
    @include('admin.inc.sidebar')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>


    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Requested Payment Approval</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">

                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">No</th>
                                        <th scope="col" class="border-0">Student Name</th>
                                        <th scope="col" class="border-0">Comment</th>
                                        <th scope="col" class="border-0">Recept Date</th>
                                        <th scope="col" class="border-0">Month</th>
                                        <th scope="col" class="border-0">Year</th>
                                        <th scope="col" class="border-0">Monthly Fee Amount</th>
                                        <th scope="col" class="border-0">Ttl Approved Amount</th>
                                        <th scope="col" class="border-0">Status</th>
                                        <th scope="col" class="border-0">Created</th>
                                        <th scope="col" class="border-0">Image</th>
                                        <th scope="col" class="border-0">Action</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Requested Payment Approval</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modalText">
                </div>
            </div>
        </div>
    </div>
<!-- Include Moment.js -->


    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
                        $("#short_details").val('');
                        $('#previewImage').html(' ');
                        $('#summernote').summernote('code', ' ');
                        table.ajax.reload();
                        $('#sidebar').removeClass('active');
                        $('.overlay').removeClass('active');
                    }

                })
            });

            $(function() {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                aLengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                ajax: "{{ route('admin.request-payment-approval.index') }}",
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
                        data: 'recept_date',
                    },
                    {
                        data: 'month'
                    },
                    {
                        data: 'year'
                    },
                    {
                        data: 'monthly_fee_amount'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'image'
                    },
                    {
                        data: 'action',
                        width: '130px',
                    }


                ]
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
    </script>
@endsection
