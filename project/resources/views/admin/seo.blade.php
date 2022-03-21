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
    <form action="{{url('/admin/seoSave')}}" method="post" enctype="multipart/form-data">
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
                        <h2><i class="fa fa-file"></i>SEO Information</h2>
                    </div>

                    <div class="card" style="margin-top: 30px">
                        
                       <div class="card-body">
                        <h6 class="card-title ">
                            <b>Header & Footer Section</b>
                        </h6>
                            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Header')}} </label>

                                <textarea name="metaTag"  class="form-control" id="" cols="30" rows="10">{!!$setting->metaTag!!}</textarea>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Footer')}} </label>

                                <textarea name="footer_part" class="form-control" id="" cols="30" rows="10">
                                  {!!$setting->footer_part!!}
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