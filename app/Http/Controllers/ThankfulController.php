<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Spotify;
use App\Models\Faculty;
use App\Models\Thankful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use SpotifySeed;

class ThankfulController extends Controller
{
    public function index(){
        return Inertia::render('arsanandha/invitation/ThanksCard',[
            'options'=>$this->getFaculty()
        ]);
    }

    public function getFaculty(){
        $faculty = Faculty::all();
        $choice = [];
        foreach($faculty as $fc){
            array_push($choice,array("value"=>$fc->faculty_id,"text"=>$fc->faculty_name." - ".$fc->department_name));
        }
        return $choice;
    }

    public function person(Request $request){
        if($request->card_id){
            Thankful::where('url_id',$request->card_id)
                ->update(['received'=>'y']);
            return Inertia::render('arsanandha/invitation/card_view/ThanksCard',[
                'message'=>Thankful::with('haveFaculty')->where('url_id',$request->card_id)->get()
            ]);
        }else{
            $thankful = array("message"=>"No CARD");
            return response()->json($thankful);
        }
    }

    public function thankful(Request $request){
        if(Thankful::create($request->all())){
            return Inertia::render('arsanandha/invitation/ThanksEnd',[
                'last_number'=>Thankful::all()->count()
            ]);
        }
    }

    public function search(Request $request){
        if(Auth::check()){
            return Inertia::render('arsanandha/invitation/view/ThanksCardTable');
        }else{
            return Inertia::render('arsanandha/invitation/ThanksEnd');
        }
    }

    public function viewByURLID(Request $request){
        if($request->card_id){
            return response()->json(Thankful::with('haveFaculty')->where("url_id",$request->card_id)->get());
        }
    }

