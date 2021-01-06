<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\Galeri;
use App\Models\Igfeed;
use App\Models\Comment;
use App\Models\BukuTamu;
use Ixudra\Curl\Facades\Curl;
use App\Models\Berita as BeritaModels;
use App\Models\Links as LinksModels;
use App\Models\Announcement as Announcements;
use App\Models\Album as AlbumModel;
use App\Models\Structure as StructureModel;
use DB;
use App\Models\Kegiatan_bidang;
use App\Models\Absensi;
use App\Models\Bidang;
use App\Models\Absensi_list;
use App\Models\Suggestion_list;
use App\Models\Suggestion;

class FrontEndController extends Controller
{
    protected $galeri;

    public function __construct(AlbumModel $galeri){
        $this->galeri = $galeri;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // $data['menu'] = Menu::where('parent_id', '0')->get();
        $data['slider'] = Slider::where('flag', '1')->get();
        $data['apps'] = LinksModels::where('type', 'applikasi')->get();
        $data['beritas'] = BeritaModels::where('is_active', '1')->get();
        $data['galeri'] = Galeri::limit(8)->orderBy('id', 'desc')->get();

        $data['igs'] = Igfeed::where('source', 'instagram')->orderBy('id_ig', 'desc')->where('type', 'image')->limit(4)->get();

        return view('index', $data);
    }

    /**
     * Berita Ambil Dari Instagram Dan Input Manual
     */
    public function getBlogs()
    {
        $data['igs'] = Igfeed::orderBy('id_ig', 'desc')->paginate(6);
        $data['recent'] = Igfeed::orderBy('id_ig', 'desc')->paginate(5);
        $data['menu'] = Menu::where('parent_id', '=', '0')->get();
        return view('user.blogs.index', $data);
    }

    public function getBlog($id)
    {
        $data['ig'] = Igfeed::orderBy('id', 'desc')->where('id', $id)->first();
        $data['recents'] = Igfeed::orderBy('id_ig', 'desc')->paginate(3);
        $data['comment'] = Comment::where('igfeed_id', $id)->get();
        $data['menu'] = Menu::where('parent_id', '=', '0')->get();
        // dd($data['comment']);
        return view('user.blogs.single', $data);
    }

    public function postCommentas(Request $request, $id)
    {
        $d = Comment::findOrFail($id);
        $d->igfeed_id = $id;
        $d->name = $request->name;
        $d->comment = $request->comment;
        $d->email = $request->email;
        $d->avatar = 'aa';
        $d->save();

        return redirect('blog/'.$id);
    }

    public function getPengumumans()
    {
        $data['igs'] = Igfeed::where('is_pengumuman', 1)->orderBy('id_ig', 'desc')->paginate(6);
        $data['recent'] = Igfeed::where('is_pengumuman', 1)->orderBy('id_ig', 'desc')->paginate(5);
        $data['menu'] = Menu::where('parent_id', '=', '0')->get();
        return view('user.pengumuman.index', $data);
    }

    public function getPengumuman($id)
    {
        $data['ig'] = Igfeed::orderBy('id', 'desc')->where('id', $id)->first();
        $data['recents'] = Igfeed::orderBy('id_ig', 'desc')->paginate(3);
        $data['comment'] = Comment::where('igfeed_id', $id)->get();
        $data['menu'] = Menu::where('parent_id', '=', '0')->get();
        // dd($data['announcement']);
        return view('user.pengumuman.single', $data);
    }
    
    public function getAlbum() {
        // $data['menu'] = Menu::where('parent_id', '0')->get();
        $data['data'] = $this->galeri
            ->select('album.id','album.album','album.lokasi','album.created_at','album.user_id','users.name',\DB::raw('COUNT(galeri.urlpict) as jmlfoto'))
            ->join('users','users.id','=','album.user_id')
            ->join('galeri','galeri.idalbum','=','album.id')
            ->groupby('album.id')
            ->orderby('album.created_at','desc')->get();

        return view('user.albums.main', $data);
    }

    public function getStructure() {
        $data['menu'] = DB::table('structures')->where('parent_id', '0')->get();
        return view('user.structure.main', $data);
    }

    public function getProfile() {
        // $data['menu'] = Menu::where('parent_id', '0')->get();
		$data['kategori_dokumens'] = DB::table('kategori_dokumens')
			->where('is_text','1')
			->get();
        return view('user.profile.main', $data);
    }

    public function getDokumenBappeda() {
        // $data['menu'] = Menu::where('parent_id', '0')->get();
        $data['kategori_dokumens'] = DB::table('kategori_dokumens')
			->where('is_text','0')
            ->get();
        return view('user.dokumen.bappeda', $data);
    }

    public function getDokumenKota() {
        // $data['menu'] = Menu::where('parent_id', '0')->get();
        $data['kategori_dokumens'] = DB::table('kategori_dokumens')
            ->where('is_text','0')
            ->get();
        return view('user.dokumen.kota', $data);
    }

