@extends('frontend.layout.master')
@section('title', 'Select Activity')
@section('content')
    <?php $p = 'cb';
    $mp = 'acccounts'; ?>
    <!-- Page Content Start -->
    <section class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Content End -->
    
    <!-- Footer Start -->

    <!-- Footer End -->
    <script>
        $('input').on("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode == 13) {
                /* FOCUS ELEMENT */
                var inputs = $(this).parents("form").eq(0).find(":input");
                var idx = inputs.index(this);
                if (idx == inputs.length - 1) {
                    inputs[0].select()
                } else {
                    inputs[idx + 1].focus(); //  handles submit buttons
                    inputs[idx + 1].select();
                }
                return false;
            }
        });


        // $("#entrydata").submit(function(e){
        // 	e.preventDefault();
        //     var postData = $(this).serializeArray();
        //     var formURL = $(this).attr("action");
        //     $.ajax({
        //         url        : formURL,
        //         timeout    : 1000,
        //         type       : "POST",
        //         async      : false,
        //         crossDomain: true,
        //         data       : postData,
        //         success    : function(data){
        //             $('#name').val('');
        //             $('#address').val('');
        //             $('#enterid').html(data);
        //             location.reload();
        //         }
        //     });
        // });

        $('.jourandelete').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var urlj = "https://aarks.net.au/books/Journal_entry/jourandelete";
            $.ajax({
                url: urlj,
                type: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $("#jouranlist").html(data);

                }
            });
        });
    </script>
@stop
