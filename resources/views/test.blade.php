<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  {{-- @foreach ((array)$datas as $d) --}}
    {{-- <p>{{ $d->namaProdi }}</p> --}}
    {{-- @endforeach --}}

  {{-- <p><?php var_dump($data) ?></p> --}}
  {{-- <p>{{ $datas }}</p> --}}
  {{-- @foreach($data as $d) --}}
    {{-- <p>{{ $data }}</p> --}}
  {{-- @endforeach --}}

  {{-- @foreach($datas as $data) --}}
    {{-- <?php var_dump($data['isi'][0]['namaFakultas']); ?> --}}
    {{-- <?php var_dump($datas); ?> --}}
  {{-- @endforeach --}}

  @foreach($datas as $index => $data)
    <p>{{ $data->namaFakultas }}</p>
    <p>{{ $data->kodeFakultas }}</p>
    <p>{{ $index }}</p>
  @endforeach
</body>
</html>