    public function ajaxView(Request $request){
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');

        $query = Thankful::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function ajaxInsert(Request $request){
        if($request->ajax()){
            if(Auth::check()){
                if($request->id && $request->in_mind && $request->received){
                    $thankful = Thankful::find($request->id);
                    $thankful->in_mind = $request->in_mind;
                    $thankful->received = $request->received;
                    $thankful->save();

                    if($thankful){
                        return response()->json(
                            array(
                                "status"=>"OK",
                                "url_id"=>$thankful->url_id
                            )
                        );
                    }else{
                        return response()->json(
                            array(
                                "status"=>"NO"
                            )
                        );
                    }
                }
            }
        }
    }

    public function personalization($person_file){
        $valueMatrix = array(
            "artists_id"=>array(),
            "genre"=>array(),
            "valence"=>array(0.00,1.00),
            "tempo"=>array(0,200),
            "popularity"=>array(0,100),
            "key"=>array(0,10)
        );
        $personal = json_decode($person_file);
        if($personal->emotion && $personal->temperatureOfHeartWarming){
            $allOfRange = (100 - (($personal->temperatureOfHeartWarming) * (25) / (100)) / (32.5) * ($personal->sentimentality * 1.75));
            $danceability_start = ($personal->temperatureOfHeartWarming) * (50) / (100) / (4096);
            $danceability_end = ($personal->temperatureOfHeartWarming) * (75) / (100) / (9120);
            if($personal->emotion == "positively"){
                /** Wider Range */
                $normal_step = 10.5;
                $valenceRange = range(0, $allOfRange, $normal_step);
                $start_range = random_int(2,3);
                $end_range = random_int(4,10);
            }else if($personal->emotion == "positive"){
                /** Semi-Wide Range Range */
                $normal_step = 7.45;
                $valenceRange = range(0, $allOfRange,$normal_step);
                $start_range = random_int(2,4);
                $end_range = random_int(5,10);
            }else if($personal->emotion == "neutral"){
                /** Normal Range */
                $normal_step = 5.35;
                $valenceRange = range(0, $allOfRange,$normal_step);
                $start_range = random_int(2,6);
                $end_range = random_int(7,10);
            }
            $valueMatrix['valence'][0] = (function() use (&$valenceRange,&$start_range,&$valueMatrix,&$personal){

                $slicer = array_slice($valenceRange,0,$start_range);
                $value = [];
                foreach($slicer as $avger){
                    $value = ($avger) / ($start_range*10);
                }
                $valueMatrix['tempo'][0] = intval(ceil($value * 100 * ($personal->drunkPerson == true ? 1.75 : 1.25)));
                return round($value,1);
            })();
            $valueMatrix['valence'][1] = (function() use (&$valenceRange,&$end_range,&$valueMatrix,&$personal){
                $slicer = array_slice($valenceRange,0,$end_range);
                $value = [];
                foreach($slicer as $avger){
                    $value = ($avger) / ($end_range*10);
                }
                $valueMatrix['tempo'][1] = intval(ceil($value * 100 * ($personal->drunkPerson == true ? 2 : 1.50)));
                return round($value,1);
            })();
            $valueMatrix['popularity'][0] = intval(round ($personal->indyScore <= 50 ? ($valueMatrix['valence'][0]) + ($personal->indyScore + (33.5)) : ($valueMatrix['valence'][0]) + ($personal->indyScore / (0.6) % 10 * 10),1));
            $valueMatrix['popularity'][1] = intval(round ($personal->indyScore <= 50 ? ($valueMatrix['valence'][1]) + ($personal->indyScore + (55.5)) : ($valueMatrix['valence'][1]) + ($personal->indyScore / (0.7) % 10 * 10),1));
            $valueMatrix['key'][0] = round(($valueMatrix['valence'][0]) * (10 - 3),1);
            $valueMatrix['key'][1] = round(($valueMatrix['valence'][1]) * (10 - 7),1);
        }
        $valueMatrix['artists_id'] = $this->getSpotifyArtistsID($personal->favArtistName);
        $valueMatrix['genre'] = $personal->personalizationGenre;
        sort($valueMatrix['valence']);
        sort($valueMatrix['popularity']);
        sort($valueMatrix['key']);
        return $this->spotifyRecommend($valueMatrix);
    }

    public function test_personalization(Request $request){
        try{
            $req = $request->json()->all();
            $json_q = array(
                "favArtistName"=>$req['favArtistName'],
                "emotion"=>$req['emotion'],
                "personalizationGenre"=>$req['personalizationGenre'],
                "temperatureOfHeartWarming"=>intval($req['temperatureOfHeartWarming']),
                "drunkPerson"=>$req['drunkPerson'],
                "sentimentality"=>doubleval($req['sentimentality']),
                "relationshipScore"=>intval($req['relationshipScore']),
                "indyScore"=>intval($req['indyScore'])
            );
            Log::debug(print_r($req,true));
            return $this->personalization(json_encode($json_q));
        }catch(Exception $e){
            return response()->json(array("status"=>"error"));
        }
    }

    public function getSpotifyArtistsID(Array $artists_name){
        $artists_array = [];
        foreach($artists_name as $search_artist){
            array_push($artists_array,Spotify::searchItems($search_artist, 'artist')->get()['artists']['items'][0]['id']);
        }
        return $artists_array;
    }

    public function spotifyRecommend(Array $data){
        $musicArray = array();
        $artists = $data['artists_id'];
        $genres = $data['genre'];
//        $genres = ["acoustic","afrobeat",
//            "alt-rock","alternative",
//            "ambient","anime",
//            "black-metal","bluegrass",
//            "blues","bossanova",
//            "brazil","breakbeat",
//            "british","cantopop",
//            "chicago-house","children",
//            "chill","classical",
//            "club","comedy",
//            "country","dance",
//            "dancehall","death-metal",
//            "deep-house","detroit-techno",
//            "disco","disney",
//            "drum-and-bass","dub",
//            "dubstep","edm",
//            "electro","electronic",
//            "emo","folk",
//            "forro","french",
//            "funk","garage",
//            "german","gospel",
//            "goth","grindcore",
//            "groove","grunge",
//            "guitar","happy",
//            "hard-rock","hardcore",
//            "hardstyle","heavy-metal",
//            "hip-hop","holidays",
//            "honky-tonk","house",
//            "idm","indian",
//            "indie","indie-pop",
//            "industrial","iranian",
//            "j-dance","j-idol",
//            "j-pop","j-rock",
//            "jazz","k-pop",
//            "kids","latin",
//            "latino","malay",
//            "mandopop","metal",
//            "metal-misc","metalcore",
//            "minimal-techno","movies",
//            "mpb","new-age",
//            "new-release","opera",
//            "pagode","party",
//            "philippines-opm","piano",
//            "pop","pop-film",
//            "post-dubstep","power-pop",
//            "progressive-house","psych-rock",
//            "punk","punk-rock",
//            "r-n-b","rainy-day",
//            "reggae","reggaeton",
//            "road-trip","rock",
//            "rock-n-roll","rockabilly",
//            "romance","sad",
//            "salsa","samba",
//            "sertanejo","show-tunes",
//            "singer-songwriter","ska",
//            "sleep","songwriter",
//            "soul","soundtracks",
//            "spanish","study",
//            "summer","swedish",
//            "synth-pop","tango",
//            "techno","trance",
//            "trip-hop","turkish",
//            "work-out","world-music"];
        $seed = SpotifySeed::setGenres($genres)
            ->setArtists($artists)
            ->setValence($data['valence'][0],$data['valence'][1])
            ->setTempo($data['tempo'][0],$data['tempo'][1])
            ->setTargetKey($data['key'][0],$data['key'][1])
            ->setPopularity($data['popularity'][0],$data['popularity'][1]);
        $music_api_get = Spotify::recommendations($seed)->market('TH')->get();
        $explicit = false;
        foreach($music_api_get['tracks'] as $tracks_body => $key){
//            if($music_api_get['tracks'][$tracks_body]['explicit'] === $explicit){
                $musicArray[$music_api_get['tracks'][$tracks_body]['uri']]['music']['artists'] = $music_api_get['tracks'][$tracks_body]['artists'][0]['name'];
                $musicArray[$music_api_get['tracks'][$tracks_body]['uri']]['music']['name'] = $music_api_get['tracks'][$tracks_body]['name'];
                $musicArray[$music_api_get['tracks'][$tracks_body]['uri']]['music']['urls'] = $music_api_get['tracks'][$tracks_body]['external_urls']['spotify'];
                $musicArray[$music_api_get['tracks'][$tracks_body]['uri']]['music']['pictures'] = $music_api_get['tracks'][$tracks_body]['album']['images'];
                $musicArray[$music_api_get['tracks'][$tracks_body]['uri']]['music']['popularity'] = $music_api_get['tracks'][$tracks_body]['popularity'];
                $musicArray[$music_api_get['tracks'][$tracks_body]['uri']]['music']['analytics'] = Spotify::audioFeaturesForTrack($music_api_get['tracks'][$tracks_body]['id'])->get();
//            }
        }
        return $musicArray;
    }
}
