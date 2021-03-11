<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

  {{-- ロゴ --}}
  <a class="navbar-brand" href="{{ route('home') }}">PhotoBon_92</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  {{-- ナビバー --}}
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown">
          画像一覧
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('getList') }}">画像一覧</a>
          <a class="dropdown-item" href="{{ route('getList_92') }}">画像一覧（管理）</a>
        </div>
      </div>      
      <a class="nav-item nav-link active" href="{{ route('getForm_92') }}">画像アップロード</a>

      {{-- SEページ --}}
      <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-toggle="dropdown">
          SE画像一覧
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('SeGetList') }}">SE画像一覧</a>
          <a class="dropdown-item" href="{{ route('SeGetList_92') }}">SE画像一覧（管理）</a>
        </div>
      </div>      
      <a class="nav-item nav-link active" href="{{ route('SeGetForm_92') }}">SE画像アップロード</a>
    </div>
  </div>
  

</nav>