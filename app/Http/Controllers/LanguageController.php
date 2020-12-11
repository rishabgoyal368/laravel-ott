<?php

namespace App\Http\Controllers;

use App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function staticword($lang)
    {

        $findlang = Language::where('local', '=', $lang)->first();

        if (isset($findlang)) {

            if (file_exists('../resources/lang/' . $findlang->local . '/staticwords.php')) {
                $file = file_get_contents("../resources/lang/$findlang->local/staticwords.php");
                return view('admin.language.staticword', compact('findlang', 'file'));
            } else {

                if (is_dir('../resources/lang/' . $findlang->local)) {
                    copy("../resources/lang/en/staticwords.php", '../resources/lang/' . $findlang->local . '/staticwords.php');
                    $file = file_get_contents("../resources/lang/$findlang->local/staticwords.php");
                    return view('admin.language.staticword', compact('findlang', 'file'));
                } else {
                    mkdir('../resources/lang/' . $findlang->local);
                    copy("../resources/lang/en/staticwords.php", '../resources/lang/' . $findlang->local . '/staticwords.php');
                    $file = file_get_contents("../resources/lang/$findlang->local/staticwords.php");
                    return view('admin.language.staticword', compact('findlang', 'file'));
                }

            }

        } else {
            return back()
                ->with('warning', '404 Language Not found !');
        }
    }

    public function editStaticTrans($langCode)
    {
        $findlang = Language::where('local', '=', $langCode)->first();

        if (isset($findlang)) {

            if (file_exists('../resources/lang/' . $findlang->local . '/staticwords.php')) {
                $file = file_get_contents("../resources/lang/$findlang->lang_code/staticwords.php");
                return view('admin.language.staticword', compact('findlang', 'file'));
            } else {

                if (is_dir('../resources/lang/' . $findlang->local)) {
                    copy("../resources/lang/en/staticwords.php", '../resources/lang/' . $findlang->local . '/staticwords.php');
                    $file = file_get_contents("../resources/lang/$findlang->lang_code/staticwords.php");
                    return view('admin.language.staticword', compact('findlang', 'file'));
                } else {
                    mkdir('../resources/lang/' . $findlang->local);
                    copy("../resources/lang/en/staticwords.php", '../resources/lang/' . $findlang->local . '/staticwords.php');
                    $file = file_get_contents("../resources/lang/$findlang->lang_code/staticwords.php");
                    return view('admin.language.staticword', compact('findlang', 'file'));
                }

            }

        } else {
            return back()
                ->with('warning', '404 Language Not found !');
        }
    }

    public function updateStaticTrans(Request $request, $langCode)
    {
        $findlang = Language::where('local', '=', $langCode)->first();
        if (isset($findlang)) {

            $transfile = $request->transfile;
            file_put_contents('../resources/lang/' . $findlang->local . '/staticwords.php', $transfile . PHP_EOL);
            return back()->with('updated', 'Language Translations Updated !');

        } else {
            return back()
                ->with('warning', '404 Language not found !');
        }
    }

    public function index(Request $request)
    {
        $languages = \DB::table('languages')->select('id', 'local', 'def', 'created_at', 'name')->get();

        if ($request->ajax()) {
            return \Datatables::of($languages)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $row->id . '" id="checkbox' . $row->id . '">
                    <label for="checkbox' . $row->id . '" class="material-checkbox"></label>
                  </div>';

                    return $html;
                })

                ->addColumn('created_at', function ($row) {
                    return date('F d, Y',strtotime($row->created_at));

                })
                ->addColumn('def', function ($row) {
                    if ($row->def == 1) {
                        return '<i class="text-success fa fa-check"></i>';
                    } else {
                        return '<i class="text-danger fa fa-times"></i>';
                    }

                })

                ->addColumn('action', function ($row) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('languages.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    <a href="' . route('languages.staticword', $row->local) . '" data-toggle="tooltip" data-original-title="update static word translation" class="btn-success btn-floating"><i class="material-icons">settings</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $row->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $row->id . '" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">Are You Sure ?</h4>
                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="' . route("languages.destroy", $row->id) . '">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-danger">Yes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>';

                    return $btn;
                })
                ->rawColumns(['checkbox', 'created_at', 'action', 'def'])
                ->make(true);
        }

        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'local' => 'required|unique:languages,local',
            'name' => 'required|unique:languages,name',
        ]);

        $input = $request->all();

        $all_def = Language::where('def', '=', 1)->get();

        if (isset($request->def)) {

            foreach ($all_def as $value) {
                $remove_def = Language::where('id', '=', $value->id)->update(['def' => 0]);
            }

            $input['def'] = 1;

        } else {
            if ($all_def->count() < 1) {
                return back()->with('deleted', 'Atleast one language need to set default !');
            }

            $input['def'] = 0;
        }

        Language::create($input);
        return back()->with('added', 'Language has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $findlang = Language::find($id);
        $request->validate([
            'local' => 'required|unique:languages,local,' . $findlang->id,
            'name' => 'required|unique:languages,name,' . $findlang->id,
        ]);

        $input = $request->all();

        if (isset($findlang)) {

            if (isset($request->def)) {

                $deflang = Language::where('def', '=', 1)->where('id', '!=', $id)->first();

                if (isset($deflang)) {
                    $deflang->def = 0;
                    $deflang->save();
                }

                $input['def'] = 1;

                \Session::put('changed_language', $findlang->local);

            } else {

                if ($findlang->def == 1) {
                    $input['def'] = 1;
                } else {
                    $input['def'] = 0;
                }

            }

            $findlang->update($input);

            return back()->with("updated", "Language Details Updated !");
        } else {
            return back()->with("deleted", "404 Language Not found !");
        }
        return back()->with('updated', 'Language has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        if ($language->def == 1) {
            return back()->with('deleted', 'Default Language cannot be deleted');

        } else {

            $language->delete();
            return back()->with('deleted', 'Language has been deleted');
        }

    }

    public function bulk_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {
            $lang = Language::find($checked);
            if ($lang->def != 1) {
                $lang->delete();
                return back()->with('deleted', 'Languages have been deleted');
            } else {
                return back()->with('deleted', 'Default Language cannot be deleted');
            }
        }

    }
}
