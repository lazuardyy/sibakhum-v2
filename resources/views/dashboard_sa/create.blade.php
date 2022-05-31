@extends('layouts.main')

@section('content')
<div class="container grid p-4 gap-3 justify-items-center pb-10">
    <div class="section__header">
        <h1 class="font-medium leading-tight text-2xl lg:text-4xl mt-0 mb-2 text-center">Buat User Baru</h1>
    </div>

    <div class="block p-6 rounded-lg shadow-lg bg-white w-full lg:w-7/12">
        {{-- <div class="button py-4">
            <a href="{{ route('user.index') }}" class="underline decoration-1 text-sm text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out mb-4 cursor-pointer">
                <i class="fa-solid fa-arrow-left underline decoration-1"></i>
                <span class="underline decoration-1">Kembali</span>
            </a>
        </div> --}}

        @include('flash-message')

        <form class="" action="{{route('superadmin.store')}}" method="POST">
            @csrf
            <div class="form-group mb-6">
                <label for="username" class="form-label inline-block mb-2 text-gray-700">Username</label>
                <input
                  type="text"
                  class="form-control block w-full px-3 py-1.5 text-base
                  font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="username"
                  required
                  aria-describedby="username"
                  placeholder="Enter username"
                  name="username"
                  value="{{ old('username') }}"
                >
                @error('username')
                  <small id="username" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div>
            <div class="form-group mb-6">
                <label for="role" class="form-label inline-block mb-2 text-gray-700">Role</label>
                <select id="role" name="role"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:outline-none">
                    <option value="superAdmin">superAdmin</option>
                    <option value="admin">admin</option>
                    <option value="student">student</option>
                    <option value="dosen">dosen</option>
                </select>
            </div>

            {{-- <div class="form-group mb-6">
                <label for="email" class="form-label inline-block mb-2 text-gray-700">Email address</label>
                <input type="email"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="email"
                  required
                  aria-describedby="email"
                  placeholder="Enter email"
                  name="email"
                  value="{{ old('email') }}"
                >
                @error('email')
                  <small id="email" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div> --}}

            <div class="form-group mb-6">
              <label for="password" class="form-label inline-block mb-2 text-gray-700">Password</label>
              <input type="password"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="password"
                required
                placeholder="Password"
                name="password"
              >

              @error('password')
              <small id="password" class="block mt-1 text-xs text-red-600">
                {{ $message }}
              </small>
              @enderror
            </div>

            <div class="form-group mb-6">
              <label for="confirm_password" class="form-label inline-block mb-2 text-gray-700">Confirm Password</label>
              <input type="password"
                  class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="ulangi_password"
                  required
                  placeholder="Confirm Password"
                  name="confirm_password"
                >

                @error('confirm_password')
                  <small id="ulangi_password" class="block mt-1 text-xs text-red-600">
                    {{ $message }}
                  </small>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
              <a href="{{ route('superadmin.index') }}" class="inline-block px-3 py-2.5 bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '500' : '600') }} text-white font-medium text-xs lg:leading-tight uppercase rounded shadow-md hover:bg-{{ (session('success') ? 'yellow' : 'red ') }}-{{ (session('success') ? '600' : '700') }} hover:shadow-lg focus:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '600' : '700') }} focus:shadow-lg focus:outline-none focus:ring-0 active:bg-{{ (session('success') ? 'yellow' : 'red') }}-{{ (session('success') ? '700' : '800') }} active:shadow-lg transition duration-150 ease-in-out">
                <i class="{{ (session('success') ? 'fa-solid fa-arrow-left underline decoration-1' : 'fa-solid fa-ban') }}
                "></i>
                <span class="text-xs lg:text-md">{{ (session('success') ? 'Kembali' : 'Batal') }}</span>
              </a>

                <button type="submit"
                  class=" px-3 {{-- lg:px-6 --}} py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                  >
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span class="text-xs lg:text-md">Buat Data</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
