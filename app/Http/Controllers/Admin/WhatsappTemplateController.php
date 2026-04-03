<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;

class WhatsappTemplateController extends Controller
{
    public function index()
    {
        $templates = WhatsappTemplate::all();
        return view('admin.whatsapp.template.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.whatsapp.template.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|unique:whatsapp_templates,type',
            'message' => 'required|string',
            'is_active' => 'nullable|boolean'
        ]);

        WhatsappTemplate::create($request->all());
        return redirect()->route('admin.wa-template.index')->with("success", __("Template WA berhasil dibuat."));
    }

    public function edit($id)
    {
        $template = WhatsappTemplate::findOrFail($id);
        return view('admin.whatsapp.template.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = WhatsappTemplate::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string|unique:whatsapp_templates,type,' . $template->id,
            'message' => 'required|string',
            'is_active' => 'nullable|boolean'
        ]);

        $template->update($request->all());
        return redirect()->route('admin.wa-template.index')->with("success", __("Template WA berhasil diperbarui."));
    }

    public function destroy($id)
    {
        $template = WhatsappTemplate::findOrFail($id);
        $template->delete();
        return redirect()->route('admin.wa-template.index')->with("success", __("Template WA berhasil dihapus."));
    }
}
