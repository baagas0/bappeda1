<section>
<div class="hb-sectiontitle">
	<h2 style="color:#D62255;"><span>Sedulur Perencana</span>
		Sistem dan Aplikasi
	</h2>
</div>
<div class="container" style="padding-bottom: 30px">
	<div class="row justify-content-md-center" style="justify-content: center;">
		@foreach($apps as $app)
		<div class="col-md-4 center" style="">
			<a href="{{ $app->url }}">
			<img src="{{ asset($app->photo) }}" class="img-circle" style="display: block;
    margin: 0 auto;width: 150px; height: 150px;">
			<h5 class="text-center" style="padding-top: 15px">{{ $app->title }}</h5>
			</a>
		</div>
		@endforeach
	</div>
</div>
</section>


