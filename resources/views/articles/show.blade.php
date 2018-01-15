@extends('articles.elements')


<form action="/articles/{{$article->id}}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="container">
        <h3 style="text-align: center">Viewing current article</h3>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Published date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    {{ $article->title }}
                </td>
                <td>
                    {{ $article->description }}
                </td>
                <td>
                    <img src="{{ $article->img_url }}" width="240">
                </td>
                <td>
                    {{ $article->published_date }}
                </td>
                <td>
                    <button class="btn btn-block "><a style="text-decoration: none" href="{{ env('APP_URL') }}/articles/{{$article->id}}/edit">Edit</a></button>
                    <button class = "btn btn-danger btn-block" type="submit" class="btn btn-link" >Delete</button>
                        <a class="btn btn-primary" style="text-decoration:none;margin-top: 5px;"
                           href="{{ \Illuminate\Support\Facades\URL::previous() }}"> {{ ('Go to list') }}</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
