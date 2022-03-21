@extends('layouts.admin')
@push('css')
<link href="{{asset('content/admin')}}/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/vendor/dropzone.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/css/date_picker.css" rel="stylesheet">
<!-- Your custom styles -->
<link href="{{asset('content/admin')}}/css/custom.css" rel="stylesheet">
<!-- WYSIWYG Editor -->
<link rel="stylesheet" href="{{asset('content/admin')}}/js/editor/summernote-bs4.css">


@endpush
@section('content')
    <!-- /Navigation-->
    @if(isset($setting))
    <form action="{{url('/admin/generalSave')}}" method="post" enctype="multipart/form-data">
        @csrf


    <div class="content-wrapper">
            <div class="container-fluid">
              <!-- Breadcrumbs-->
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add listing</li>
              </ol>
              <!-- Example DataTables Card-->
               @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

              @if (count($errors) > 0)
                 <div class = "alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                 </div>
              @endif
              <input type="hidden" name="id" value="{{$setting->id}}">
                <div class="box_general padding_bottom">
                    <div class="header_box version_2">
                        <h2><i class="fa fa-file"></i>General Information</h2>
                    </div>
                     <div class="card">
                       <div class="card-body">
                            <div class="row">
                        <div class="col-md-6">

                             <div class="form-group">
                                <label>{{ __('Campaign-1 [Product Offer Limit]')}} </label>
                                <select class="form-control" name="is_offer1">
                                  <option value="0">--select--</option>
                                  <option {{$setting->is_offer1 == 1 ? 'selected' : '' }} value="1">Active</option>
                                  <option {{$setting->is_offer1 == 2 ? 'selected' : '' }} value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>{{ __('Campaign-2 [Buy One Get One]')}} </label>
                                <select class="form-control" name="is_offer2">
                                  <option value="0">--select--</option>
                                  <option {{$setting->is_offer2 == 1 ? 'selected' : '' }} value="1">Active</option>
                                  <option {{$setting->is_offer2 == 2 ? 'selected' : '' }} value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                          <div class="col-md-12">

                            <div class="form-group">
                                <label>{{ __('Offer Title For Booking')}} </label>
                                <input type="text" name="re_offer" value="{{$setting->re_offer}}" class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                    </div>
                       </div>
                   </div>

                   <div class="card">
                       <div class="card-body">
                            <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>{{ __('Website Title')}} </label>
                                <input type="text" name="title" value="{{$setting->title}}" class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>{{ __('Website Home Change')}} </label>
                                <select class="form-control" name="is_home">
                                  <option value="0">--select--</option>
                                  <option {{$setting->is_home == 1 ? 'selected' : '' }} value="1">Home Page v1</option>
                                  <option {{$setting->is_home == 2 ? 'selected' : '' }} value="2">Home Page v2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                       </div>
                   </div>

                    <div class="card" style="margin-top: 30px">
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>Social Media Links</b>
                        </h6>
                            <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Facebook Account Links')}} </label>
                                <input type="text" name="fb" value="{{$setting->fb}}" class="form-control" placeholder="Enter Facebook Account Links">
                            </div>
                        </div> <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Instagram Account Links')}} </label>
                                <input type="text" name="insta" value="{{$setting->insta}}" class="form-control" placeholder="Enter Instagram Account Links">
                            </div>
                        </div> <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Twitter Account Links')}} </label>
                                <input type="text" name="twitter" value="{{$setting->twitter}}" class="form-control" placeholder="Enter Twitter Account Links">
                            </div>
                        </div>
                    </div>
                    </div>
                   </div>

                    <div class="card" style="margin-top: 30px">
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>Stripe Config</b>
                        </h6>
                            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Stripe Secret Key')}} </label>
                                <input type="text" name="stripe_sc" class="form-control" placeholder="Stripe Secret Key" value="{{$setting->stripe_sc}}">
                            </div>
                        </div> <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Stripe Publishable Key')}} </label>
                                <input type="text" name="stripe_key" class="form-control" placeholder="Stripe Publishable Key" value="{{$setting->stripe_key}}">
                            </div>
                        </div>
                    </div>
                       </div>
                   </div>


        <div class="card" style="margin-top: 30px">
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>Promo Image And Text</b>
                        </h6>
                            <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>{{ __('Website Promo Alert Image')}} [728X300] </label>
                                <input type="file" name="promoImgAlert" class="form-control" placeholder="Category Name">
                            </div>
                        </div> <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Promo Alert Text')}} </label>
                                <input type="text" name="promoTxt" value="{{$setting->promoTxt}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>{{ __('Website Home Page Banner 1')}} [600X250] </label>
                                <input type="file" name="banner1" class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>{{ __('Website Home Page Banner 2')}} [600X250] </label>
                                <input type="file" name="banner2" class="form-control" placeholder="Category Name">
                            </div>
                        </div>

                     
                    </div>
                       </div>
                   </div>
                   
                   
                    <div class="card" style="margin-top: 30px">
                        
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>All Logo And Favicon</b>
                        </h6>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Website Logo')}} </label>
                                <input type="file" name="logo" class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Website Favicon')}} </label>
                                <input type="file" name="favicon" class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Website Reservation Image')}} [200X200] </label>
                                <input type="file" name="img_re" class="form-control" placeholder="Website Reservation Image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('PDF Menu')}}</label>
                                <input type="file" name="is_menu" class="form-control" placeholder="PDF Menu Upload">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('PDF Menu For English')}}</label>
                                <input type="file" name="is_menu_eng" class="form-control" placeholder="PDF Menu Upload">
                            </div>
                        </div>