    public function getPpid() {
        // $data['menu'] = Menu::where('parent_id', '0')->get();
        $data['kategori_dokumens'] = DB::table('kategori_dokumens')
            ->where('is_text','0')
            ->get();
        return view('user.dokumen.ppid', $data);
    }
    
    public function postDownload($id) {
        // Return Download File
        $data = DB::table('dokumen_bappedas')
            ->where('id', $id)
            ->first();
        return response()->download(public_path($data->file));
    }

    public function getBidang($id) {
        $data['bidang'] = $id;
		//$data['bid'] = Menu::where('parent_id', '0')->get();
        // dd($data['igs']);
        return view('user.bidang.index', $data);
    }
    
    public function getAgenda() {
        return view('user.agenda.index');
    }
    
    public function postAjaxAgenda(Request $request) {
        $data['tanggal'] = $request->tanggal;
        $data['judul'] = $request->judul;
      
        return view('user.agenda.agenda', $data);
    }
    
    public function getAbsensi($link=0) {
        if(empty($link)){
            return redirect('/');
        }
        
        $data['absensi'] = Absensi::where('link', $link)->first();
        if(empty($data['absensi'])){
            return redirect('/');
        }
        
        $data['kegiatan_bidang'] = kegiatan_bidang::findOrFail($data['absensi']->kegiatan_bidang_id);
        $data['bidang'] = Bidang::findOrFail($data['kegiatan_bidang']->bidang_id);
        
        return view('user.absensi.form', $data);
    }
    public function postAddAbsensi($id, Request $request) {
        $add = new Absensi_list;
        $add->absensi_id = $id;
        $add->email = $request->email;
        $add->name = $request->name;
            if($request->gender == 'laki'){
                $gender = 'laki-laki';
                $add->gender = $gender;
            }else{
                $add->gender = $request->gender;
            }
        $add->instansi = $request->instansi;
        $add->no_telf = $request->no_telf;
        $add->save();
        
        $absen = Absensi::findOrFail($id);
        return redirect()->route('..absensi',$absensi->link);
    } 
    
    public function postAjaxRktOpd(Request $request) {
        $data['tentang1'] = \DB::connection('sakipsmg')->table('dok_rkt')
				->leftjoin('dok_skpd','dok_rkt.id_opd','=','dok_skpd.id')
				->orderBy('dok_rkt.periode', 'desc')
				->orderBy('dok_skpd.kode_skpdbr', 'asc')
				->where('dok_rkt.periode',$request->tanggal)
				->get();
        return view('user.dokumen.partial.rktopd', $data);
    }
    
    public function postAjaxRenjaOpd(Request $request) {
        $data['tentang1'] = \DB::connection('sakipsmg')->table('dok_renja')
						->leftjoin('dok_skpd','dok_renja.id_opd','=','dok_skpd.id')
						->orderBy('dok_renja.periode', 'desc')
						->orderBy('dok_skpd.kode_skpdbr', 'asc')
						->where('dok_renja.periode',$request->tanggal)
						->where('dok_renja.perubahan',$request->status)
						->get();
        return view('user.dokumen.partial.renjaopd', $data);
    }
    
    public function postAjaxPerkirOpd(Request $request) {
        $data['tentang1'] = \DB::connection('sakipsmg')->table('dok_perjanjiankinerja_opd')
						->leftjoin('dok_skpd','dok_perjanjiankinerja_opd.id_opd','=','dok_skpd.id')
						->where('dok_perjanjiankinerja_opd.periode',$request->tanggal)
						->where('dok_perjanjiankinerja_opd.perubahan', $request->status)
						->orderBy('dok_perjanjiankinerja_opd.periode', 'desc')
						->orderBy('dok_skpd.id', 'asc')
						->get();
        return view('user.dokumen.partial.perkiropd', $data);
    }
    
    public function getPesanSaran($link=0) {
        if(empty($link)){
            return redirect('/');
        }
        
        $data['suggestion'] = Suggestion::where('link', $link)->first();
        if(empty($data['suggestion'])){
            return redirect('/');
        }
        
        $data['kegiatan_bidang'] = kegiatan_bidang::findOrFail($data['suggestion']->kegiatan_bidang_id);
        $data['bidang'] = Bidang::findOrFail($data['kegiatan_bidang']->bidang_id);
        
        return view('user.suggestion.form', $data);
    }
    
    public function postAddSuggestion($id, Request $request) {
        $add = new Suggestion_list;
        $add->suggestion_id = $id;
        $add->name = $request->name;
        $add->instansi = $request->instansi;
        $add->suggestion = $request->suggestion;
        $add->save();
        
        $suggestion = Suggestion::findOrFail($id);
        return redirect()->route('..pesan.saran',$suggestion->link);
    } 
    public function postBukuTamu(Request $request) {
        $add = new BukuTamu;
        $add->nama = $request->name;
        $add->email = $request->email;
        $add->pesan = $request->message;
        $add->save();
        return 'success';
    } 
}
