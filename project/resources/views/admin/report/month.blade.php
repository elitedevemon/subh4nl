<?php
        $genaralSetting = \App\Models\setting::find(1);

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <meta charset="utf-8"> -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
	
  <!-- Bootstrap core CSS-->
  <link href="{{asset('content/admin')}}/vendor\bootstrap\css\bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="{{asset('content/admin')}}/css\admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="{{asset('content/admin')}}/vendor\font-awesome\css\font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  <link href="{{asset('content/admin')}}/vendor\datatables\dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Your custom styles -->
  <link href="{{asset('content/admin')}}/css\custom.css" rel="stylesheet">

  @stack('css')
  <style>
    @media Print{
      title{
        display: none!important;
      }
      .no-print{
        display: none!important;
      }
       footer{
        page-break-after: always;
      }
    }

    @page{
      size: auto;
      margin:0mm;
      padding-top:20px; 
      }
 
  </style>
	
</head>

<body >

  <div class="container">
    <div class="row">
     
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
           @if(isset($genaralSetting))
            <h4>{{$genaralSetting->title}}</h4>
            <p style="margin:0"><b>Address:</b>{{$genaralSetting->address}}</p>
            <p style="margin:0"><b>Phone:</b>{!!$genaralSetting->phone!!}</p>
   
            @else
            <h4>ABC Company</h4>
            <p>France</p>
            @endif
          </div>
        </div>
               <div class="col-md-12">
      <div class="no-print text-right">
        <a class="btn btn-info" id="printPage" target="_blank"> Print</a>
      </div>
      
        <div class="table-responsive">
        <table class="table table-striped table-hover table-condensed table-lg">
            <thead class="bg-dark" style="color: #fff; font-weight: bold">
              <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Month</th>
                <th>Order Methods</th>
                <th>Amount</th>
              </tr>
            </thead>
            @if($getMonthSellsMethod)
            <tbody>
             @foreach($getMonthSellsMethod as $key => $v_getData)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$v_getData->sellDate}}</td>
                <td>{{$v_getData->month}}</td>
                <td>{{$paymentMethod}}</td>
                <td>€{{$v_getData->total_sales}}</td>
              </tr>
              @endforeach
         
            </tbody>
            <tfoot class="bg-dark" style="color: #fff">
              <tr >
                <td colspan="4">Total Amount :</td>
                <td>€{{$getdaySellsTotal}}</td>
              </tr>
       
            </tfoot>
            @else
              <tr>
                <td><p><b>No Data Found Try Again :)</b></p></td>
              </tr>
            @endif

          </table>
        </div>
      </div>
</div>
    </div>
  </div>

      <!-- Bootstrap core JavaScript-->
        <script src="{{asset('content/admin')}}/vendor/jquery/jquery.min.js"></script>

    <script>
         $(document).ready(function(){
        $('#printPage').on('click', function(e){
          e.preventDefault();
          window.print();
          // alert()
        });
      });
    </script>

      @stack('js')
  </body>
  </html>
  