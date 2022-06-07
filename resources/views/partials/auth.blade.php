{{-- @guest
  @if (Route::has('login'))
    @include('auth.login')
  @endif

  @else --}}
  <div class="w-full">
    <form id="logout-form" action="/logout" method="POST">
      @csrf
      <button type="submit" class="block p-1 w-9 h-9 lg:w-full text-center bg-red-600 hover:bg-red-700 text-violet-50 rounded leading-7">
        <i class="fa-solid fa-power-off"></i>
        <span class="invisible lg:visible leading-7">
          {{ __('Logout') }}
        </span>
      </button>
    </form>
  </div>
{{-- @endguest --}}

