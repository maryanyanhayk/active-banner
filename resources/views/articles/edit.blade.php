@extends('articles.elements')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 style="text-align: center">Edite article</h3>
        <form action="/articles/{{$article->id}}" method="POST" enctype="multipart/form-data"
              class="form-horizontal form-label-left">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                    Title
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="title" type="text" name="title" value="{{ $article->title }}"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('title')) parsley-error @endif">
                    <ul class="parsley-errors-list filled">
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    Description
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="description" type="text" name="description" value="{{$article->description}}"
                           class="form-control col-md-7 col-xs-12 @if($errors->has('description')) parsley-error @endif">
                    <ul class="parsley-errors-list filled">
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                    Article image
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" accept="image/*" name="article_image" id="article_image"
                           value="{{$article->img_url}}" required/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success"> {{ ('Save') }}</button>
                    <a class="btn btn-primary" style="float:right"
                       href="{{ \Illuminate\Support\Facades\URL::previous() }}"> {{ ('See changed article') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>