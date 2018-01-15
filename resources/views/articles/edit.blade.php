<form action="/articles/{{$article->id}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="container">
        <table>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Description
                </th>
                <th>
                    Image Url
                </th>
                <th>
                    Published Date
                </th>

            </tr>
            <tr>
                <td>
                    <input type="text" name="title" value="{{ $article->title }}"/>
                </td>
                <td>
                    <input type="text" name="description" value="{{ $article->description }}"/>
                </td>
                <td>
                    <img src="{{ $article->img_url }}" width="240"/>
                    <input id="file" type="file" name="file"/>
                </td>
                <td>
                    {{ $article->published_date }}
                </td>

            </tr>

        </table>

        <button type="submit" class="btn btn-link">Save</button>
    </div>
</form>
