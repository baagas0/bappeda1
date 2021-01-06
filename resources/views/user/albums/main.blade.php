@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('content')
<!--************************************
        Banner Start
        *************************************-->
        {{-- <div id="hb-innerbanner" class="hb-innerbanner hb-haslayout">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="hb-innerbanner-area">
                  <div  class="hb-bannarheading">
                    <h1>Our Gallery</h1>
                  </div>
                  <ul class="hb-breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li>Our Gallery</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
    <!--************************************
        Banner End
        *************************************-->

    <!--************************************
        Main Start
        *************************************-->
        <main id="hb-main" class="hb-main hb-haslayout">
      <!--************************************
            Our Gallery Start
            *************************************-->
            <section id="hb-gallery" class="hb-gallery v2 hb-sectionspace hb-haslayout">
              <div class="container">
                <div class="row">
                  <div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
                    <div class="hb-sectionhead mb-50">
                      <div class="hb-sectiontitle">
                        <h2><span>Bappeda</span>
                          Foto Gallery Bappedaa
                        </h2>
                      </div>
                    </div>
                  </div>
                  <div class=" col-xs-12">
                    <div class="hb-gallery-area">
                      <div class="hb-portfolio-head hb-haslayout">
                        <ul id="hb-filterbale-nav" class="hb-filterbale-nav option-set">
                          <li><a class="active" data-filter="*" href="javascript:void(0);">SEMUA FOTO</a></li>
                          <?php use App\Models\Album as AlbumModels;use App\Models\Galeri as GaleriModels;
                          $albums = AlbumModels::get();
                          $bidangs = DB::table('bidangs')->whereNotIn('route', ['Sekretariat'])->get();

                          $sosbuds 			= DB::table('igfeeds')->where('is_sosbud', 1)->orderBy('id_ig', 'DESC')->paginate(3);
						 $ekonomis 		= DB::table('igfeeds')->where('is_ekonomi', 1)->orderBy('id_ig', 'DESC')->paginate(3);
						 $infrastrukturs 	= DB::table('igfeeds')->where('is_infrastruktur', 1)->orderBy('id_ig', 'DESC')->paginate(3);
						 $ppes 			= DB::table('igfeeds')->where('is_ppe', 1)->orderBy('id_ig', 'DESC')->paginate(3);
						 $litbangs 		= DB::table('igfeeds')->where('is_litbang', 1)->orderBy('id_ig', 'DESC')->paginate(3);
                          ?>

                          @foreach($albums as $album)
                          <li><a data-filter=".{{ $album->id }}" href="javascript:void(0);">{{ $album->album }}</a></li>
                          @endforeach
                          <br>
                          @foreach($bidangs as $bidang)
                          <li><a data-filter=".{{ $bidang->route }}" href="javascript:void(0);">{{ $bidang->route }}</a></li>
                          @endforeach
                        </ul>
                      </div>
                      <div id="filter-masonry" class="hb-portfolio-content hb-haslayout">
                        @foreach($albums as $album)
                        <?php 
                          $fotos = GaleriModels::where('idalbum', $album->id)->paginate(3);
                        ?>
                        @foreach($fotos as $foto)
                        <div class="masonry-grid {{ $album->id }}">
                          <div class="hb-project">
                            <figure class="hb-galleryimg">
                              <img src="{{ $foto->urlpict }}" alt="images description">
                              <figcaption class="hb-gallerycontent">
                                <h3>{{ $foto->ket }}</h3>
                                <span>{{ $foto->created_at->format('d M Y') }}</span>
                              </figcaption>
                            </figure>
                          </div>
                        </div>
                        @endforeach
                        @endforeach

                        @foreach($sosbuds as $sosbud)
                        <div class="masonry-grid BPSB">
                          <div class="hb-project">
                            <figure class="hb-galleryimg">
                            	@foreach(json_decode($sosbud->file) as $d)
                              	@if($loop->iteration > 1 )
                              	@break
                              	@endif

                              	@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
                              	<video style="width: 100%;" controls>
                              		<source src="{{ asset($d) }}" type="video/mp4">
                              			Your browser does not support the video tag.
                              		</video>
                              		@else 
                              		<img src="{{ asset($d) }}" alt="">
                              	@endif
                            	@endforeach
                              <figcaption class="hb-gallerycontent">
                                <h3>Sosial Budaya</h3>
                                <span>{{ Carbon\Carbon::parse($sosbud->created_at)->format('d M Y') }}</span>
                              </figcaption>
                            </figure>
                          </div>
                        </div>
                        @endforeach
						
						@foreach($ekonomis as $ekonomi)
                        <div class="masonry-grid Ekonomi">
                          <div class="hb-project">
                            <figure class="hb-galleryimg">
                            	@foreach(json_decode($ekonomi->file) as $d)
                              	@if($loop->iteration > 1 )
                              	@break
                              	@endif

                              	@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
                              	<video style="width: 100%;" controls>
                              		<source src="{{ asset($d) }}" type="video/mp4">
                              			Your browser does not support the video tag.
                              		</video>
                              		@else 
                              		<img src="{{ asset($d) }}" alt="">
                              	@endif
                            	@endforeach
                              <figcaption class="hb-gallerycontent">
                                <h3>Ekonomi</h3>
                                <span>{{ Carbon\Carbon::parse($ekonomi->created_at)->format('d M Y') }}</span>
                              </figcaption>
                            </figure>
                          </div>
                        </div>
                        @endforeach
						
						@foreach($infrastrukturs as $inf)
                        <div class="masonry-grid Inftrastruktur">
                          <div class="hb-project">
                            <figure class="hb-galleryimg">
                            	@foreach(json_decode($inf->file) as $d)
                              	@if($loop->iteration > 1 )
                              	@break
                              	@endif

                              	@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
                              	<video style="width: 100%;" controls>
                              		<source src="{{ asset($d) }}" type="video/mp4">
                              			Your browser does not support the video tag.
                              		</video>
                              		@else 
                              		<img src="{{ asset($d) }}" alt="">
                              	@endif
                            	@endforeach
                              <figcaption class="hb-gallerycontent">
                                <h3>Inftrastruktur</h3>
                                <span>{{ Carbon\Carbon::parse($inf->created_at)->format('d M Y') }}</span>
                              </figcaption>
                            </figure>
                          </div>
                        </div>
                        @endforeach
						
						@foreach($ppes as $ppe)
                        <div class="masonry-grid PPE">
                          <div class="hb-project">
                            <figure class="hb-galleryimg">
                            	@foreach(json_decode($ppe->file) as $d)
                              	@if($loop->iteration > 1 )
                              	@break
                              	@endif

                              	@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
                              	<video style="width: 100%;" controls>
                              		<source src="{{ asset($d) }}" type="video/mp4">
                              			Your browser does not support the video tag.
                              		</video>
                              		@else 
                              		<img src="{{ asset($d) }}" alt="">
                              	@endif
                            	@endforeach
                              <figcaption class="hb-gallerycontent">
                                <h3>PPE</h3>
                                <span>{{ Carbon\Carbon::parse($ppe->created_at)->format('d M Y') }}</span>
                              </figcaption>
                            </figure>
                          </div>
                        </div>
                        @endforeach
						
						@foreach($litbangs as $litbang)
                        <div class="masonry-grid Litbang">
                          <div class="hb-project">
                            <figure class="hb-galleryimg">
                            	@foreach(json_decode($litbang->file) as $d)
                              	@if($loop->iteration > 1 )
                              	@break
                              	@endif

                              	@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
                              	<video style="width: 100%;" controls>
                              		<source src="{{ asset($d) }}" type="video/mp4">
                              			Your browser does not support the video tag.
                              		</video>
                              		@else 
                              		<img src="{{ asset($d) }}" alt="">
                              	@endif
                            	@endforeach
                              <figcaption class="hb-gallerycontent">
                                <h3>Litbang</h3>
                                <span>{{ Carbon\Carbon::parse($litbang->created_at)->format('d M Y') }}</span>
                              </figcaption>
                            </figure>
                          </div>
                        </div>
                        @endforeach

                      </div>
						<div style="float: right">
						{{ $ppes->links('vendor.pagination.template') }}
						</div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
      <!--************************************
            Our Gallery End
            *************************************-->
          </main>
    <!--************************************
        Main End
        *************************************-->
        @endsection