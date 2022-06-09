@if(session()->has('success'))
  @include('sweetalert::alert')

@elseif(session()->has('warning'))
  @include('sweetalert::alert')
@endif







