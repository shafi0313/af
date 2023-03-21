<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Patient Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form onsubmit="ajaxStore(event, this, 'editModal')"
                action="{{ route('admin.patient-fund-approval.update', $patient_fund_approval->id) }}" method="post">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5>Patient Name: <b>{{ $patient_fund_approval->patient->name }}</b></h5>
                            <h6>Requested Year: <b>{{ $patient_fund_approval->year }}</b></h6>
                        </div>
                        <div class="col-md-12">
                            <table class="table-bordered" style="width: 100%">
                                <tr>
                                    <th>SN</th>
                                    <th>ঔষধের নাম</th>
                                    <th>মূল্য(প্রতি মাসে)</th>
                                    <th>Approve Amount(Yearly)</th>
                                </tr>
                                @foreach ($patient_fund_approval->ApprovedMedicines as $medicine)
                                    <input type="hidden" name="medicine_id[]" value="{{ $medicine->id }}">
                                    <tr>
                                        <td>{{ @$x += 1 }}</td>
                                        <td>{{ $medicine->getMedicine->medicine }}</td>
                                        <td class="text-right">{{ $medicine->requested_amt }}</td>
                                        <td><input type="text" name="approved_amt[]" class="form-control text-right"
                                                value="{{ $medicine->approved_amt ?? 0 }}"></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">{{ $medicine->sum('requested_amt') }}</td>
                                    <td class="text-right"><span id="approved_amt_total"></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    var sum = 0;
    $("input[name='approved_amt[]']").each(function() {
        sum += +$(this).val();
    });
    $("#approved_amt_total").text(parseFloat(sum).toFixed(2));
    $("input[name='approved_amt[]']").keyup(function() {
        var sum = 0;
        $("input[name='approved_amt[]']").each(function() {
            sum += +$(this).val();
        });
        $("#approved_amt_total").text(parseFloat(sum).toFixed(2));
    });

    function toast(status, header, msg) {
        Command: toastr[status](header, msg)
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script>
