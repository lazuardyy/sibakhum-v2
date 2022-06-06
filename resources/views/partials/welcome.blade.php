<div class="alert bg-blue-100 rounded-lg p-2 text-base text-blue-700 flex items-center w-full alert-dismissible fade show shadow-md justify-end" role="alert">
  <span>Selamat Datang</span>
  <strong class="mr-1">
    @if(isset(Auth::user()->username))
      {{ Auth::user()->username }}
    @else
      {{-- {{ $response->nama }} --}}
    @endif
  </strong>
  <span>di {{ config('app.name', '') }}!</span>
  <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-blue-800 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-blue-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close">
    <i class="fa-solid fa-xmark"></i>
  </button>
</div>


