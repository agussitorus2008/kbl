<?php

namespace App\Http\Controllers\Backend;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $agents = Agent::all();

            return DataTables::of($agents)
                ->addColumn('action', function ($agent) {
                    $editRoute = route('backend.agent.edit', $agent->id);
                    $deleteRoute = route('backend.agent.destroy', $agent->id);

                    return '
                        <div class="btn-group">
                            <a href="javascript:;" onclick="load_input(\'' . $editRoute . '\');"
                                class="btn btn-sm btn-warning">
                                <i class="fas fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:;"
                                onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . $deleteRoute . '\');"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.backend.agent.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.backend.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $agent = Agent::create($request->all());

        if ($agent) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'redirect' => route('backend.agent.index')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        return view('pages.backend.agent.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $validators = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validators->errors()->first(),
            ]);
        }

        $agent->update($request->all());

        if ($agent) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'redirect' => route('backend.agent.index')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal disimpan',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
