@extends('layouts.main')

@section('content')
  {{-- mobile device --}}
  <div class="container grid p-2 gap-2 w-full">
    @include('partials.header')
    @include('partials.welcome')

    <div class="button">
      <a href="{{ route('superadmin.create') }}" class="mt-3 inline-block px-3 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
        <i class="fa-solid fa-plus"></i>
        <span class="hidden lg:inline-block">Tambah Data User</span>
      </a>
    </div>

    @include('flash-message')

    <div class="overflow-x-auto bg-slate-50 shadow-md p-3 rounded-md">
      <table class="table table-striped table-bordered m-2" cellspacing="0" id="tabel-data" >
        <thead>
          <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($users as $index => $user)
          <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->role}}</td>
              <td>
                <ul class="flex justify-center gap-2">
                    <a href="{{ route('superadmin.edit', $user->id) }}" class="inline-block px-3 py-2.5 bg-yellow-500 text-white font-medium text-xs lg:leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span class="hidden lg:inline-block">Edit</span>
                    </a>

                    <form action="{{ route('superadmin.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="inline-block px-3 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-toggle="modal" data-bs-target="#modal_{{ $user->id }}"
                        >
                            <i class="fa-solid fa-trash-can"></i>
                            <span class="hidden lg:inline-block">Hapus</span>
                        </button>

                        <div class="modal fade fixed top-0 left-0 right-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto z-10 backdrop-brightness-50 bg-white/30" id="modal_{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">

                          <div class="modal-dialog modal-dialog-centered relative flex justify-center self-center w-auto pointer-events-none">

                            <div class="modal-content border-none shadow-lg flex flex-col mt-40 w-auto pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">

                              <div class="modal-header flex flex-shrink-0 items-center justify-center p-4 rounded-t-md">
                                <i class="fa-solid fa-exclamation text-red-600 text-4xl"></i>
                                <button type="button"
                                  class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                  data-bs-dismiss="modal" aria-label="Close">
                                </button>
                              </div>

                              <div class="modal-body relative p-2 flex justify-center">
                                <p class="normal-case">Apakah anda yakin ingin menghapus data {{ $user->username }}?</p>
                              </div>

                              <div
                              class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-center p-4 border-t border-gray-200 rounded-b-md">
                                <button type="button"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    data-bs-dismiss="modal">
                                    <i class="fa-solid fa-ban"></i>
                                    <span class="hidden lg:inline-block">Batal</span>
                                </button>

                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                                    >
                                    <i class="fa-solid fa-trash-can"></i>
                                    <span class="hidden lg:inline-block">Hapus</span>
                                </button>
                              </div>
                            </div>
                          </div>
                      </div>
                  </form>
                </ul>
              </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>
@endsection
