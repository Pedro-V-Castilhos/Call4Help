<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("home");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => "required|string|max:255",
            'content' => "required|string",
            'sector_id' => "required|exists:sectors,id",
            'priority_id' => "required|exists:priorities,id",
            'attachment' => "nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx",
        ], [
            "title.required" => "O campo título é obrigatório.",
            "title.string" => "O campo título deve ser textual.",
            "title.max" => "O campo título deve conter no máximo 255 caracteres.",
            "content.required" => "O campo descrição é obrigatório.",
            "content.string" => "O campo descrição deve ser textual.",
            "sector_id.required" => "O campo setor é obrigatório.",
            "sector_id.exists" => "O setor informado é inválido.",
            "priority_id.required" => "O campo prioridade é obrigatório.",
            "priority_id.exists" => "A prioridade informada é inválida.",
            "attachment.file" => "O anexo deve ser um arquivo válido.",
            "attachment.max" => "O anexo deve ter no máximo 10MB.",
            "attachment.mimes" => "O anexo deve ser um arquivo do tipo: jpg, jpeg, png, pdf, doc, docx, xls, xlsx.",
        ]);

        $path = null;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments');
        }

        Call::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'sector_id' => $validated['sector_id'],
            'priority_id' => $validated['priority_id'],
            'user_id' => auth()->user()->id,
            'status'=> 'open',
            'attachment_url' => $path,
        ]);

        return redirect()->route('home')->with('success', 'Chamado criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Call $call)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Call $call)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Call $call)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Call $call)
    {
        //
    }
}