<!--                         <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Website Footer Logo')}} </label>
                                <input type="file" name="footerlogo" class="form-control" placeholder="Category Name">
                            </div>
                        </div>    -->
  <!--                       <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Website Promo Image')}} </label>
                                <input type="file" name="promo_image" class="form-control" placeholder="Category Name">
                            </div>
                        </div> -->
                     
                    </div>
                       </div>
                   </div>


    <div class="card" style="margin-top: 30px">
                        
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>All Max and Min Pirce</b>
                        </h6>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Mix Price Order')}} </label>
                                <input type="text" name="limit_max" value="{{$setting->limit_max}}" class="form-control">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Min Price Order')}} </label>
                                <input type="text" name="limit_min" value="{{$setting->limit_min}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Discount')}} </label>
                                <input type="text" name="discount" value="{{$setting->discount}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>{{ __('Website Delivery')}} </label>
                                <select class="form-control" name="is_delivery">
                                  <option value="0">--select--</option>
                                  <option {{$setting->is_delivery == 1 ? 'selected' : '' }} value="1">Delivery Available</option>
                                  <option {{$setting->is_delivery == 2 ? 'selected' : '' }} value="2">Delivery Not Available</option>
                                </select>
                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Offer Limit')}} </label>
                                <input type="text" name="offer_limit" value="{{$setting->offer_limit}}" class="form-control">
                            </div>
                        </div>

                    <!--      <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Highest Order Limit')}} </label>
                                <input type="text" name="buy_offer" value="{{$setting->buy_offer}}" class="form-control">
                            </div>
                        </div>  -->

              
                     
                    </div>
                       </div>
                   </div>

                    <div class="card" style="margin-top: 30px">
                        
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>Information Address</b>
                        </h6>
                            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Phone Number')}} </label>
                                <input type="text" name="phone" value="{{$setting->phone}}" class="form-control" placeholder="Category Name">
                            </div>
                        </div> <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Website Email')}} </label>
                                <input type="text" name="email" value="{{$setting->email}}" class="form-control" placeholder="Category Name">
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Our Schedules')}} </label>

                                <textarea name="schedules"  class="form-control" id="" cols="30" rows="10">{!!$setting->schedules!!}</textarea>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Order Time Schedules')}} </label>

                                <textarea name="select_timeOp"  class="form-control" id="" cols="30" rows="10">{!!$setting->select_timeOp!!}</textarea>
                            </div>
                        </div> 
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Our Address')}} </label>

                                <textarea name="address" class="form-control" id="" cols="30" rows="10">
                                  {!!$setting->address!!}
                                </textarea>
                            </div>
                        </div>
                     
                    </div>
                       </div>
                   </div>
                  

                    
                       
                </div>
                <!-- /box_general-->
                
                    
                </div>

                <p style="margin-left:2rem">
                   <button type="submit" class="btn_1 medium">Update</button>
                </p>
              </div>
              <!-- /.container-fluid-->
          </form>
               </div>
            <!-- /.container-wrapper-->
    @endif
@endsection
@push('js')
 
        <script src="{{asset('content/admin')}}/vendor/dropzone.min.js"></script>
  <script src="{{asset('content/admin')}}/vendor/bootstrap-datepicker.js"></script>
  <script>$('input.date-pick').datepicker();</script>
  <!-- WYSIWYG Editor -->
  <script src="{{asset('content/admin')}}/js/editor/summernote-bs4.min.js"></script>
  <script>
      $('.editor').summernote({
    fontSizes: ['10', '14'],
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough']],
      ['fontsize', ['fontsize']],
      ['para', ['ul', 'ol', 'paragraph']]
      ],
        placeholder: 'Write here ....',
        tabsize: 2,
        height: 200
      });
    </script>
@endpush