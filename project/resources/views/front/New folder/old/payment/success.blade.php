@extends('layouts.website')
@section('content')

<section class="page-content section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="p-section-title text-center">
          <h4> Confirmation Section</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">     
        <div class="order-section">
  <div style="width:100%; min-width:800px; height:100%; line-height:1.6em; color:#0c0040; background-color:#f2f2f2; font-weight:400;">
	<table style="border-spacing:0; margin:0 auto; clear:both; font-size:16px; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif; padding:50px; width:720px;">
		<tbody>
			<tr>
				<td style="vertical-align:top; margin:0; background:#fff; font-size:16px; line-height:24px; word-wrap:break-word; padding:20px 40px 40px 40px; border-radius:6px; border-top: 20px solid #0c0040;color: #000!important">
					<p> <strong>Dear Customer.</strong></p>
					<p>Your Order complate Successfully. We will Contact Soon</p>
					<p>Thank You For Order </p>
				</td>
			</tr>
	<!-- 		<tr>
				<td style="font-size:12px; color:#888; vertical-align:baseline; padding:20px 40px;">
					<div style="display: block; width:120px; margin:auto;">
						<img src="https://dl.airtable.com/.attachmentThumbnails/ebfca8c83689c41b18e7706241b21aa4/38f572ec" alt="Inpi - Institut National de la Propriété Industrielle" style="display:block; width:120px; margin:5px auto 20px auto;">
					</div>
				</td>
			</tr> -->
		</tbody>
	</table>
</div>
        
      	</div>
    </div>
  </div>
</section>
@endsection


@push('scripts')
    <script>
        $(function () {
            localStorage.removeItem("setmenu")
            localStorage.removeItem("cart")
        })
    </script>
@endpush

