@extends('admin.layout.app')

@section('content')

    @include('admin.inc.sidebar')

    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Home Package Manage</h3>
        </div>
        <hr class="my-0">

        <form method="post" id="upload_form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="p-3 h-100 overflow-auto">
                <label for="inputCategory"><b>Home Product Image</b></label>
                <div class="image w-100 text-center" onclick="chooseFile()" id="previewImage">
                    <div class="mt-5">
                        <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                        Product Image
                    </div>
                </div>
                <input type="file" name="ProductPic" class="ImageUpload d-none">
                <input type="text" id="itemId" name="itemId" class="d-none">          
          <!--       <br>
                <label for="inputCategory"><b>Notification Image </b></label>
                <div class="image w-100 text-center" onclick="chooseFile_2()" id="previewImage_2">
                    <div class="mt-5">
                        <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                        Add a Notification Image
                    </div>
                </div> 
                <input type="file" name="promo_image" class="ImageUpload_2 d-none">  -->          


                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                             <label for="inputCategory" class="sr-only">Name</label>
                            <input type="text" class="form-control w-100" name="product_name" id="product_name" placeholder="Enter product name">
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
                    <h3 class="page-title">Home Product Manage</h3>
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
                                    <th scope="col" class="border-0">Name</th> 
                                    <th scope="col" class="border-0">Price</th>            
                                    <th scope="col" class="border-0">Point</th>
                                    <th scope="col" class="border-0">image</th>
                                    <th scope="col" class="border-0">Quantity</th>
                                    <th scope="col" class="border-0">Package Quantity</th>
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

        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');

                $('#product_name').val('');                
                $('#price').val('');
                $('#point').val('');
                $('#quantity').val('');                 
                $('#delivery_quantity').val('');         
                $('#ProductPic').val('');         
                $('#itemId').val('');         
                $('#InputHeader').html('Product Insert');    
                $('#previewImage').html('<div class="mt-5"><i class="fas fa-cloud-upload-alt fs-25"></i><br>Add a product Image     </div>');       
            });
        });


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
                    url: "{{ url('admin/home-product-insert') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'Update!',
                                'Product updated Successfully',
                                'success'
                            )
                        } else if(data == 2){
                            Swal.fire(
                                'Insert!',
                                'Product inserted Successfully',
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
                ajax: "{{ url('admin/home-product-view') }}",
                columns: [                   
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},                  
                    {data: 'product_name'},   
                    {data: 'price'},               
                    {data: 'point'},               
                    {data: 'image'},                       
                    {data: 'quantity'},               
                    {data: 'delivery_quantity'},                      
                    {data: 'action'}                  
                                
                ]
            });

            $(document).on('click', '.view', function () {
                let id = $(this).attr('id');
                $('#AddSubcategory').prop('disabled',true);
                $.ajax({
                    url: "{{ url('admin/home-view-single-product') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $(".modalText").html('<div class="row">\n' +
                            '                        <div class="col-12 col-lg-6"><img src="images/'+data.logo+'" class="mr-3 img-fluid w-100"></div>\n' +
                            '                        <div class="row col-12 col-lg-6 px-0 mx-0">\n' +
                            '                            <div class="col-6 text-right">Name : </div><div class="col-6">'+data.product_name+'</div>\n' +
                            '                            <div class="col-6 text-right">Price : </div><div class="col-6">'+data.price+'</div>\n' +
                            '                            <div class="col-6 text-right">Point : </div><div class="col-6">'+data.point+'</div>\n' +
                            '                            <div class="col-6 text-right">Stock :</div><div class="col-6">'+data.quantity+'</div>\n' +
                            '                            <div class="col-6 text-right">Package Quantity :</div><div class="col-6">'+data.delivery_quantity+'</div>\n' +
                            
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    '+data.created.date+'\n' +
                            '                    <p></p>');
                        $('#exampleModal').modal('show');
                        console.log(data.created.date);
                    }
                });
            });


            $(document).on('click', '.edit', function ()  {
                $('.collapse').collapse('show');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('admin/home-product-edit') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('#sidebar').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                        $('#InputHeader').html('Product Update');
                        $('#previewImage').html('<img src="images/'+data.logo+'" class="img-thumbnail h-100 mx-auto" id="previewLogo">');                              
                        console.log(data);
                        $('#product_name').val(data.product_name);                
                        $('#price').val(data.price);
                        $('#point').val(data.point);
                        $('#quantity').val(data.quantity);                 
                        $('#delivery_quantity').val(data.delivery_quantity);                 
                        $('#itemId').val(data.id);                
                        
                        $('#InputButton').html('<button type="submit" class="btn btn-primary w-75 mx-auto mt-4 UpdateProduct">Update</button>');
                    }
                });
            });
        });
    </script>


@endsection
