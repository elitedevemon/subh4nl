@extends('layouts.website')
@push('css')
<style>
	h6.customHead.pt-3 {
    font-size: 27px;
    font-weight: bold;
    font-style: italic;
    color: #939393;
}
p.re_offer {
    font-size: 33px;
    color: #fd9d3e;
    font-style: italic;
    font-weight: bold;
    font-family: ui-monospace;
}
input.form-control {
    height: 65px;
    font-size: 30px;
}

.customlabel {
    font-size: 30px;
    font-style: italic;
    font-weight: bold;
}
select.form-control {
     height: 65px;
    font-size: 30px;
}


input[type="radio"] {
  display:none;
}

/* The label is what's left to style. 
As long as its 'for' attribute matches the input's 'id', it will maintain the function of a radio button. */
.customlabel1 {
  padding: 1em;
  display: inline-block;
  border: 1px solid grey;
  cursor: pointer;
  font-size: 28px;
}

.blank-label {
  display: none;
}

/* The '+' is the adjacent sibling selector.
It selects what ever element comes right after it,
as long as it is a sibling. */
input[type="radio"]:checked + .customlabel1 {
  background: grey;
  color: #fff;
}
.discount {
    position: absolute;
    top: 72px;
    left: 27px;
    font-size: 21px;
    background: #fd9d3e;
    padding: 6px;
    color: #fff;
    border-radius: 10px;
    font-weight: bold;
}
.display-none {
    display: none;
}
p.offer_discount {
    font-size: 27px;
    color: #e91e63;
    font-style: italic;
    font-weight: bold;
}
.bannnerImage img {
    width: 100%;
}
</style>
@endpush

@section('content')

	<section class="page-banner" style="background: #121619 url({{asset('content/website/images/blog-6.jpg')}}) no-repeat center / cover;">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="page-title">
						<h1 class="page-headding">reservation</h1>
						<ul>
							<li><a href="index.html" class="page-name">Home</a></li>
							<li>Reservation</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

@livewire('wizard')

@endsection
@push('js')

<script>
	$('#other-field').focus(function() {
  $('#other').prop("checked", true);
});

</script>

@endpush