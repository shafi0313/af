@extends('admin.layout.app')

@section('content')

    @include('admin.inc.sidebar')

    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Registration Forms</h3>
        </div>
        <hr class="my-0">    
    </nav>
    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Registration Forms</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">                    
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">No</th>
                                    <th scope="col" class="border-0">Student Name</th> 
                                    <th scope="col" class="border-0">Father Name</th> 
                                    <th scope="col" class="border-0">Mother Name</th>
                                    <th scope="col" class="border-0">Village</th>
                                    <th scope="col" class="border-0">Status</th>
                                    <th scope="col" class="border-0">Updated At</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
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



        $(document).on('click', '.delete', function () {
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
                            url: "{{ url('admin/delete_item') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    Swal.fire(
                                        'Deleted!',
                                        'This Product has been deleted.',
                                        'success'
                                    )
                                     ajax.reload();
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
                    url: "{{ url('admin/product-insert') }}",
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
                ajax: "{{ url('registration-list') }}",
                columns: [                   
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},                  
                    {data: 'student_name'},   
                    {data: 'father_name'}, 
                    {data: 'mother_name'},                          
                    {data: 'gram'},                          
                    {data: 'status'},                          
                    {data: 'updated_at'},                          
                    {data: 'action'}                          
                ]
            });

            $(document).on('click', '.view', function () {
                let id = $(this).attr('id');
                $('#AddSubcategory').prop('disabled',true);
                $.ajax({
                    url: "{{ url('admin/view-single-product') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $(".modalText").html('<table width="100%" border="0">'+
                        '<tr><td width="52%" align="left">Student Name (ছাত্র/ছাত্রীর নাম) </td><td width="1%" align="center">:</td><td width="47%" align="left">  '+data.student_name+'</td></tr>' +
                        '<tr><td width="52%" align="left">Father Name(পিতার নাম) </td><td width="1%" align="center">:</td><td width="47%" align="left">  '+data.father_name+'</td></tr>' +
                        '<tr><td width="52%" align="left">Mother Name(মাতার নাম) </td><td width="1%" align="center">:</td><td width="47%" align="left">  '+data.mother_name+'</td></tr>' +
                        '<tr><td width="52%" align="left">Village (গ্রাম) </td><td width="1%" align="center">:</td><td width="47%" align="left">  '+data.gram+'</td></tr>' +
                        '<tr><td width="52%" align="left">Post Office (পোস্টঃ অফিসঃ)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.post_office+'</td></tr>' +
                        '<tr><td width="52%" align="left">Police Station(থানা)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.thana+'</td></tr>' +
                        '<tr><td width="52%" align="left">Disctrict(জেলা)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.disctrict+'</td></tr>' +
                        '<tr><td width="52%" align="left">Mobile No(মোবাইল নাম্বার)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.phone+'</td></tr>' +
                        '<tr><td width="52%" align="left">Email(ইমেইল)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.email+'</td></tr>' +
                        '<tr><td width="52%" align="left">Emergency Mobile No(জরুরী কন্টাক্ট নাম্বার)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.phone2+'</td></tr>' +
                        '<tr><td width="52%" align="left">Financcial Condition(আর্থিক অবস্থার বর্ণনা)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.finance+'</td></tr>' +
                        '<tr><td width="52%" align="left">School/Madrasha Name(শিক্ষা প্রতিষ্ঠানের নাম)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.school+'</td></tr>' +
                        '<tr><td width="52%" align="left">Year/Class(অধ্যায়ন শ্রেণীর নামঃ)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.class+'</td></tr>' +
                        '<tr><td width="52%" align="left">School Fee P/M(মাসিক বেতন)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.fee+'</td></tr>' +
                        '<tr><td width="52%" align="left">Admission Fee(এডমিশন ফিঃ)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.admission_fee+'</td></tr>' +
                        '<tr><td width="52%" align="left">Board Reg Fee(বোর্ড রেজিস্ট্রেশন ফি)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.board_reg_fee+'</td></tr>' +
                        '<tr><td width="52%" align="left">Book Purchase(বই পত্র ক্রয়)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.book_purchase+'</td></tr>' +
                        '<tr><td width="52%" align="left">Exam Fee 1(পরীক্ষার ফি ১)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.exm_fee1+'</td></tr>' +
                        '<tr><td width="52%" align="left">Exan Fee 2(পরীক্ষার ফি ২)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.exm_fee2+'</td></tr>' +
                        '<tr><td width="52%" align="left">Exam Fee 3(পরীক্ষার ফি ৩)   </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.exm_fee3+'</td></tr>' +
                        '<tr><td width="52%" align="left">Family Member(পরিবারের সদস্য সংখ্যাঃ)  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.member+'</td></tr>' +
                        '<tr><td width="52%" align="left">Total Family Income(পরিবারের সর্বমোট মাসিক আয়) </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.income+'</td></tr>' +
                        '<tr><td width="52%" align="left">Student Photo(ছাত্র/ছাত্রীর ছবি)  </td><td width="1%" align="center">:</td><td width="47%" align="left"> <a target="_blank" href="https://afwelfaretrust.org/documents/'+data.student_image+'">Download</a></td></tr>' +
                        '<tr><td width="52%" align="left">Student ID Card(ছাত্র/ছাত্রীর আইডি কার্ড)  </td><td width="1%" align="center">:</td><td width="47%" align="left"><a target="_blank" href="https://afwelfaretrust.org/documents/'+data.student_idcard+'">Download</a></td></tr>' +
                        '<tr><td width="52%" align="left">Parents NID(পিতা/মাতার জাতীয় পরিচয় পত্র )  </td><td width="1%" align="center">:</td><td width="47%" align="left"><a target="_blank" href="https://afwelfaretrust.org/documents/'+data.parent_idcard+'">Download</a></td></tr>' +
                        '<tr><td width="52%" align="left">Charimen Certificate(চেয়ারম্যান প্রদত্ত চারিত্রিক সনদ)  </td><td width="1%" align="center">:</td><td width="47%" align="left"><a target="_blank" href="https://afwelfaretrust.org/documents/'+data.charac_cer+'">Download</a></td></tr>' +
                        '<tr><td width="52%" align="left">Last Year Marksheet(বিগত বছরের মার্কশীট)  </td><td width="1%" align="center">:</td><td width="47%" align="left"><a target="_blank" href="https://afwelfaretrust.org/documents/'+data.marksheet+'">Download</a></td></tr>' +
                        '<tr><td width="52%" align="left">Principle Certificate(বেতন ও আনুসাঙ্গিক ব্যয় প্রতিষ্ঠান প্রধানের দ্বারা সত্যায়ন পত্র)  </td><td width="1%" align="center">:</td><td width="47%" align="left"><a target="_blank" href="https://afwelfaretrust.org/documents/'+data.document+'">Download</a></td></tr>' +
                        '<tr><td width="52%" align="left">Registration Date  </td><td width="1%" align="center">:</td><td width="47%" align="left">'+data.created.date+'</td></tr>' +                            
						'</table>');
                        $('#exampleModal').modal('show');
                        console.log(data.created.date);
                        
                    }
                });
            });


            $(document).on('click', '.ok', function () {
                let id = $(this).attr('id');
                $('#AddSubcategory').prop('disabled',true);
                $.ajax({
                    url: "{{ url('admin/status_update') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (response) {
                            if (response == 1) {
                                    Swal.fire(
                                        'Updated!',
                                        'This is approved.',
                                        'success'
                                    )
                                     ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        'Something Wrong',
                                        'error'
                                    )
                            }
                    }
                });
            });


            $(document).on('click', '.no', function () {
                let id = $(this).attr('id');
                $('#AddSubcategory').prop('disabled',true);
                $.ajax({
                    url: "{{ url('admin/status_update_no') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (response) {
                            if (response == 1) {
                                    Swal.fire(
                                        'Updated!',
                                        'This is canceled.',
                                        'success'
                                    )
                                     ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        'Something Wrong',
                                        'error'
                                    )
                            }
                    }
                });
            });


            $(document).on('click', '.edit', function ()  {
                $('.collapse').collapse('show');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('admin/product-edit') }}",
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
                        $('#category').val(data.category);
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
