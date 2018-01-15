@extends('articles.elements')

@section('content')
    <div class="container">
        <h3 style="text-align: center">Article list</h3>
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
            @foreach ($articles as $article)
                <tr>
                    <td>
                        {{ $article->title }}
                    </td>
                    <td>
                        <div id="content">
                            <?php
                            $max_length = 340;
                            if (strlen($article->description) > $max_length) {
                                $offset = ($max_length - 3) - strlen($article->description);
                                $article->description = substr($article->description, 0, strrpos($article->description, ' ', $offset)) . '...';
                            }
                            ?>
                            {{ $article->description }}
                        </div>
                    </td>
                    <td>
                        <img src="{{ $article->img_url }}" width="240">
                    </td>
                    <td>
                        {{ $article->published_date }}
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ env('APP_URL') }}/articles/{{$article->id}}"
                           data-toggle="tooltip" data-placement="top" data-title="">
                           Show
                        </a><br><br>
                        <a class="btn btn-xs btn-success list-inline" href="articles/create">Create</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-md-8 col-md-offset-2">
            {{ $articles->links() }}
        </div>
    </div>
@endsection


