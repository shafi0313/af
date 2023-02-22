@extends('asset')

@section('content')



<div class="breadcrumbs__section breadcrumbs__section-squared pt-60 pb-60 bg__style" 
style="background-image: url({{ asset('front_end/') }}/assets/img/header.jpg)" data-brk-library="component__breadcrumbs_css"><br>

<section id="contact" class="contact-form-wrapper">
  <div class="container">
  @php echo $terms->details; @endphp
  </div>
</section>
@endsection