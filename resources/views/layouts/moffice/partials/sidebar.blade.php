	<div class="sidebar-panel">
		<ul id="slide-out" class="collapsible sidenav side-left side-nav sidenav-close">
			<li>
                <div class="user-view">
                    <div class="background">
                        <img src=" {{ asset('backend/moffice/images/bg-user.jpg') }}" alt="">
                    </div>
                    <img class="circle responsive-img" src="{{ Auth::user()->image }}" alt="">
                    <span class="white-text name">{{ Auth::user()->name }}</span> <!---->
                </div>
            </li>
            <li><a href="{{ route('.moffice') }}"><i class="fa fa-home"></i>Beranda</a></li>
			<li><label>peminjaman</label></li>
			<li><a href="{{ route('.moffice.rapat') }}"><i class="fa fa-building"></i>Ruang Rapat</a></li>
			<li><a href="{{ route('.moffice.zoom') }}"><i class="fa fa-camera"></i>Zoom</a></li>
			<li><label>Surat Menyurat</label></li>
			<li><a href="{{ route('.moffice.surat.all') }}"><i class="fa fa-envelope"></i>Surat Lama</a></li>
			<?php use App\Models\Structure as StructureModels;
				$st = StructureModels::findOrFail(Auth::user()->id);
			?>
			@foreach(json_decode($st->roles->pluck('name')) as $d)
                @if($d == 'madmin')
					<li><label>Menu Admin</label></li>
					<li><a href="{{ route('.moffice.users') }}"><i class="fa fa-user"></i>User</a></li>
					<li><a href="{{ route('.moffice.data.ruang') }}"><i class="fa fa-list-alt"></i>Data Ruang</a></li>
					<li><a href="{{ route('.moffice.data.barang') }}"><i class="fa fa-list-alt"></i>Data Zoom</a></li>
				@endif
			@endforeach
			<li><label>Keluar</label></li>
            <li><a href="{{ route('moffice.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-sign-out"></i>Logout</a></li>
			<form id="frm-logout" action="{{ route('moffice.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
		</ul>
	</div>