<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<style type="text/css">
			th, td {
					padding: 3px !important;
				}
				table, tbody{
					border-bottom: 1px solid #dfdfdf;
				}
				table, tfoot{
					border-bottom: 1px solid #dfdfdf;
				}
				table.table.table-striped thead {
    background: #ebebeb;
    /* border-bottom: 1px solid #000; */
}
			</style>
			<style  media="print">
      @media print
      {
         @page {
           margin-top: 0;
           margin-bottom: 0;
         }
         body  {
           padding-top: 72px;
           padding-bottom: 72px ;
         }
      }

	  /* @media only screen and (min-width: 300px){

		  .width-100 {width: 100%;}
		  .width-100 {
				width: 100%;
			}
			.responsive td {
					font-size: 8px;
				}
			.responsive th {
				font-size: 10px;
				}


		  } */

</style>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="http://localhost/restaurant_chow/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="http://localhost/restaurant_chow/assets/bower_components/font-awesome/css/font-awesome.min.css">
			  <link rel="stylesheet" href="http://localhost/restaurant_chow/assets/dist/css/AdminLTE.min.css">
			</head>
			<body style="font-family: courier; font-size:8pt" onload="window.print();">
			<!--<button  style="align: left" onclick="printDiv()" class="btn btn-success">Print</button>
			<a href="http://localhost/restaurant_chow/dashboard" class="btn btn-warning">Back</a>-->
			<?php 
			$sett = \App\Models\setting::find(1);
			 ?>
			<div id="example">
			<div class="wrapper">
			  <section class="invoice" style="width:180px; height:auto; text-align:left;">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h6  class="page-header" style="text-align:center; font-size: 15px; margin:0">
			         {{$sett->title}}
					  <br>
			          <small style="font-size: 8pt;" class="pull-right">Date: {{\Carbon\Carbon::now()}}</small> <br>
			          <small style="font-size: 8pt;" class="pull-right">phone: {{$sett->phone}}</small> <br>
			          <small style="font-size: 8pt;" class="pull-right">Order Number: {{$getOrder->order_number}}</small>
					  <p style="font-size: 8pt;">
						{{$sett->address}}<br>
						</p>
			        </h6>

			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-sm-12 " style="text-align: left;">
			        <table class="table table-striped" align="left">
			          <thead>
			          <tr style="font-size:10px">
			            <th style="text-align: left;">QTY DESIGNATION</th>
			            <th style="text-align: left; ">P.U</th>
			            <th style="text-align: left;">Total</th>
			          </tr>
			          </thead>
			          <tbody style="font-size:10px;">
			          	@foreach($getOrder->orderlist as $key=> $v_g)
			          	<tr>
				            <td style="font-weight:700;">{{$v_g->name}} 
				            	@isset($v_g->tax)
				            	(tax-{{$v_g->tax}}%)
				            	@endif
				            	@if($v_g->selectOption == null)
                                                   
                                                      @else
                                                    <?php 
                                                      $getdata = $v_g->selectOption;
                                                      ?>
                                                       @foreach($getdata as $key => $getID)

                                                         @if($getID == false)
                                                          @else
                                                          <ul>
                                                          	<li>{{$getID}}</li>
                                                          </ul>
                                                          @endif
                                                          
                                                       @endforeach
                                                      @endif

				            </td>
				            <td style="font-weight:700;">
				            					@if($v_g->extraPrice == 0)
                                                	{{$v_g->price}}
                                                @else
                                                  {{$v_g->price - $v_g->extraPrice}} + {{$v_g->extraPrice}}
                                                @endif
							</td>
				             <td style="font-weight:700;"> {{$v_g->price * $v_g->quantity}}</td>
			          	</tr>
			          	@endforeach


			          </tbody>

			        </table>
			      </div>
			      <!-- /.col -->
			    </div>

			    <div class="row">
			      <div class="col-sm-12 " style="text-align: left;">
			        <table class="table table-striped" align="left" width="100%">
			          <tfoot style="border-bottom: 1px solid #dfdfdf;">
			          	 @if($getOrder->orderType == 'order')
				          	<tr>
				          	<td  style="font-size:11px;">sub total:</td>
				          	<td  style="font-size:11px;">:</td>
				          	<td  style="font-size:9px; font-weight:700; text-align: center; margin-right: 5px">€{{$getOrder->pay_amount  }}</td>
				          	</tr>
				          	<tr>
				          	<td  style="font-size:11px;">Shipping Cost:</td>
				          	<td  style="font-size:11px;">:</td>
				          	<td  style="font-size:9px; font-weight:700; text-align: center; margin-right: 5px">€{{$getOrder->shipping_cost}}</td>
				          	</tr>
				          	<tr>
				          	<td  style="font-size:11px;">Net Amount:</td>
				          	<td  style="font-size:11px;">:</td>
				          	<td  style="font-size:9px; font-weight:700; text-align: center; margin-right: 5px">€{{$getOrder->pay_amount + $getOrder->shipping_cost}}</td>
				          	</tr>
			          	@elseif($getOrder->orderType == 'takeway')
				          	<tr>
				          	<td  style="font-size:11px;">sub total:</td>
				          	<td  style="font-size:11px;">:</td>
				          	<td  style="font-size:9px; font-weight:700; text-align: center; margin-right: 5px">€{{$getOrder->pay_amount}}</td>
				          	</tr>
				          	<tr>
				          	<td  style="font-size:11px;">discount:</td>
				          	<td  style="font-size:11px;">:</td>
				          	<td  style="font-size:9px; font-weight:700; text-align: center; margin-right: 5px">€{{$getOrder->discount}}</td>
				          	</tr>
				          	<tr>
				          	<td  style="font-size:11px;">Net Amount:</td>
				          	<td  style="font-size:11px;">:</td>
				          	<td  style="font-size:9px; font-weight:700; text-align: center; margin-right: 5px">€{{$getOrder->pay_amount - $getOrder->discount}}</td>
				          	</tr>
			          	@endif

			          </tfoot>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->

			  <footer class="main-footer" style="text-align:center; margin-left:0px; width:200px; font-size:11px;">
			</footer>
			</div>
		</div>
	</body>
<!-- 	<script type="text/javascript">
	function printDiv() {
			var printContents = document.getElementById("example").innerHTML;
	 var originalContents = document.body.innerHTML;
	 document.body.innerHTML = printContents;
	 window.print();
	 document.body.innerHTML = originalContents;
	 };
	</script> -->
	</html>