<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Igfeed;
use App\Helpers\ApiData;
use Storage;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;


class Ig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ig:feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mendapatkan Data Dari Feed Di Instagram';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
        
        $response = ApiData::ig();

        // dd($response);
        if ($response->edges) {# code...
            foreach ($response->edges as $feeds) {
                foreach ($feeds as $feed) {
                    $dataIg = Igfeed::where('id_ig', $feed->id)->first();
                    if (empty($dataIg)) {
                        
                    

                        if ($feed->__typename == 'GraphSidecar') {
                            $type = 'sidecar';
                            $this->info('Saving Feed Sidecar On Progress');
                            foreach ($feed->edge_sidecar_to_children as $node) {
                                foreach ($node as $images) {
                                    foreach ($images as $image) {
                                        if ($image == 'GraphVideo') {
                                            $file_name = time().'-'.$feed->id.'.mp4';
                                            $path = 'frontend/images/instagram/';
                                            $url = $image->video_url;
                                            copy($url, public_path($path.$file_name));
                                        }else {
                                            $file_name = time().'-'.$feed->id.'.jpg';
                                            $path = 'frontend/images/instagram/';
                                            $image = Image::make($image->display_url);
                                            $image->save(public_path($path.$file_name)); 
                                        }
                                        $name[] = $path.$file_name;
                                    }
                                }
                            }
                        }elseif ($feed->__typename == 'GraphImage') {
                            $type = 'image';
                            $this->info('Saving Feed Image On Progress');
                            $file_name = time().'-'.$feed->id.'.jpg';
                            $path = 'frontend/images/instagram/'.$file_name;
                            $image = Image::make($feed->display_url);
                            $image->save(public_path($path));
                            $name[] = $path;
                        }elseif ($feed->__typename == 'GraphVideo') {
                            $type = 'video';
                            $this->info('Saving Feed Video On Progress');
                            $file_name = time().'-'.$feed->id.'.mp4';
                            $location = 'frontend/images/instagram/'.$file_name;
                            $url = $feed->video_url;
                            copy($url, public_path($location));
                            $name[] = $location;
                        }else {
                            $type = '404 Not Found';
                            $this->info('Saving Feed 404 Not Found');
                            $name[] = '';
                        }
                        

                        // $type = 'jancok';
                        // $name[] = 'as';

                        foreach ($feed->edge_media_to_caption as $node) {
                            foreach ($node as $captions) {
                                foreach ($captions as $caption) {
                                    // dd($caption->text);
                                    $captionText = $caption->text;

                                }
                            }
                        }
                        // dd($name);
                        $berita             = str_contains($captionText, '#berita');
                        $pengumuman         = str_contains($captionText, '#pengumuman');

                        $sosbud             = str_contains($captionText, '#sosbud');
                        $ekonomi            = str_contains($captionText, '#ekonomi');
                        $infrastruktur      = str_contains($captionText, '#infrastruktur');
                        $ppe                = str_contains($captionText, '#ppe');
                        $litbang            = str_contains($captionText, '#litbang');

                        // dd($sosbud);

                        if ($sosbud) {
                            $is_sosbud = '1';
                        }else {
                            $is_sosbud = '0';
                        }

                        if ($ekonomi) {
                            $is_ekonomi = '1';
                        }else {
                            $is_ekonomi = '0';
                        }

                        if ($infrastruktur) {
                            $is_infrastruktur = '1';
                        }else {
                            $is_infrastruktur = '0';
                        }

                        if ($ppe) {
                            $is_ppe = '1';
                        }else {
                            $is_ppe = '0';
                        }

                        if ($litbang) {
                            $is_litbang = '1';
                        }else {
                            $is_litbang = '0';
                        }

                        if ($pengumuman) {
                            $is_pengumuman = '1';
                        }else {
                            $is_pengumuman = '0';
                        }

                        if($berita) {
                            $source    = 'berita|instagram';
                        }elseif($pengumuman) {
                            $source    = 'pengumuman|instagram';
                        }else{
                            $source = 'instagram';
                        }

                        foreach ($feed->edge_media_preview_like as $like) {
                            // dd($like);
                            $likeCount = $like;
                        }



                        $add = new Igfeed;
                        //     'id_ig'             =>$feed->id,
                        //     'source'            =>$source,
                        //     'type'              =>$type,
                        //     'images'            =>json_encode("sadasd"),
                        //     'caption'           =>$captionText,
                        //     'likes'             =>$likeCount,
                        //     'is_sosbud'         =>$is_sosbud,
                        //     'is_ekonomi'        =>$is_ekonomi,
                        //     'is_infrastruktur'  =>$is_infrastruktur,
                        //     'is_ppe'            =>$is_ppe,
                        //     'is_litbang'        =>$is_litbang,
                        //     'is_pengumuman'     =>$is_pengumuman,
                            
                        // ]);
                        $add->id_ig = $feed->id;
                        $add->source = $source;
                        $add->type = $type;
                        $add->file = json_encode($name);
                        $add->caption = $captionText;
                        $add->likes = json_encode($likeCount);
                        $add->is_sosbud = $is_sosbud;
                        $add->is_ekonomi = $is_ekonomi;
                        $add->is_infrastruktur = $is_infrastruktur;
                        $add->is_ppe = $is_ppe;
                        $add->is_litbang = $is_litbang;
                        $add->is_pengumuman = $is_pengumuman;
                        $save = $add->save();
                        unset($name);
                        if ($save) {
                            $this->info('Saving Data Success');
                        }else {
                            $this->info('Saving Data Failed');
                        }
                    }
                }
            }
        }else{
            dd($response);
        }
        
        $this->info('Progress Selesai Berjalan...');
        $this->footer();
    }
    private function header(){
        $this->info('--------- :===: Development By Ditya :==: ---------------');
        $this->info('====================================================================');
        $this->info('--');
    }

    private function footer()
    {
        $this->info('--');
        $this->info('Website : https://DurungDadi.Jhoonn');
        $this->info('====================================================================');
        $this->info('------------------- :===: !! Completed !! :===: ------------------------');
        exit;
    }
}
