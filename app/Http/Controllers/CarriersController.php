<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CarriersController extends Controller
{
    private $carrier;

    public function __construct(Carrier $carrier)
    {
        $this->carrier = $carrier;
    }

    public function index()
    {
        $collection = $this->carrier->orderBy('name','ASC')->paginate(10);
        return view ('logistics.carriers.index', compact('collection'));
    }

    public function create()
    {
      return view('logistics.carriers.create');
    }


    public function store(Request $request)
    {
      request()->validate([
        'name' => 'required',
      ]);

      $data = $request->all();
      $this->carrier::create($data);

      return redirect()->route('carriers.index')->with('success', 'Cadastro realizado com Sucesso!');
    }

}
