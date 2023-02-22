@if ($datum->count() > 0)
    <div class="form-group">
        <label>Union </label>
        <select name="union_id" id="" class="form-control">
            <option value="">Choose..</option>
            @foreach ($datum as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
        </select>
    </div>
@endif
{{-- <style>
    select {
        width: 100%;
        height: 45px;
        line-height: 50px;
        margin-bottom: 25px;
        background: #F6F7FB;
        border-radius: 0px;
        border: none;
    }
</style> --}}
