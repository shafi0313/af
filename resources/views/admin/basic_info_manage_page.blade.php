@extends('admin.layout.app')

@section('content')

        @include('admin.inc.sidebar')


    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Basic info</h3>
        </div>
        <hr class="my-0">

        <form method="post" id="upload_form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="p-3 h-100 overflow-auto">
                <label for="inputCategory"><b>Logo</b></label>
                <div class="image w-100 text-center" onclick="chooseFile()" id="previewImage">
                    <div class="mt-5">
                        <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                        Add a website Logo
                    </div>
                </div>
                <input type="file" name="ProductPic" class="ImageUpload d-none">
                <input type="text" id="itemId" name="itemId" class="d-none">          
                <br>
                <label for="inputCategory"><b>Contact Us Image </b></label>
                <div class="image w-100 text-center" onclick="chooseFile_2()" id="previewImage_2">
                    <div class="mt-5">
                        <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                        Add a Contact Us Image
                    </div>
                </div>
                <input type="file" name="promo_image" class="ImageUpload_2 d-none">
            
                <div class="row px-0 mx-0 my-2">
                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only">Website</label>
                            <input type="text" class="form-control w-100" name="website_title" id="website_title" placeholder="Website Title">
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                         <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="mobile" id="mobile" placeholder="Enter Mobile">
                        </div>
                    </div>
                </div>
                
                <div class="row px-0 mx-0 my-2">
                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="email" class="form-control w-100" name="email" id="email" placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                         <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="web_address" id="web_address" placeholder="Enter web address">
                        </div>
                    </div>
                </div>

                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="inputCategory" class="sr-only"></label>
                        <input type="text" class="form-control w-100" placeholder="Enter address" name="address" id="address">
                    </div>
                </div>
                
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="inputCategory" class="sr-only"></label>
                        <input type="text" class="form-control w-100" placeholder="Enter Notice" name="notice" id="notice">
                    </div>
                </div>


                <div class="row px-0 mx-0 my-2" style="display: none;">
                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="withdraw_charge" id="withdraw_charge" placeholder="Enter withdrawal charge" value="0">
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                         <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="wall_move_charge" id="wall_move_charge" placeholder="Enter wallet move charge" value="0">
                        </div>
                    </div>
                </div>

                 <div class="row px-0 mx-0 my-2" style="display: none;">
                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="wall_tran_charge" id="wall_tran_charge"
                                   placeholder="Enter wallet transfer charge" value="0">
                        </div>
                    </div>

                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="profit_share_charge" id="profit_share_charge" placeholder="Enter profit distribute percent" value="0">
                        </div>
                    </div>         
                </div>

               <div class="row px-0 mx-0 my-2" style="display: none;">
                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>BTC Amount
                            <input value="0" type="text" class="form-control w-100" name="btc_amount" id="btc_amount"
                                   placeholder="Enter Registration Amount">
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                         <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>BTC Address
                            <input value="0" type="text" class="form-control w-100" name="btc_wallet" id="btc_wallet"
                                   placeholder="Enter BTC Wallet Address">
                        </div>
                    </div>
                </div>


                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="inputCategory" class="sr-only"></label>
                        <input type="text" class="form-control w-100" placeholder="Enter currency sign" name="currency" id="currency">
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
                    <h3 class="page-title">Basic Info</h3>
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
                                    <th scope="col" class="border-0">Title</th> 
                                    <th scope="col" class="border-0">Mobile</th>            
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">image</th>
                                    <th scope="col" class="border-0">With Charge</th>
                                    <th scope="col" class="border-0">Wall Move Charge</th>
                                    <th scope="col" class="border-0">Wall tran Charge</th>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Information</h5>
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

        function chooseFile() {
            $(".ImageUpload").click();
        }

        $(function () {
            $(".ImageUpload").change(function () {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    $('#previewImage').html('<img src="" class="img-thumbnail h-100 mx-auto" id="previewLogo">');
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#previewLogo').attr('src', e.target.result);
        }


        function chooseFile_2() {
            $(".ImageUpload_2").click();
        }

        $(function () {
            $(".ImageUpload_2").change(function () {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    $('#previewImage_2').html('<img src="" class="img-thumbnail h-100 mx-auto" id="previewLogo_2">');
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded_2;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded_2(e) {
            $('#previewLogo_2').attr('src', e.target.result);
        }

        $('#CategoryId').change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ url('subcategory-select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN, id: id},
                dataType: 'json',
                success: function (data) {
                    $('#SubcategoryId').html('');
                    data.forEach(function (element) {
                        $('#SubcategoryId').append($('<option>', {value: element.id, text: element.subcategory_name}));
                    });
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        });


        $(document).ready(function () {
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('admin/basic_update') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'Update!',
                                'Basic info updated Successfully',
                                'success'
                            )
                        }else{
                            Swal.fire({
                                title: 'Image cant be larger than 200kb !',
                                html: data,
                            })
                        }

                        table.ajax.reload();
                        $('#sidebar').removeClass('active');
                        $('.overlay').removeClass('active');
                    }

                })
            });

            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/basic-info-view') }}",
                columns: [                   
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},                  
                    {data: 'website_title'},   
                    {data: 'mobile'},               
                    {data: 'email'},               
                    {data: 'image'},                       
                    {data: 'withdraw_charge'},               
                    {data: 'wall_move_charge'},               
                    {data: 'wall_tran_charge'},              
                    {data: 'action'}                  
                                
                ]
            });

            $(document).on('click', '.view', function () {
                let id = $(this).attr('id');
                $('#AddSubcategory').prop('disabled',true);
                $.ajax({
                    url: "{{ url('view-single-product') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $(".modalText").html('<div class="row">\n' +
                            '                        <div class="col-12 col-lg-6"><img src="storage/product/'+data.pic+'" class="mr-3 img-fluid w-100"></div>\n' +
                            '                        <div class="row col-12 col-lg-6 px-0 mx-0">\n' +
                            '                            <div class="col-6 text-right">Category : </div><div class="col-6">'+data.category+'</div>\n' +
                            '                            <div class="col-6 text-right">Subcategory : </div><div class="col-6">'+data.subcategory+'</div>\n' +
                            '                            <div class="col-6 text-right">Item Name : </div><div class="col-6">'+data.name+'</div>\n' +
                            '                            <div class="col-6 text-right">Manufacturer :</div><div class="col-6">'+data.manufacturer+'</div>\n' +
                            '                            <div class="col-6 text-right">Unit :</div><div class="col-6">'+data.unit+'</div>\n' +
                            '                            <div class="col-6 text-right">Status : </div><div class="col-6">'+data.status+'</div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    '+data.created.date+'\n' +
                            '                    <p>'+data.description+'</p>');
                        $('#exampleModal').modal('show');
                        console.log(data.created.date);
                    }
                });
            });


            $(document).on('click', '.edit', function ()  {
                $('.collapse').collapse('show');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('admin/basic-info-edit') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('#sidebar').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                        $('#InputHeader').html('Update basic info');
                        $('#previewImage').html('<img src="images/'+data.logo+'" class="img-thumbnail h-100 mx-auto" id="previewLogo">');
                        
                        $('#previewImage_2').html('<img src="images/'+data.promo_image+'" class="img-thumbnail h-100 mx-auto" id="previewLogo_2">');
                        console.log(data);
                        $('#website_title').val(data.website_title);                
                        $('#mobile').val(data.mobile);
                        $('#email').val(data.email);
                        $('#web_address').val(data.web_address);
                        $('#address').val(data.address);
                        $('#notice').val(data.notice);
                        $('#withdraw_charge').val(data.withdraw_charge);
                        $('#wall_move_charge').val(data.wall_move_charge);
                        $('#wall_tran_charge').val(data.wall_tran_charge);
                        $('#profit_share_charge').val(data.profit_share_charge);
                        $('#itemId').val(data.id);
                        $('#btc_amount').val(data.btc_amount);
                        $('#btc_wallet').val(data.btc_wallet);
                        $('#currency').val(data.currency);
                        
                        $('#InputButton').html('<button type="submit" class="btn btn-primary w-75 mx-auto mt-4 UpdateProduct">Update</button>');
                    }
                });
            });
        });
    </script>


@endsection
