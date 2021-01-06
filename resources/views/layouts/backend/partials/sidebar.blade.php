<div class="sidebar-left">
    <div class="sidebar-left-info">

        <div class="user-box">
            <div class="d-flex justify-content-center">
                <img src="{{ asset(Auth::user()->photo) }}" alt="" class="img-fluid rounded-circle"> 
            </div>
            <div class="text-center text-white mt-2">
                <h6>{{ Auth::user()->name }}</h6>
                <?php use App\Models\Users as User;
                    $user = User::findOrFail(Auth::user()->id);
                ?>
                <p class="text-muted m-0">
                    @foreach(json_decode($user->roles->pluck('name')) as $d)
                        {{  $d }}
                    @endforeach
                </p>
            </div>
        </div>   

        <?php use App\Models\Users;
            $user = Users::where('id',Auth::user()->id)->first();
        ?>
        <!--sidebar nav start-->
        <ul class="side-navigation">
            <li>
                <h3 class="navigation-title">Navigation</h3>
            </li>

            <li class="{{ (Route::currentRouteName() == 'dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="mdi mdi-gauge"></i> <span>Dashboard</span></a>
            </li>

            @if($user->hasAnyRole('superadmin'))
            <li class="{{ (Route::currentRouteName() == 'users') ? 'active' : '' }}">
                <a href="{{ route('users') }}"><i class=" mdi mdi-account-multiple"></i> <span>Users</span></a>
            </li>
            @endif
            <!---
            @if($user->hasAnyRole('superadmin'))
            <li class="{{ (Route::currentRouteName() == 'gradasi') ? 'active' : '' }}">
                <a href="{{ route('gradasi') }}"><i class="mdi mdi-airballoon"></i> <span>Gradasi</span></a>
            </li>
            @endif

            @if($user->hasRole('superadmin'))
            <li class="{{ (Route::currentRouteName() == 'space-room') ? 'active' : '' }}">
                <a href="{{ route('space-room') }}"><i class="mdi mdi-scale-bathroom"></i> <span>Space Room</span></a>
            </li>
            @endif

            @if($user->hasRole('superadmin'))
            <li class="{{ (Route::currentRouteName() == 'space-room') ? 'active' : '' }}">
                <a href="{{ route('space-room') }}"><i class="mdi mdi-scale-bathroom"></i> <span>Riptek</span></a>
            </li>
            @endif
            -->
            
            <li>
                <h3 class="navigation-title">Web Content</h3>
            </li>
            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'structure') ? 'active' : '' }}">
                <a href="{{ route('structure') }}">
                    <i class="  mdi mdi-source-merge "></i> 
                    <span>Struktur <i class=" mdi mdi-bookmark-check"></i></span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'menu') ? 'active' : '' }}">
                <a href="{{ route('menu') }}">
                    <i class="mdi mdi-cards-playing-outline"></i> 
                    <span>Menu <i class=" mdi mdi-bookmark-check"></i></span>
                </a>
            </li>
            @endif
            
            @if($user->hasRole(['bidang']))
            <li class="{{ (Route::currentRouteName() == 'berita') ? 'active' : '' }}">
                <a href="{{ route('berita') }}">
                    <i class="mdi mdi-cards-playing-outline"></i> 
                    <span>Berita <i class=" mdi mdi-bookmark-check"></i></span>
                </a>
            </li>
            @endif
            
            @if($user->hasRole(['admin', 'superadmin']))
            <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Profil & Dokumen</span></a>
                <ul class="child-list">
                    <li class=""><a href="{{ route('dokumen.kategori.dokumen') }}"> Kategori</a></li>

                    <li><a href="{{ route('dokumen.upload.dokumen') }}"> Upload Dokumen</a></li>
                </ul>
            </li>
            @endif

            @if($user->hasRole(['admin', 'superadmin']))
            
            <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Data Website</span></a>
                <ul class="child-list">

                    <li class="{{ (Route::currentRouteName() == 'berita') ? 'active' : '' }}">
                        <a href="{{ route('berita') }}">
                            {{-- <i class=" mdi mdi-border-color"></i>  --}}
                            <span>Berita <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'run-text') ? 'active' : '' }}">
                        <a href="{{ route('run-text') }}">
                            {{-- <i class=" mdi mdi-border-color"></i>  --}}
                            <span>Running Text <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'banner') ? 'active' : '' }}">
                        <a href="{{ route('banner') }}">
                            {{-- <i class="mdi mdi-camera-iris"></i>  --}}
                            <span>Banner Aplikasi <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'slider') ? 'active' : '' }}">
                        <a href="{{ route('slider') }}">
                            {{-- <i class="mdi mdi-buffer"></i>  --}}
                            <span>Slider <i class=" mdi mdi-bookmark-check"></i> </span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'link') ? 'active' : '' }}">
                        <a href="{{ route('link') }}">
                            {{-- <i class=" mdi mdi-link-variant"></i>  --}}
                            <span>Tautan <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'applikasi') ? 'active' : '' }}">
                        <a href="{{ route('applikasi') }}">
                            {{-- <i class=" mdi mdi-apps"></i>  --}}
                            <span>Applikasi <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'announcement') ? 'active' : '' }}">
                        <a href="{{ route('announcement') }}">
                            {{-- <i class=" mdi mdi-volume-high"></i>  --}}
                            <span>Pengumuman <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif


            @if($user->hasRole(['admin', 'superadmin']))
            <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Gallery</span></a>
                <ul class="child-list">
                    <li class="{{ (Route::currentRouteName() == 'album') ? 'active' : '' }}">
                        <a href="{{ route('album') }}">
                            <i class=" mdi mdi-image-filter"></i> 
                            <span>Album<i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>

                    <li class="{{ (Route::currentRouteName() == 'picture') ? 'active' : '' }}">
                        <a href="{{ route('picture') }}">
                            <i class=" mdi mdi-image"></i> 
                            <span>Foto <i class=" mdi mdi-bookmark-check"></i></span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if($user->hasRole(['admin','superadmin']))
                    
            @endif

            @if($user->hasRole(['admin','superadmin']))
                    
            @endif

            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'settings') ? 'active' : '' }}">
                <a href="{{ route('settings') }}">
                    <i class=" mdi mdi-settings-box"></i> 
                    <span>Setting <i class=" mdi mdi-bookmark-check"></i></span>
                </a>
            </li>
            @endif


            <li>
                <h3 class="navigation-title">Medsos Management</h3>
            </li>
            
            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'instagram') ? 'active' : '' }}">
                <a href="{{ route('instagram') }}">
                    <i class=" mdi mdi-instagram"></i> 
                    <span>Instagram</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'youtube') ? 'active' : '' }}">
                <a href="{{ route('youtube') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Link Youtube <i class=" mdi mdi-bookmark-check"></i></span>
                </a>
            </li>
            @endif


            <li>
                <h3 class="navigation-title">Bidang Management</h3>
            </li>

            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'bidang-manage') ? 'active' : '' }}">
                <a href="{{ route('bidang-manage') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Bidang Manage</span>
                </a>
            </li>
            @endif
            
            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'kegiatan') ? 'active' : '' }}">
                <a href="{{ route('kegiatan') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Kegiatan</span>
                </a>
            </li>
            @endif
            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'absensi') ? 'active' : '' }}">
                <a href="{{ route('absensi') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Absensi</span>
                </a>
            </li>
            @endif
            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'suggestion') ? 'active' : '' }}">
                <a href="{{ route('suggestion') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Pesan & Saran</span>
                </a>
            </li>
            @endif

            {{-- @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'bpsb') ? 'active' : '' }}">
                <a href="{{ route('bpsb') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Sosial dan Budaya</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'ekonomi') ? 'active' : '' }}">
                <a href="{{ route('ekonomi') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Ekonomi</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'infrastruktur') ? 'active' : '' }}">
                <a href="{{ route('infrastruktur') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Infrastruktur</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'ppe') ? 'active' : '' }}">
                <a href="{{ route('ppe') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>PPE</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['bidang','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'litbang') ? 'active' : '' }}">
                <a href="{{ route('litbang') }}">
                    <i class="mdi mdi-youtube-play"></i> 
                    <span>Litbang</span>
                </a>
            </li>
            @endif --}}


            <li>
                <h3 class="navigation-title">Module</h3>
            </li>
            
            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'upload-material') ? 'active' : '' }}">
                <a href="{{ route('upload-material') }}">
                    <i class="  mdi mdi-cloud-upload"></i> 
                    <span>Upload Material</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'foreword') ? 'active' : '' }}">
                <a href="{{ route('foreword') }}">
                    <i class=" mdi mdi-file-word-box"></i> 
                    <span>Prakata</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'news') ? 'active' : '' }}">
                <a href="{{ route('news') }}">
                    <i class="mdi mdi-newspaper"></i> 
                    <span>Berita</span>
                </a>
            </li>
            @endif

            @if($user->hasRole(['admin','superadmin']))
            <li class="{{ (Route::currentRouteName() == 'guest-book') ? 'active' : '' }}">
                <a href="{{ route('guest-book') }}">
                    <i class=" mdi mdi-book-open-page-variant"></i> 
                    <span>Buku Tamu</span>
                </a>
            </li>
            @endif

        </ul>
        <!--sidebar nav end-->
    </div>
</div>