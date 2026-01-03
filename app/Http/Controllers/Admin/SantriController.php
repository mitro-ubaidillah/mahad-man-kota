<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Kelas;
use App\Services\SantriImportService;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // admin middleware is applied in routes for admin area
    }

    public function index(Request $request)
    {
        $santris = Santri::with('kelas')->orderBy('name')->paginate(20);
        return view('santris.index', compact('santris'));
    }

    public function create()
    {
        $kelasList = Kelas::orderBy('name')->get();
        return view('santris.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => 'nullable|string|max:255|unique:santris,nis',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:santris,email',
            'phone' => 'nullable|string|max:50',
            'kelas_id' => 'nullable|exists:kelas,id',
            'kelas_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
        ]);

        // If kelas_name provided, create/find kelas
        if (empty($data['kelas_id']) && !empty($data['kelas_name'])) {
            $k = Kelas::firstOrCreate(['name' => $data['kelas_name']]);
            $data['kelas_id'] = $k->id;
        }

        // remove kelas_name before create
        unset($data['kelas_name']);

        Santri::create($data);

        session()->flash('success', __('Santri created successfully.'));
        return redirect()->route('santris.index');
    }

    public function edit(Santri $santri)
    {
        $kelasList = Kelas::orderBy('name')->get();
        return view('santris.edit', compact('santri', 'kelasList'));
    }

    public function update(Request $request, Santri $santri)
    {
        $data = $request->validate([
            'nis' => 'nullable|string|max:255|unique:santris,nis,' . $santri->id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:santris,email,' . $santri->id,
            'phone' => 'nullable|string|max:50',
            'kelas_id' => 'nullable|exists:kelas,id',
            'kelas_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
        ]);

        if (empty($data['kelas_id']) && !empty($data['kelas_name'])) {
            $k = Kelas::firstOrCreate(['name' => $data['kelas_name']]);
            $data['kelas_id'] = $k->id;
        }

        unset($data['kelas_name']);

        $santri->update($data);

        session()->flash('success', __('Santri updated successfully.'));
        return redirect()->route('santris.index');
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();
        session()->flash('success', __('Santri deleted.'));
        return redirect()->route('santris.index');
    }

    /**
     * Handle import file upload and delegate to SantriImportService
     */
    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file']);

        /** @var SantriImportService $service */
        $service = app(SantriImportService::class);
        $result = $service->importUploadedFile($request->file('file'));

        $success = $result['success'] ?? 0;
        $errors = $result['errors'] ?? [];

        $message = __('Imported :count rows', ['count' => $success]);
        if (count($errors)) {
            $message .= ' ' . __('with :count errors', ['count' => count($errors)]);
            session()->flash('error', implode(' | ', array_slice($errors, 0, 10)));
        }
        session()->flash('success', $message);

        return redirect()->route('santris.index');
    }
}
