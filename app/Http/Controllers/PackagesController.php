<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageItem;
use App\Models\Carrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PackagesController extends Controller
{
    private $package;
    private $packageItem;
    private $carrier;

    public function __construct(package $package, PackageItem $packageItem, Carrier $carrier)
    {
        $this->package = $package;
        $this->packageItem = $packageItem;
        $this->carrier = $carrier;
    }

    public function index()
    {
        $collection = $this->package::with('carrier','user')->get();
        return view ('logistics.packages.index', compact('collection'));
    }

    public function create()
    {
      $data = $this->carrier::all(['id','name']);
      return view('logistics.packages.create',compact('data'));

    }

    public function open(Request $request)
    {
      $data = $request->all();
      $data['status'] = 'Documento';

      $this->package::create($data);

      return redirect()->route('packages.index');
    }

    public function show($id)
    {
        $data = $this->package::with('carrier','user')->find($id);
        return view ('logistics.packages.show', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->danfe;

        foreach($data as $item)
        {
            $params['chave_nfe'] = $item;
            $params['status'] = 'danfe';
            $params['packages_id'] = $request->packages;
            $params['user_id'] =  $request->user;

            if(strlen($params['chave_nfe']) === 11){
                $params['status'] = 'declaration';
            }

            PackageItem::create($params);
            Log::info('SQL:');
        }
        return response()->json([
            'message' => 'Romaneio Finalizado',
            'data' => $request->all()
        ],200);

    }

    public function readAccessKey(Request $request)
    {
        $result = $this->packageItem::with('user')->where('chave_nfe', '=',$request->access_key)->get();

        if($result->count()){
            return response()->json([
                'message' => 'A chave de acesso: '. $result['0']->chave_nfe . ' já está no romaneio:' . $result['0']->packages_id,
            ],200);
        }else{
            return response()->json([
                'success' => 'ok',
            ],200);

        }

    }



}
