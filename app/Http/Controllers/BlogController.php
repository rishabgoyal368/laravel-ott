<?php

namespace App\Http\Controllers;

//use App\Movie;
use App\Blog;
use App\BlogMenu;
use App\Menu;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = \DB::table('blogs')->select('id', 'title', 'image', 'is_active', 'detail', 'created_at', 'updated_at')->get();

        if ($request->ajax()) {
            return \Datatables::of($blogs)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($blog) {
                    $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $blog->id . '" id="checkbox' . $blog->id . '">
                    <label for="checkbox' . $blog->id . '" class="material-checkbox"></label>
                  </div>';

                    return $html;
                })
                ->addColumn('image', function ($blog) {
                    if ($blog->image) {
                        $image = '<img src="' . asset('/images/blog/' . $blog->image) . '" alt="Pic" width="70px" class="img-responsive">';
                    } else {
                        $image = '<img  src="http://via.placeholder.com/70x70" alt="Pic" width="70px" class="img-responsive">';
                    }

                    return $image;

                })
                ->addColumn('created_at', function ($blog) {
                    return date('F d, Y',strtotime($blog->created_at));

                })

                ->addColumn('status', function ($blog) {

                    if ($blog->is_active == 1) {
                        return 'Active';
                    } else {
                        return 'Deactive';
                    }
                })
                ->addColumn('detail', function ($blog) {
                    $detail = str_replace("<p>", " ", $blog->detail);;
                    $detail = str_replace("</p>", " ", $detail);
                    $detail = strip_tags(html_entity_decode(str_limit($detail, 50)));
                    return $detail;
                })
                ->addColumn('action', function ($blog) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('blog.edit', $blog->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $blog->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $blog->id . '" class="delete-modal modal fade" role="dialog">
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
                      <form method="POST" action="' . route("blog.destroy", $blog->id) . '">
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
                ->rawColumns(['checkbox', 'status', 'created_at', 'action', 'image'])
                ->make(true);
        }

        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.blog.create', compact('menus'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'menu' => 'required',
        ], [
            'menu.required' => 'Please select atleast one menu',
        ]);

        $input = $request->all();

        if ($file = $request->file('image')) {

            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/blog/';
            $name = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $name, 72);
            $input['image'] = $name;

        }

        if (isset($input['is_active']) && $input['is_active'] == '1') {
            $input['is_active'] = 1;
        } else {
            $input['is_active'] = 0;
        }

        $slug = str_slug($input['title'], '-');
        $input['slug'] = $slug;
        $auth = Auth::user()->id;
        $input['user_id'] = $auth;

        $menus = null;

        $blog = Blog::create($input);

        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
            for ($i = 0; $i < sizeof($menus); $i++) {
                if ($menus[$i] == 100) {
                    unset($menus);
                    $men = Menu::all();
                    foreach ($men as $key => $value) {
                        # code...
                        $menus[] = $value->id;
                    }
                    DB::table('blog_menu')->insert(
                        array(
                            'menu_id' => $menus[$i],
                            'blog_id' => $blog->id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        )
                    );

                } else {

                    DB::table('blog_menu')->insert(
                        array(
                            'menu_id' => $menus[$i],
                            'blog_id' => $blog->id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        )
                    );
                }

            }

        }

        return back()->with('added', 'Post has been added');

    }

    public function showBlogList()
    {
        $auth = Auth::user();
        $blogs = Blog::orderBy('created_at', 'desc')->where('is_active', '1')->get();
        //$blogs = Blog::orderBy('id', 'DESC')->paginate(10);
        return view('blog', compact('blogs', 'auth'));

    }

    public function showBlog($slug)
    {
        
        $blogdetail = Blog::where('slug', $slug)->first();
        $exceptblog = Blog::where('slug','!=',$slug)->get();

        return view('blogdetail', compact('blogdetail','exceptblog'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $menus = Menu::all();
        return view('admin.blog.edit', compact('blog', 'menus'));

    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Product  $id
 * @return \Illuminate\Http\Response
 */

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|min:3|unique:blogs,title,' . $id,
            'detail' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpg,png,gif,jpeg',
        ]);

        $blog = Blog::findOrFail($id);
        $input = $request->all();
        foreach ($blog->blog_m as $key => $bm) {
            # code...
            $bm->delete();
        }

        if ($file = $request->file('image')) {

            if ($blog->image != null) {

                $image_file = @file_get_contents(public_path() . '/images/blog/' . $blog->image);

                if ($image_file) {
                    unlink(public_path() . '/images/blog/' . $blog->image);
                }

            }

            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/blog/';
            $name = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $name, 72);

            $input['image'] = $name;

        }

        if (isset($request->is_active)) {
            $input['is_active'] = '1';
        } else {

            $input['is_active'] = '0';
        }

        $slug = str_slug($input['title'], '-');

        $input['slug'] = $slug;

        $blog->update($input);
        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
            for ($i = 0; $i < sizeof($menus); $i++) {
                if ($menus[$i] == 100) {
                    unset($menus);
                    $men = Menu::all();
                    foreach ($men as $key => $value) {
                        # code...
                        $menus[] = $value->id;
                    }
                    DB::table('blog_menu')->insert(
                        array(
                            'menu_id' => $menus[$i],
                            'blog_id' => $blog->id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        )
                    );

                } else {

                    DB::table('blog_menu')->insert(
                        array(
                            'menu_id' => $menus[$i],
                            'blog_id' => $blog->id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        )
                    );
                }

            }

        }

        return redirect('admin/blog')->with('updated', 'Post has been updated');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog_menu = BlogMenu::where('blog_id', $id)->delete();
        $blog->delete();

        return back()->with('deleted', 'Post has been deleted');
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
            $blog = Blog::findOrFail($checked);
            $blog_menu = BlogMenu::where('blog_id', $checked)->delete();

            $blog->delete();
        }
        return back()->with('deleted', 'Post has been deleted');
    }

}
