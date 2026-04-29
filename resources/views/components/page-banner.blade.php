<!-- Page Banner Component -->
<section class="page-banner {{ $class ?? '' }}" style="background-image: url('{{ $image ?? '' }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="banner-content">
                    @if(isset($breadcrumb) && $breadcrumb)
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            @foreach($breadcrumb as $item)
                                @if(isset($item['url']))
                                    <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">{{ $item['name'] }}</li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                    @endif
                    
                    <h1 class="banner-title">{{ $title }}</h1>
                    
                    @if(isset($subtitle))
                        <p class="banner-subtitle">{{ $subtitle }}</p>
                    @endif
                    
                    @if(isset($button_text) && isset($button_url))
                        <a href="{{ $button_url }}" class="btn btn-banner">{{ $button_text }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>