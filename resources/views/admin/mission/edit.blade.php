<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Mission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form onsubmit="ajaxStoreModal(event, this, 'editModal')" action="{{ route('admin.missions.update', $mission->id) }}"
                method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="field-label">Title <span class="required">*</span></div>
                            <input type="text" name="title" class="form-control" value="{{ $mission->title }}" required>
                        </div>
                        <div class="col-md-12">
                            <div class="field-label">Icon <span class="required">*</span></div>
                            <input type="text" name="icon" class="form-control" value="{!! $mission->icon !!}" required>
                        </div>
                        <div class="col-md-12">
                            <div class="field-label">Content <span class="required">*</span></div>
                            <textarea name="content" rows="10" class="form-control" required>{{ $mission->content }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

