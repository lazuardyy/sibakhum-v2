@extends('layouts.main')

@section('content')
  <div class="container grid p-4 gap-4">
    @include('partials.header')
    @include('flash-message')

    {{-- <div class="flex flex-col lg:grid lg:grid-cols-2 gap-3">
      <div class="col-1">
        <table class="w-full mb-3" id="tabel-dosen">
          <thead class="border-b">
            <tr class="bg-indigo-100 border-indigo-200 border-2">
              <th>
                No.
              </th>
              <th scope="col" class="text-xs lg:text-base font-medium text-gray-900 px-2 py-4 text-center border-indigo-200 border-2">
                Details
              </th>
              <th scope="col" class="text-xs lg:text-base font-medium text-gray-900 px-2 py-4 text-center border-indigo-200 border-2">
                Status
              </th>
              <th scope="col" class="text-base font-medium text-gray-900 px-2 py-4 text-center border-indigo-200 border-2">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($dosens as $dosen)
              @foreach ($dosen->cutis as $student)
                <tr>
                  <td>1</td>
                  <td class="border-b border-2">
                    <!-- Button trigger modal -->
                    <button type="button"
                    class="inline-block text-black underline decoration-1 font-medium text-xs lg:text-base leading-tight text-left"
                    data-bs-toggle="modal" data-bs-target="#modal_{{$cuti->id }}">
                      {{$cuti->nama }}
                    </button>

                    <!-- Modal -->
                    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto z-10 backdrop-brightness-50 bg-white/30"
                    id="modal_{{ $cuti->id }}" tabindex="-1" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-scrollable relative w-auto mt-16 flex justify-center self-center pointer-events-none">
                      <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-4/5 lg:w-3/6 pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div
                          class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                            Detail Pengajuan Cuti
                          </h5>
                          <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body relative p-4">
                          <table>
                            <thead>
                              <tr>
                                <th class="text-left">Nama</th>
                                <td><span>:</span> {{ $cuti->nama }}</td>
                              </tr>
                              <tr>
                                <th class="text-left">NIM</th>
                                <td><span>:</span> {{ $cuti->nim }}</td>
                              </tr>
                              <tr>
                                <th class="text-left">Tahun Angkatan</th>
                                <td><span>:</span> {{ $cuti->tahun_angkatan }}</td>
                              </tr>
                              <tr>
                                <th class="text-left">Keterangan</th>
                                <td><span>:</span> {{ $cuti->keterangan }}</td>
                              </tr>
                            </thead>
                          </table>
                        </div>
                        <div
                          class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                          <button type="button"
                            class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                            data-bs-dismiss="modal">
                            Close
                          </button>
                        </div>
                      </div>
                    </div>
                    </div>
                  </td>

                  <form action="{{ route('persetujuan.store') }}" method="POST">
                    @csrf
                    <td class="border-b border-2 text-center">
                      @foreach($dosen->detailCutiMhs as $detail)
                        <div class="pretty p-icon p-round p-plain p-smooth">
                          <input type="radio" name="status_persetujuan_pa" value="disetujui" {{ ($detail->status_persetujuan_pa === 'disetujui') ? 'checked disabled' : 'disabled' }}>
                          <div class="state p-primary-o">
                              <i class="icon fa-solid fa-check"></i>
                              <label>Disetujui</label>
                          </div>
                        </div>

                        <div class="pretty p-icon p-round p-plain p-smooth">
                            <input type="radio" name="status_persetujuan_pa" value="ditolak" {{ ($detail->status_persetujuan_pa === 'ditolak') ? 'checked disabled' : 'disabled' }}>
                            <div class="state p-danger-o">
                                <i class="icon fa-solid fa-ban"></i>
                                <label>Ditolak</label>
                            </div>
                        </div>
                      @endforeach
                    </td>

                      <td class="border-b border-2 text-center">
                        <button type="button" class="inline-block px-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-toggle="modal" data-bs-target="#modal_{{ $cuti->nama }}"
                        >
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            <span class="hidden lg:inline-block">Submit</span>
                        </button>

                          <div class="modal fade fixed top-0 left-0 right-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto z-10 backdrop-brightness-50 bg-white/30" id="modal_{{ $cuti->nama }}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">

                            <div class="modal-dialog modal-dialog-centered relative flex justify-center self-center w-auto pointer-events-none">

                              <div class="modal-content border-none shadow-lg flex flex-col mt-40 w-4/5 lg:w-3/6 pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">

                                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                  <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                                      {{ $cuti->nama }}
                                  </h5>
                                  <button type="button"
                                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                    data-bs-dismiss="modal" aria-label="Close">
                                  </button>
                                </div>

                                <div class="modal-body relative p-4 text-left">
                                  <p>Apakah anda yakin ingin menyetujui/menolak data?</p>
                                </div>

                                <div
                                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                  <button type="button"
                                      class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                      data-bs-dismiss="modal">
                                      <i class="fa-solid fa-ban"></i>
                                      <span class="hidden lg:inline-block">Batal</span>
                                  </button>

                                  @csrf
                                  @method('POST')
                                  <?php var_dump($cuti->id);?>
                                  <button type="submit"
                                      class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                                      >
                                      <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                      <span class="hidden lg:inline-block">Submit</span>
                                  </button>
                                </div>
                              </div>
                            </div>
                        </div>
                      </td>
                  </form>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
        </table>
      </div>
    </div> --}}

    <div class="bg-slate-50 shadow-md p-3 rounded-md">
      <table class="w-full mb-3 pt-3" id="tabel-dosen">
        <thead>
          <tr>
            <th>No.</th>
            <th>Details</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($detailCuti as $detail)
            @foreach ($detail->students as $index => $student)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                  <button type="button"
                  class="inline-block text-black underline decoration-1 font-medium text-sm lg:text-base leading-tight text-left"
                  data-bs-toggle="modal" data-bs-target="#modal_{{$student->id }}">
                    {{$student->nama }}
                  </button>

                  <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto z-10
                  backdrop-brightness-50 bg-white/30"
                  id="modal_{{ $student->id }}" tabindex="-1" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">

                  <div class="modal-dialog modal-dialog-scrollable relative w-auto mt-16 flex justify-center self-center pointer-events-none">
                    <div
                      class="modal-content border-none shadow-lg relative flex flex-col w-4/5 lg:w-3/6 pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                      <div
                        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                          Detail Pengajuan Cuti
                        </h5>
                        <button type="button"
                          class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                          data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body relative p-4">
                        <table>
                          <thead>
                            <tr>
                              <th class="text-left">Nama</th>
                              <td><span>:</span> {{ $student->nama }}</td>
                            </tr>
                            <tr>
                              <th class="text-left">NIM</th>
                              <td><span>:</span> {{ $student->nim }}</td>
                            </tr>
                            <tr>
                              <th class="text-left">Tahun Angkatan</th>
                              <td><span>:</span> {{ $student->tahun_angkatan }}</td>
                            </tr>
                            <tr>
                              <th class="text-left">Keterangan</th>
                              <td><span>:</span> {{ $student->keterangan }}</td>
                            </tr>
                          </thead>
                        </table>
                      </div>
                      <div
                        class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button"
                          class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                          data-bs-dismiss="modal">
                          Close
                        </button>
                      </div>
                    </div>
                  </div>
                  </div>
                </td>

                {{-- <form action="{{ route('persetujuan.store') }}" method="POST">
                  @csrf
                  <td>
                    @foreach($dosen->detailCutiMhs as $detail)
                      <div class="pretty p-icon p-round p-plain p-smooth">
                        <input type="radio" name="status_persetujuan_pa" value="disetujui" {{ ($detail->status_persetujuan_pa === 'disetujui') ? 'checked disabled' : 'disabled' }}>
                        <div class="state p-primary-o">
                            <i class="icon fa-solid fa-check"></i>
                            <label>Disetujui</label>
                        </div>
                      </div>

                      <div class="pretty p-icon p-round p-plain p-smooth">
                          <input type="radio" name="status_persetujuan_pa" value="ditolak" {{ ($detail->status_persetujuan_pa === 'ditolak') ? 'checked disabled' : 'disabled' }}>
                          <div class="state p-danger-o">
                              <i class="icon fa-solid fa-ban"></i>
                              <label>Ditolak</label>
                          </div>
                      </div>
                    @endforeach
                  </td>

                    <td>
                      <button type="button" class="inline-block px-3 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                      data-bs-toggle="modal" data-bs-target="#modal_{{ $student->nama }}"
                      >
                          <i class="fa-solid fa-arrow-up-right-from-square"></i>
                          <span class="hidden lg:inline-block">Submit</span>
                      </button>

                        <div class="modal fade fixed top-0 left-0 right-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto z-10 backdrop-brightness-50 bg-white/30" id="modal_{{ $student->nama }}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">

                          <div class="modal-dialog modal-dialog-centered relative flex justify-center self-center w-auto pointer-events-none">

                            <div class="modal-content border-none shadow-lg flex flex-col mt-40 w-4/5 lg:w-3/6 pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">

                              <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                                    {{ $student->nama }}
                                </h5>
                                <button type="button"
                                  class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                  data-bs-dismiss="modal" aria-label="Close">
                                </button>
                              </div>

                              <div class="modal-body relative p-4 text-left">
                                <p>Apakah anda yakin ingin menyetujui/menolak data?</p>
                              </div>

                              <div
                              class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                <button type="button"
                                    class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"
                                    data-bs-dismiss="modal">
                                    <i class="fa-solid fa-ban"></i>
                                    <span class="hidden lg:inline-block">Batal</span>
                                </button>

                                @csrf
                                @method('POST')
                                <?php var_dump($student->id);?>
                                <button type="submit"
                                    class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out ml-1"
                                    >
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    <span class="hidden lg:inline-block">Submit</span>
                                </button>
                              </div>
                            </div>
                          </div>
                      </div>
                    </td>
                </form> --}}

                </tr>
              @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
