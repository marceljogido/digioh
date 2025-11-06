<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    protected string $module_name = 'faq';
    protected string $module_title = 'FAQ';
    protected string $module_icon = 'fa-regular fa-circle-question';

    public function index()
    {
        $module_name = $this->module_name;
        $module_title = $this->module_title;
        $module_icon = $this->module_icon;
        $module_action = 'List';

        return view('backend.faq.index', compact(
            'module_name',
            'module_title',
            'module_icon',
            'module_action'
        ));
    }

    public function create()
    {
        $faq = new Faq();
        $module_name = $this->module_name;
        $module_path = 'backend';
        $module_title = $this->module_title;
        $module_icon = $this->module_icon;
        $module_action = 'Create';

        return view('backend.faq.create', compact(
            'faq',
            'module_name',
            'module_path',
            'module_title',
            'module_icon',
            'module_action'
        ));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        Faq::create($data);

        return redirect()->route('backend.faq.index')->with('status', 'FAQ created');
    }

    public function show(Faq $faq)
    {
        $module_name = $this->module_name;
        $module_title = $this->module_title;
        $module_icon = $this->module_icon;
        $module_action = 'Show';

        return view('backend.faq.show', compact(
            'faq',
            'module_name',
            'module_title',
            'module_icon',
            'module_action'
        ));
    }

    public function edit(Faq $faq)
    {
        $module_name = $this->module_name;
        $module_path = 'backend';
        $module_title = $this->module_title;
        $module_icon = $this->module_icon;
        $module_action = 'Edit';

        return view('backend.faq.edit', compact(
            'faq',
            'module_name',
            'module_path',
            'module_title',
            'module_icon',
            'module_action'
        ));
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

    public function index_data()
    {
        $faqs = Faq::select('id', 'question', 'question_en', 'is_active', 'sort_order', 'updated_at')
            ->orderBy('sort_order')
            ->orderBy('id');

        return DataTables::of($faqs)
            ->addIndexColumn()
            ->editColumn('question', function (Faq $faq) {
                $html = '<strong>'.e($faq->question).'</strong>';

                if ($faq->question_en) {
                    $html .= '<div class="text-muted small">'.e($faq->question_en).'</div>';
                }

                return $html;
            })
            ->addColumn('status', function (Faq $faq) {
                return $faq->is_active
                    ? '<span class="badge bg-success">'.__('Active').'</span>'
                    : '<span class="badge bg-secondary">'.__('Inactive').'</span>';
            })
            ->editColumn('updated_at', function (Faq $faq) {
                if (! $faq->updated_at) {
                    return 'N/A';
                }

                $diff = Carbon::now()->diffInHours($faq->updated_at);

                return $diff < 25
                    ? $faq->updated_at->diffForHumans()
                    : $faq->updated_at->isoFormat('llll');
            })
            ->addColumn('action', function (Faq $faq) {
                return view('backend.faq.partials.actions', compact('faq'))->render();
            })
            ->rawColumns(['question', 'status', 'action'])
            ->make(true);
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
