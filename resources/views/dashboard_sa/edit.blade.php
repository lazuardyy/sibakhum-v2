@extends('layouts.main')

@section('content')
<div class="container grid p-4 gap-3 justify-items-center pb-10">
    <div class="section__header">
        <h1 class="font-medium leading-tight text-2xl lg:text-4xl mt-0 mb-2 text-center">Ubah Data User</h1>
    </div>

    {{-- @if(session('success'))
      <div
        class="alert alert-success"
      >
        {{ session('success') }}
      </div>
    @endif --}}
    @include('flash-message')

    <div class="block p-6 rounded-lg shadow-lg bg-white w-full lg:w-7/12">
        <form class="" action="{{route('superadmin.update', $userId->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-6">
                <label for="username" class="form-label inline-block mb-2 text-gray-700">Username</label>
                <input
                  type="dropdown"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="username"
                  required
                  aria-describedby="username"
                  placeholder="Enter username"
                  name="username"
                  value="{{ $userId->username }}"
                >

                @error('username')
                  <small id="username" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div>

            <div class="form-group mb-6">
                <label for="role" class="form-label inline-block mb-2 text-gray-700">Role</label>
                <select id="role" name="role" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                >
                  <option value="{{ ($userId->role === $userId->role) ? "$userId->role" : "" }}">
                    {{ ($userId->role === $userId->role) ? "$userId->role" : "" }}
                  </option>

                  <option value="{{ ($userId->role === 'admin' && $userId->role !== 'superAdmin') ? 'superAdmin' : ''}}"
                  class="{{ ($userId->role === 'superAdmin') ? 'hidden' : ''}}"
                  >
                    {{ ($userId->role === 'admin' && $userId->role !== 'superAdmin') ? 'superAdmin' : ''}}
                  </option>

                  <option value="{{ ($userId->role === 'superAdmin' && $userId->role !== 'admin') ? 'admin' : ''}}"
                  class="{{ ($userId->role === 'admin') ? 'hidden' : ''}}"
                  >
                    {{ ($userId->role === 'superAdmin' && $userId->role !== 'admin') ? 'admin' : ''}}
                  </option>
                </select>
            </div>


            {{-- <div class="form-group mb-6">
                <label for="password" class="form-label inline-block mb-2 text-gray-700">Current Password</label>
                <input type="password"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition
                  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="password"
                  required
                  placeholder="Current Password"
                  name="password"
                >

                @error('password')
                  <small id="current_password" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div> --}}

            {{-- <div class="form-group mb-6">
                <label for="new_password" class="form-label inline-block mb-2 text-gray-700">New Password</label>
                <input type="password"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition
                  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="new_password"
                  required
                  placeholder="New Password"
                  name="new_password"
                >

                @error('new_password')
                  <small id="new_password" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div> --}}

            {{-- <div class="form-group mb-6">
                <label for="new_confirm_password" class="form-label inline-block mb-2 text-gray-700">New Password Confirmation</label>
                <input type="password"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition
                  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="new_confirm_password"
                  required
                  placeholder="New Password Confirmation"
                  name="new_confirm_password"
                >

                @error('new_confirm_password')
                  <small id="new_confirm_password" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div> --}}

            <div class="flex justify-end gap-2">
              <a href="{{ route('superadmin.index') }}" class="inline-block px-3 py-2.5 bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '500' : '600') }} text-white font-medium text-xs lg:leading-tight uppercase rounded shadow-md hover:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '600' : '700') }} hover:shadow-lg focus:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '600' : '700') }} focus:shadow-lg focus:outline-none focus:ring-0 active:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '700' : '800') }} active:shadow-lg transition duration-150 ease-in-out">
                <i class="{{ (session('success') ? 'fa-solid fa-arrow-left underline decoration-1' : 'fa-solid fa-ban') }}
                "></i>
                <span class="hidden lg:inline-block">{{ (session('success') ? 'Kembali' : 'Batal') }}</span>
              </a>

                <button type="submit"
                    class=" px-3 {{-- lg:px-6 --}} py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
        {{-- @include('sweetalert::alert') --}}
    </div>
</div>
@endsection
