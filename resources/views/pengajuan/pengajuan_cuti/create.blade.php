@extends('layouts.main')

@section('content')
<div class="container grid p-2 pb-4">
  @include('partials.header')

  <div class="alert alert-info text-center">
    <ul class="list-unstyled text-left">Catatan :
        <li>Data Mahasiswa diperoleh dari SIAKAD, sehingga bila terdapat perbedaan data, silahkan perbaiki biodata anda di SIAKAD.</li>
    </ul>
  </div>

  <div class="block p-6 rounded-lg shadow-md bg-white">
    @include('flash-message')

    <form action="{{route('pengajuan-mhs.store')}}" method="POST" class="md:grid md:grid-cols-2 gap-x-7">
      @csrf
      <div>
        @include('pengajuan.index')
      </div>

      <div>
        @foreach($datas as $key => $data)
          <div class="form-group mb-6">
            <label for="{{ $data['typeInput'] }}" class="form-label inline-block mb-2 text-gray-700">{{ $data['title'] }}</label>
            @if($data['typeInput'] != 'keterangan')
              <x-inputs.input type="{{ $data['type'] }}" typeInput="{{ $data['typeInput'] }}" placeholder="{{ $data['placeholder'] }}" message="" note="{{ $data['note'] }}" value="{{ ($data['typeInput'] == 'tahun_angkatan') ? $pengajuan['angkatan'] : $data['value'] }}"/>

              {{-- @if($data['typeInput'] == 'tahun_angkatan')
              <x-inputs.input type="{{ $data['type'] }}" typeInput="{{ $data['typeInput'] }}" placeholder="{{ $data['placeholder'] }}" message="" note="{{ $data['note'] }}" value="{{ $pengajuan['angkatan'] }}" />
              @endif --}}
            @else
              <textarea
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="{{ $data['typeInput'] }}"
                required
                aria-describedby="{{ $data['typeInput'] }}"
                placeholder="{{ $data['placeholder'] }}"
                name="{{ $data['typeInput'] }}"
                rows="5"
                style="resize: none;"
                value="{{ old($data['typeInput']) }}"
              ></textarea>
              @error($data['typeInput'])
                <small id="{{ $data['typeInput'] }}" class="block mt-1 text-xs text-red-600">
                  {{ $message }}
                </small>
              @enderror
            @endif
          </div>
        @endforeach

        <div class="flex gap-2">
          <x-button.button-href buttonName="batal" btnColor="red" href="/home" buttonIcon="fa-solid fa-ban"/>
          <x-button.button-submit buttonName="ajukan" type="submit" buttonColor="green" buttonIcon="fa-solid fa-floppy-disk"/>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
