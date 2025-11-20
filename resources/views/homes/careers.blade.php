@extends('home')
@section('title', __('messages.careers.title'))
@section('content')

<style type="text/css">
    .careers-page {
        min-height: calc(100vh - 200px);
        padding: 77px 0px 80px;
        background: #f8f9fa;
    }

    .careers-hero {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        padding: 80px 20px 60px;
        text-align: center;
        margin-bottom: 60px;
    }

    .careers-hero h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .careers-hero p {
        font-size: 18px;
        opacity: 0.9;
    }

    .career-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .career-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .career-card h3 {
        color: #000;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .career-card h3 a {
        color: #000;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .career-card h3 a:hover {
        color: #333;
    }

    .career-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .career-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 14px;
    }

    .career-meta-item i {
        color: #000;
        font-size: 18px;
    }

    .career-description {
        color: #666;
        line-height: 1.8;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .career-actions {
        display: flex;
        gap: 10px;
    }

    .btn-view {
        background: #000;
        color: #fff;
        padding: 10px 24px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        background: #333;
        color: #fff;
        transform: translateY(-2px);
    }

    .no-careers {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-careers i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .careers-hero h1 {
            font-size: 32px;
        }
        
        .career-card {
            padding: 20px;
        }
        
        .career-meta {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<div class="careers-page">
    <div class="careers-hero">
        <div class="container" style="max-width: 1400px; margin: 0 auto;">
            <h1>{{ __('messages.careers.title') }}</h1>
            <p>{{ __('messages.careers.subtitle') }}</p>
        </div>
    </div>

    <div class="container" style="max-width: 1400px; margin: 0 auto;">
        @if($careers->count() > 0)
            <div class="row">
                @foreach($careers as $career)
                <div class="col-md-6">
                    <div class="career-card">
                        <h3>
                            <a href="{{ route('public.career.show', $career->id) }}">{{ $career->title }}</a>
                        </h3>
                        
                        <div class="career-meta">
                            @if($career->department)
                            <div class="career-meta-item">
                                <i class="material-icons">business</i>
                                <span>{{ $career->department }}</span>
                            </div>
                            @endif
                            
                            @if($career->location)
                            <div class="career-meta-item">
                                <i class="material-icons">location_on</i>
                                <span>{{ $career->location }}</span>
                            </div>
                            @endif
                            
                            @if($career->type)
                            <div class="career-meta-item">
                                <i class="material-icons">schedule</i>
                                <span>{{ $career->type }}</span>
                            </div>
                            @endif
                            
                            @if($career->deadline)
                            <div class="career-meta-item">
                                <i class="material-icons">event</i>
                                <span>{{ date('M d, Y', strtotime($career->deadline)) }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="career-description">
                            {!! \Illuminate\Support\Str::limit(strip_tags($career->description), 150) !!}
                        </div>
                        
                        <div class="career-actions">
                            <a href="{{ route('public.career.show', $career->id) }}" class="btn-view">
                                <i class="material-icons">arrow_forward</i>
                                {{ __('messages.careers.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="no-careers">
                <i class="material-icons">work_off</i>
                <h3>{{ __('messages.careers.no_careers') }}</h3>
                <p>{{ __('messages.careers.no_careers_message') }}</p>
            </div>
        @endif
    </div>
</div>

@endsection

