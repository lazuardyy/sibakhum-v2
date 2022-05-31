@can('isSuperAdmin')
  <a href="{{ url('home/superadmin') }}" class="link__item {{ ($title === 'Super Admin') ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-house"></i>
    <span class="hidden lg:block">Home</span>
  </a>
@endcan

@can('isDosen')
  <a href="{{ url('home/dosen') }}" class="link__item {{ ($title === 'Lecturer') ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-house"></i>
    <span class="hidden lg:block">Home</span>
  </a>
@endcan


@can('isStudent')
  <a href="{{ url('home/mahasiswa') }}" class="link__item {{ ($title === 'Mahasiswa') ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-house"></i>
    <span class="hidden lg:block">Home</span>
  </a>
@endcan

{{-- @can('isSuperAdmin')
  <a href="{{url('/user')}}" class="link__item {{ ($title === "User Data") ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-user"></i>
    <span class="hidden lg:block">Users</span>
  </a>
@endcan --}}

@can('isSuperAdmin')
  <div>
    <div class="dropdown relative">
      <a
        class="dropdown-toggle p-3 w-9 h-9 lg:w-full text-white font-medium leading-tight rounded shadow-md transition duration-150 link__item lg:justify-center flex flex-col lg:flex-row whitespace-nowrap {{ ($title ==='Fakultas' || $title === 'Universitas') ? 'active' : '' }} hover:bg-green-800"
        href="#"
        type="button"
        id="dropdownMenuButton2"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <i class="fa-solid fa-chart-line chart"></i>
        <span class="hidden lg:inline-block">Data & Grafik</span>
        <i class="fa-solid fa-caret-down hidden lg:inline-block"></i>
        {{-- <svg
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="caret-down"
          class="w-2"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 320 512"
          class="hidden lg:inline-block"
        > --}}
          {{-- <path
            class="hidden lg:inline-block"
            fill="currentColor"
            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
          ></path> --}}
        </svg>
      </a>

      <ul
        class="dropdown-menu min-w-max lg:w-full absolute bg-white text-sm lg:text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
        aria-labelledby="dropdownMenuButton2"
      >
        <li>
          <a
            class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
            href="{{ url('data-grafik/universitas') }}"
          >
            Data Universitas
          </a>
        </li>
        <li>
          <a
            class=" dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
            href="{{ url('data-grafik/fakultas') }}"
          >
            Data Fakultas
          </a>
        </li>
      </ul>
    </div>
  </div>
@endcan

{{-- @can('isDosen')
  <a href="{{url('home/dosen')}}" class="link__item {{ ($title === "Dosen") ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-chalkboard-user"></i>
    <span class="hidden lg:block">Dosen</span>
  </a>
@endcan --}}

{{-- @can('isStudent')
<a href="{{url('/mahasiswa')}}" class="link__item {{ ($title === "Mahasiswa") ? 'active' : '' }} block p-1 w-9 h-9 lg:w-full rounded shadow-md">
    <i class="fa-solid fa-user-graduate"></i>
    <span class="invisible lg:visible">Mahasiswa</span>
</a>
@endcan --}}
{{--
@can('isSuperAdminAdmin')

@endcan --}}


