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
                        <h2><i class="fa fa-file"></i>Add About Image Info</h2>
                    </div>

                  <form action="{{route('homePageStore')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                     <div class="col-md-12 style="margin-bottom: 5px">
                       <div class="card">
                         <div class="card-body row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Title</label>
                              <input type="text" class="form-control" name="title" value="{{$homePage->title}}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Description</label>
                              <input type="text" class="form-control" name="des" value="{{$homePage->des}}">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="imageShow">
                             <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img1}}" width="100px" height="80px" alt="">
                            </div>
                            <div class="form-group">
                              <input type="file" class="form-control" name="img1">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="imageShow">
                             <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img2}}" width="100px" height="80px" alt="">
                            </div>
                            <div class="form-group">
                              <input type="file" class="form-control" name="img2">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="imageShow">
                             <img src="{{asset('storage/upload/aboutImage')}}/{{$homePage->img3}}" width="100px" height="80px" alt="">
                            </div>
                            <div class="form-group">
                              <input type="file" class="form-control" name="img3">
                            </div>
                          </div>




                          <div class="form-group">
                            <button class="btn btn-secondary btn-sm" type="submit">update</button>
                          </div>
                         </div>
                       </div>
                    </div>

                    </div>
                  </form>
                </div>
                <!-- /box_general-->
                </div>
              </div>
               </div>
            <!-- /.container-wrapper-->
@endsection
@push('js')
 
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
   <script>
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
            url:'/admin/getSubCategory',
            data: {category_id: category_id},
            success: function (data) {
              $( "#sub_category_id" ).html(data);
              // console.log(data);
            }
          });
        });
      });
    </script>

@endpush