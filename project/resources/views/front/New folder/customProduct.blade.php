@extends('layouts.website')
@push('css')
<link rel="stylesheet" href="{{asset('content/website')}}/assets/css/main.css" type="text/css" media="all" />
@endpush
@section('content')
   @livewire('custom-product', ['slug' => $data])
@endsection

@push('js')

@endpush