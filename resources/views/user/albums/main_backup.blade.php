@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('content')
<style>
  .custom {color: red}
</style>
<?php use App\Models\Album as AlbumModels;use App\Models\Galeri as GaleriModels;
  $album = AlbumModels::get();

?>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  @foreach($album as $a)
  <li class="nav-item" style="padding-bottom: 10px;padding-top: 10px;">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#{{ $a->id }}" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $a->album }}</a>
  </li>
  @endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
  @foreach($album as $a)
  <?php 
    $foto = GaleriModels::where('idalbum', $a->id)->get();
  ?>
  <div class="tab-pane fade" id="{{ $a->id }}" role="tabpanel" aria-labelledby="pills-profile-tab">
    @foreach($foto as $f)
      <img src="{{ $f->urlpict }}" style="height: 250px;width: auto;padding-bottom: 5px">
    @endforeach
  </div>
  @endforeach
</div>
@endsection