<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function show($id)
    {
        $call = Call::with(['sector', 'priority', 'user', 'worker.user'])->findOrFail($id);
        return view('call-details', compact('call'));
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
    public function destroy($id)
    {
        $call = Call::findOrFail($id);

        if (auth()->id() == $call->user_id && $call->status !== 'closed') {

            if ($call->attachment_url) {
                Storage::delete($call->attachment_url);
            }

            $call->delete();

            return redirect()->route('home')->with('success', 'Chamado cancelado com sucesso.');
        }

        return redirect()->route('home')->with('error', 'Ação não permitida.');
    }

    public function download(Call $call)
    {
        if (!$call->attachment_url) {
            abort(404);
        }

        if ($call->user_id !== auth()->id()) {
            abort(403);
        }

        if (!Storage::exists($call->attachment_url)) {
            abort(404);
        }

        return Storage::download($call->attachment_url);
    }

    public function open($id)
    {
        $call = Call::findOrFail($id);

        if (auth()->user()->worker && auth()->user()->worker->sector_id == $call->sector_id && $call->status == 'open') {
            $call->status = 'pending';
            $call->worker_id = auth()->user()->worker->id;
            $call->opened_at = now();
            $call->save();
        }

        return redirect()->route('callDetails', $call->id)->with('success', 'Chamado aberto com sucesso.');
    }

    public function close(Request $request, $id)
    {
        $validated = $request->validate([
            'solution_message' => 'required|string',
        ], [
            'solution_message.required' => 'O campo mensagem de solução é obrigatório.',
            'solution_message.string' => 'O campo mensagem de solução deve ser textual.',
        ]);

        $call = Call::findOrFail($id);

        if (auth()->user()->worker && auth()->user()->worker->sector_id == $call->sector_id && $call->status == 'pending') {
            $call->status = 'closed';
            $call->worker_id = auth()->user()->worker->id;
            $call->closed_at = now();
            $call->solution_message = $validated['solution_message'];
            $call->save();
        }

        return redirect()->route('callDetails', $call->id)->with('success', 'Chamado fechado com sucesso.');
    }
}
