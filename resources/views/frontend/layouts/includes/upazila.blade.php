@if ($datum->count() > 0)
    <option value="">নির্বাচন করুন</option>
    @foreach ($datum as $data)
        <option value="{{ $data->id }}" {{ $data->id==$applicantThana?'selected':'' }}>{{ $data->bn_name }}</option>
    @endforeach
@endif
<style>
    select {
        width: 100%;
        height: 45px;
        line-height: 50px;
        margin-bottom: 25px;
        background: #F6F7FB;
        border-radius: 0px;
        border: none;
    }
</style>
