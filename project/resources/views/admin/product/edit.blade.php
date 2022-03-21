@extends('layouts.admin')
@push('css')
<link href="{{asset('content/admin')}}/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/vendor/dropzone.css" rel="stylesheet">
<link href="{{asset('content/admin')}}/css/date_picker.css" rel="stylesheet">
<!-- Your custom styles -->
<link href="{{asset('content/admin')}}/css/custom.css" rel="stylesheet">
<!-- WYSIWYG Editor -->
<link rel="stylesheet" href="{{asset('content/admin')}}/js/editor/summernote-bs4.css">
<link rel="stylesheet" href="{{asset('content/admin')}}/css/fileUpload.css">
@endpush
@section('content')
    <!-- /Navigation-->
    <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
       @method('PUT')

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
                <div class="box_general padding_bottom">
                    <div class="header_box version_2">
                        <h2><i class="fa fa-file"></i>Add Product Info</h2>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Product Name</label>
                                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Product Description</label>
                                <textarea type="text" name="des" class="form-control" placeholder="Enter Product Description" rows="3">{{$product->des}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>  Regular Price</label>
                                <input type="text" name="regular_price" class="form-control" value="{{$product->regular_price}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Offer Price</label>
                                <input type="text" name="offer_price" class="form-control" value="{{$product->offer_price}}">
                            </div>
                        </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                  @foreach($category as $v_category)
                                  <option value="{{$v_category->id}}"
                                    {{ $v_category->id == $product->category_id ? 'selected' : '' }}
                                    >{{$v_category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                      @if($product->sub_category_id == 0)
                      @else
                          <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub Category Name</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control">
                               @if($product->sub_category_id)
                                  @foreach($subcategory as $v_s_category)
                                  <option value="{{$v_s_category->id}}"
                                    {{ $v_s_category->id == $product->sub_category_id ? 'selected' : '' }}
                                    >{{$v_s_category->name}}</option>
                                  @endforeach
                                @else
                                <option value="">-Select-</option>
                                  @foreach($subcategory as $v_s_category)
                                  <option value="{{$v_s_category->id}}">{{$v_s_category->name}}</option>
                                  @endforeach
                                  @endif

                                </select>
                            </div>
                        </div>
                        @endif
                        </div> 
                      </div>
                      <div class="col-md-4">
                       <div class="card">
                         <div class="card-body">
                          @if($product->is_banner == 1)
                            <div class="row" x-data="{ show: true }">
                          @elseif($product->is_banner == null)
                            <div class="row" x-data="{ show: false }">
                          @endif
                          <div class="col-md-12">
                           <div class="row">
                            <div class="form-group col-md-6">
                              <label><b>Special Price</b></label>
                               <div class="row">
                                <div class="col-2">
                                  <label class="switch" for="checkbox1">
                                    <input type="checkbox" id="checkbox1" name="is_promo" value="1"
                                    {{$product->is_promo == 1 ? 'checked' : ''}}
                                    />
                                    <div class="slider round"></div>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                              <label><b>Product For Slider</b></label>
                               <div class="row">
                                <div class="col-2">
                                  <label class="switch" for="checkbox">
     
                                    <input type="checkbox" id="checkbox" @click="show = !show" name="is_banner" value="1"
                                    {{$product->is_banner == 1 ? 'checked' : ''}}
                                    />


                                    <div class="slider round"></div>
                                  </label>
                                </div>
                              </div>
                            </div>
                           </div>
                          </div>
                           <div class="col-md-12">
                           <div class="row">
                            <div class="form-group col-md-6">
                              <label><b>Tax Include</b></label>
                               <div class="row">
                                <div class="col-2">
                                  <label class="switch" for="checkbox12">
                                    <input type="checkbox" id="checkbox12" name="taxable" value="1"
                                    {{$product->taxable == 1 ? 'checked' : ''}}
                                    />
                                    <div class="slider round"></div>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                              <label><b>Not Discountable</b></label>
                               <div class="row">
                                <div class="col-2">
                                  <label class="switch" for="checkbox44">
     
                                    <input type="checkbox" id="checkbox44" name="discountable" value="1"
                                    {{$product->discountable == 1 ? 'checked' : ''}}
                                    />


                                    <div class="slider round"></div>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group col-12">
                              <label><b>Include Tax [Optional]</b></label>
                                    <input type="text" class="form-control" id="checkbox33" name="tax" value="{{$product->tax}}" />
                            </div>
                           </div>
                          </div>


                        <div class="col-md-12" x-show="show">
                            <div class="form-group">
                                <label><b>Product Description For Special Banner [optional] </b></label>
                                <input type="text" name="sp_des" class="form-control" value="{{$product->sp_des}}">
                            </div>
                        </div>

                        <div class="col-md-12" x-show="show">
                            <div class="form-group">
                                <label><b>Product Image For Special Banner [optional] </b></label>
                                <input type="file" name="banner" class="form-control">
                            </div>
                        </div>

                      <div class="col-md-12">
                            <div class="form-group">
                              <label><b>Product Options</b></label>
                               <div class="row">
                       @foreach($proTitle as $key => $v_proTitle)

                <div class="col-6">
                  <label for="">{{$v_proTitle->name}}
                    @if(isset($product->product_option))
                       <input type="checkbox" name="product_option[]" value="{{$v_proTitle->id}}"
                       {{in_array($v_proTitle->id, $product->product_option) ? 'checked' : ''}}
                       >
                    @else
                    <input type="checkbox" name="product_option[]" value="{{$v_proTitle->id}}"
                       >
                    @endif
                  </label>
                </div>
                @endforeach



                              </div>
                            </div>
                        </div>
                          <div class="col-md-12">
<div id="uploadArea" class="upload-area">
  <!-- Header -->
  <div class="upload-area__header">
    <h4 class="upload-area__title">Upload file</h4>
    <p class="upload-area__paragraph">
      File should be an image
      <strong class="upload-area__tooltip">
        Like
        <span class="upload-area__tooltip-data"></span> <!-- Data Will be Comes From Js -->
      </strong>
    </p>
  </div>
  <!-- End Header -->

  <!-- Drop Zoon -->
  <div id="dropZoon" class="upload-area__drop-zoon drop-zoon">
    <span class="drop-zoon__icon">
      <i class='bx bxs-file-image'></i>
    </span>
    <p class="drop-zoon__paragraph">Drop your file here or Click to browse</p>
    <span id="loadingText" class="drop-zoon__loading-text">Please Wait</span>
    <img src="" alt="Preview Image" id="previewImage" class="drop-zoon__preview-image" draggable="false">
    <input type="file" id="fileInput" name="image" class="drop-zoon__file-input" accept="image/*">
  </div>
  <!-- End Drop Zoon -->

  <!-- File Details -->
  <div id="fileDetails" class="upload-area__file-details file-details">
    <h3 class="file-details__title">Uploaded File</h3>

    <div id="uploadedFile" class="uploaded-file">
      <div class="uploaded-file__icon-container">
        <i class='bx bxs-file-blank uploaded-file__icon'></i>
        <span class="uploaded-file__icon-text"></span> <!-- Data Will be Comes From Js -->
      </div>

      <div id="uploadedFileInfo" class="uploaded-file__info">
        <span class="uploaded-file__name">Proejct 1</span>
        <span class="uploaded-file__counter">0%</span>
      </div>
    </div>
  </div>
  <!-- End File Details -->
</div>
<!-- End Upload Area -->
                        </div>
                        </div>
                         </div>
                       </div>
                      </div>
                    </div>    
                </div>
                <!-- /box_general-->

                </div>

                <p style="margin-left:2rem">
                   <button type="submit" class="btn_1 medium">Save</button>
                </p>
              </div>
              <!-- /.container-fluid-->
          </form>
               </div>
            <!-- /.container-wrapper-->
@endsection
@push('js')
 <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="{{asset('content/admin')}}/vendor/dropzone.min.js"></script>

  <script src="{{asset('content/admin')}}/js/fileUpload.js"></script>
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
<!--    <script>
      $(document).ready(function(){
        $('#category_id').change(function() {
          var category_id = $(this).val();
          // console.log(district_id);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            type:'POST',
            url:'res-v-2/admin/getsubcategory',
            data: {category_id: category_id},
            success: function (data) {
              $( "#sub_category_id" ).html(data);
            }
          });
        });
      });
    </script> -->

@endpush