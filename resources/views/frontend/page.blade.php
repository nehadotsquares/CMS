@extends('layouts.app')

@section('title', $page->title)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="content-page">
                    <h1 class="display-4 mb-4">{{ $page->title }}</h1>
                    <div class="page-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection