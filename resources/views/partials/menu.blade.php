@if(session('user_cmode') == '1')
  <a href="{{ url('home/') }}" class="link__item block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-house"></i>
    <span class="hidden lg:block">Home</span>
  </a>

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

@elseif(session('user_cmode') == '2' || session('user_cmode') == '3' || session('user_cmode') == '4' || session('user_cmode') == '9')
  <a href="{{ url('home/') }}" class="link__item block p-1 w-9 h-9 lg:w-full rounded shadow-md hover:bg-green-800">
    <i class="fa-solid fa-house"></i>
    <span class="hidden lg:block">Home</span>
  </a>
@endif



