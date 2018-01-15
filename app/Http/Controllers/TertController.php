<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class TertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Article::query();
        $articles = $query->paginate($this->rpp);

        return view('articles.index', ['articles' => $articles->appends(Input::except('page'))]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article_attribites = [];
        $article_attribites['title'] = $request->input('title');
        $article_attribites['description'] = $request->input('description');

        if (!empty($request->input('file_'))) {
            $file = Input::file('file');
            $file_name = uniqid();
            $file->move(storage_path('/app/public') . $file_name);

            $article_attribites['img_url'] = storage_path('app/public/') . $file_name;

        }
        $article_attribites['published_date'] = Carbon::now()->format('Y-m-d H:i:s');

        $article = Article::create($article_attribites);

        return redirect('articles/' . $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article->title = $request->input('title');
        $article->description = $request->input('description');

        var_dump($request->input('file'));
        die;
        if (!empty($request->input('file_upload'))) {
            $file = Input::file('file_upload');
            $file_name = uniqid();
            $file->move(storage_path('/app/public') . $file_name);

            var_dump(storage_path('app/public/') . $file_name);
            die;
            $article->img_url = storage_path('app/public/') . $file_name;

            var_dump($article);
            die;
        }

        var_dump("sdcfsds");
        die;
        $article->save();

        var_dump($article);
        die;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect('/articles');
    }
}
