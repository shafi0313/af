@extends('frontend.layout.master')
@section('title','Cash Entry')
@section('content')
<?php $p="cb"; $mp="acccounts";?>
<!-- Page Content Start -->
<section class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page Content End -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel" style="color:red !important;">NOTE of Cash Details. </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{route('gst_recon.save_note', [$client->id, $profession->id])}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="model" value="cashbook">
                    <input type="hidden" name="year" value="{{now()->format('Y')}}">
                    <div class="form-group">
                        <label style="color:red;">Note : </label>
                        <textarea name="content" id="note" cols="30" rows="10" class="form-control summernote" placeholder="Add your notes">{{optional($note)->content}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"
                        style="background:#ff5733 !important; color:white !important;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Footer Start -->

<!-- Footer End -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$('.cashdelete').on('click', function(e){
	e.preventDefault();
	var id = $(this).attr('data-id');
	var posturl = "https://aarks.net/books/Petty_cash/deletecash";
    $.ajax({
        url : posturl,
        type: "POST",
        data:{id:id},
        success:function(data){
        $('#cashbook').html(data);
        }
    });
});

$('#account_name').on('change', function(e){
	var taxtcode 	 = $('#account_name option:selected').attr('tax-code');
	var account_code = $('#account_name option:selected').attr('account-code');
	var data_type = $('#account_name option:selected').data('type');
	$('#tax_code').val(taxtcode);
	$('#ac_type').val(data_type);
	if(account_code >= 110000 && account_code <= 199999){
		$('#narration').focus();
		$('#payment').attr('disabled', 'disabled');
		$('#recevied').removeAttr('disabled', 'disabled').attr('required', 'required');
	} else if(account_code >= 210000 && account_code <= 299999){
		$('#narration').focus();
		$('#payment').removeAttr('disabled', 'disabled').attr('required', 'required');
		$('#recevied').attr('disabled', 'disabled');
	}else{
		$('#narration').focus();
		$('#payment').removeAttr('disabled', 'disabled').attr('required', 'required').attr('onkeyup', 'dis("payment")');
		$('#recevied').removeAttr('disabled', 'disabled').attr('required', 'required').attr('onkeyup', 'dis("recevied")');
	}
	e.preventDefault();
});

function dis(type){
    if(type == 'payment'){
        if($('#payment').val().length > 0){
            $('#recevied').attr('disabled', 'disabled');
        }else{
            $('#recevied').removeAttr('disabled', 'disabled');
        }
    }else{
        if($('#recevied').val().length > 0){
            $('#payment').attr('disabled', 'disabled');
        }else{
            $('#payment').removeAttr('disabled', 'disabled');
        }
    }
}


/*
$('input').on("keypress", function(e) {

	if (e.keyCode == 13) {
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
*/
function gstCal(value){
    let tax = $('#tax_code').val();
    if((tax == 'GST' || tax == 'CAP' || tax == 'INP')){
        $('#gst').val((value/11).toFixed(2))
    }else{
        $('#gst').val('0.00')
    }
}
// $("#entrydata").submit(function(e){
// 	e.preventDefault();
//     var postData = $(this).serializeArray();
//     var formURL = $(this).attr("action");
//     $.ajax({
//         url : formURL,
//         timeout:1000,
//         type: "POST",
//         async:false,
//         crossDomain:true,
//         data : postData,
//         success:function(data){
//         $('#narration').val('');
//         $('#payment').val('');
//         $('#recevied').val('');
//         $('#account_name').focus();
//         $('#cashbook').html(data);
//         }
//     });
// });




$('.finalpost').click(function (e){
    e.preventDefault();
    let form = $(this).parents('form');
    swal({
        title: 'Are you sure?',
        text: 'Before post please check all transaction and your closing balance is correct, As you cannot alter/delete the transaction after post?',
        icon: 'warning',
        buttons: ["Make Changes", "Yes!"],
    }).then(function(value) {
        if(value){
            form.submit();
        }
    });
});
</script>
@stop
