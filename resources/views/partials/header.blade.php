<section class="content-header">
  <div class="container-fluid">
    <header class="row mb-2">
      <div class="col-sm-6">
        <h4>{{ $title }}</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">{{ $active }}</a></li>

          @if($subtitle !== null)
            <li class="breadcrumb-item">{{ strtok(trim(parse_url($subtitle, PHP_URL_PATH), '/'), '/') }}</li>
            <li class="breadcrumb-item">{{ basename(parse_url($subtitle, PHP_URL_PATH)) }}</li>
          @else
            <li class="breadcrumb-item">{{ $title }}</li>
          @endif
        </ol>
      </div>
    </header>
  </div>
</section>

