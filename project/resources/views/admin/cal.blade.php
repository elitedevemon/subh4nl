@extends('layouts.admin')
@push('css')
    @livewireStyles
    <style>
    	.fc-daygrid-event-dot {
    		margin:0;
    		border:0!important;
			}
			.fc-event-title {
    background: #877d7d;
    padding: 6px;
    color: #fff;
    font-weight: bold;
    font-size: 14px;
    text-align: center;
    display: block;
    width: 20px;
    /* height: 20px; */
}
    </style>
@endpush
@section('content')
	      <div class="content-wrapper">
            <div class="container-fluid">
            	<div class="row">
            		<div class="col-12">
	  					<livewire:calendar />
            		</div>
            	</div>
            </div>
        </div>
	  </div>
@endsection
@push('js')
    @livewireScripts
    @stack('scripts')
@endpush
