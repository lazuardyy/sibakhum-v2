@if(session()->has('success'))
  @include('sweetalert::alert')

@elseif(session()->has('warning'))
  @include('sweetalert::alert')

@elseif(session()->has('error'))
  @include('sweetalert::alert')

@elseif(session()->has('toast_success'))
  @include('sweetalert::alert')

@elseif(session()->has('toast_warning'))
  @include('sweetalert::alert')

@elseif(session()->has('toast_error'))
  @include('sweetalert::alert')
@endif







