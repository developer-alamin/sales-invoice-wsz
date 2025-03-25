@extends("layouts.app")

 @section('content')
 <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> {{  __('messages.dashboard') }}
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>{{__('messages.overview')}} <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">{{__('messages.weekly_sales')}} <i class="mdi mdi-chart-line mdi-24px float-end"></i>
          </h4>
          <h2 class="mb-5">$ 15,0000</h2>
          <h6 class="card-text">{{__('messages.increased_by')}} 60%</h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">{{ __('messages.weekly_orders')}} <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
          </h4>
          <h2 class="mb-5">45,6334</h2>
          <h6 class="card-text">{{ __('messages.decreased_by')}} 10%</h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">{{ __('messages.visitors_online')}} <i class="mdi mdi-diamond mdi-24px float-end"></i>
          </h4>
          <h2 class="mb-5">95,5741</h2>
          <h6 class="card-text">{{__('messages.increased_by')}} 5%</h6>
        </div>
      </div>
    </div>
  </div>
 @endsection