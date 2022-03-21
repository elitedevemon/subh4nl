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

    <form action="{{url('/admin/genaralcontactSAve')}}" method="post" enctype="multipart/form-data">
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
              <input type="hidden" name="id" value="{{$ourPage->id}}">
                <div class="box_general padding_bottom">
                    <div class="header_box version_2">
                        <h2><i class="fa fa-file"></i>General Information</h2>
                    </div>
                   <div class="card">
                       <div class="card-body">
                            <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Contact Page')}} </label>
                                <input type="file" name="image"  class="form-control" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Website Meta Tags')}} [if you need style use HTML Tag]</label>
                                <textarea name="des" class="editor form-control" id="" cols="30" rows="10">
                                    {!!$ourPage->des!!}
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

@endsection
@push('js')
 
        <script src="{{asset('content/admin')}}/vendor/dropzone.min.js"></script>
  <script src="{{asset('content/admin')}}/vendor/bootstrap-datepicker.js"></script>
  <script>$('input.date-pick').datepicker();</script>
  <!-- WYSIWYG Editor -->
  <script src="{{asset('content/admin')}}/js/editor/summernote-bs4.min.js"></script>
  <script>
      $('.editor').summernote({
    fontSizes: ['8', '9', '10', '11', '12', '14', '18','24','28','32','','36'],
    toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['table', ['table']],
    ['insert', ['link', 'picture', 'video']],
    ['view', ['fullscreen', 'codeview', 'help']]
  ],
   colors: [
        ['red', 'green', 'blue'], //first line of colors
        ['#c4b540', '#1dd381', '#ba1cd2'] //second line of colors
    ],
        placeholder: 'Write here ....',
        tabsize: 2,
        height: 200
      });
    </script>
@endpush