<?php

namespace Selene\Modules\RevisionModule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Selene\Modules\RevisionModule\Models\Revision;

class RevisionController extends Controller {

    public function index(Request $request)
    {
        $revisions = Revision::query()->orderByDesc('_id');

        return view('RevisionModule::index', [
            'revisions' => $revisions->paginate(50, ['*'], 'page', $request->get('page') ?? 1)
        ]);
    }

    public function update(Revision $revision, Request $request): void
    {
        try {

            $content = \DB::connection('mongodb')->collection($revision->table)
                ->where('_id', '=', $revision->content_id);

            if ($content->first()) {
                $content->update(json_decode($revision->content, true));
            } else {
                $content->insert(json_decode($revision->content, true));
            }

            $request->session()->flash('alert-success', 'Wersja została usunęta');
        } catch (\Exception $e) {dd($e->getMessage());
            $request->session()->flash('alert-error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy(Revision $revision, Request $request): void
    {
        try {
            $revision->delete();
            $request->session()->flash('alert-success', 'Wersja została usunęta');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', 'Error: ' . $e->getMessage());
        }
    }

    public function get(Request $request) {

        return response()->json(Revision::getByContent(
            $request->get('table'),
            $request->get('contentId'),
            $request->get('limit', 10)
        ));
    }
}
