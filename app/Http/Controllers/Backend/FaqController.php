<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $items = Faq::sorted()->paginate(20);
        $module_name = 'faq';
        $module_title = 'FAQ';
        $module_icon = 'fa-regular fa-circle-question';
        $module_action = 'List';

        return view('backend.faq.index', compact('items', 'module_name', 'module_title', 'module_icon', 'module_action'));
    }

    public function create()
    {
        $faq = new Faq();
        $module_name = 'faq';
        $module_path = 'backend';
        $module_title = 'FAQ';
        $module_icon = 'fa-regular fa-circle-question';
        $module_action = 'Create';

        return view('backend.faq.create', compact('faq', 'module_name', 'module_path', 'module_title', 'module_icon', 'module_action'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        Faq::create($data);

        return redirect()->route('backend.faq.index')->with('status', 'FAQ created');
    }

    public function show(Faq $faq)
    {
        return redirect()->route('backend.faq.edit', $faq);
    }

    public function edit(Faq $faq)
    {
        $module_name = 'faq';
        $module_path = 'backend';
        $module_title = 'FAQ';
        $module_icon = 'fa-regular fa-circle-question';
        $module_action = 'Edit';

        return view('backend.faq.edit', compact('faq', 'module_name', 'module_path', 'module_title', 'module_icon', 'module_action'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $this->validatedData($request);
        $faq->update($data);

        return redirect()->route('backend.faq.index')->with('status', 'FAQ updated');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('backend.faq.index')->with('status', 'FAQ deleted');
    }

    protected function validatedData(Request $request): array
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'question_en' => 'nullable|string|max:255',
            'answer' => 'nullable|string',
            'answer_en' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
