<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentResource;
use App\Http\Resources\AgentCollection;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    private $messages;
    public function __construct()
    {
        $this->middleware('role:admin')->except('index', 'show');

        $this->messages = [
            'name.required' => 'Nama harus diisi',
            'phone.required' => 'Nomor telepon harus diisi',
            'city.required' => 'Kota harus diisi',
            'address.required' => 'Alamat harus diisi',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::all();

        return ResponseFormatter::success(
            new AgentCollection($agents),
            'Data list agen berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ], $this->messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Data gagal ditambahkan', 422);
        }

        $agent = Agent::create($request->validated());

        return ResponseFormatter::success(
            new AgentResource($agent),
            'Data agen berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        if (!$agent) {
            return ResponseFormatter::error(
                null,
                'Data agen tidak ditemukan',
                404
            );
        }

        return ResponseFormatter::success(
            new AgentResource($agent),
            'Data agen berhasil diambil'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ], $this->messages);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'error' => $validator->errors(),
            ], 'Data gagal diubah', 422);
        }

        $agent->update($request->validated());

        return ResponseFormatter::success(
            new AgentResource($agent),
            'Data agen berhasil diubah'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();

        return ResponseFormatter::success(
            null,
            'Data agen berhasil dihapus'
        );
    }
}
