@extends('home')
@section('title', $career->title)
@section('content')

<style type="text/css">
    .career-page {
        min-height: calc(100vh - 200px);
        padding: 77px 0px 80px;
        background: #fff;
    }

    .career-header {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        padding: 60px 20px 40px;
        margin-bottom: 40px;
    }

    .career-header h1 {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .career-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        margin-top: 20px;
    }

    .career-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .career-meta-item i {
        font-size: 20px;
    }

    .career-content {
        max-width: 900px;
        margin: 0 auto;
    }

    .career-section {
        margin-bottom: 40px;
    }

    .career-section h2 {
        color: #000;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
    }

    .career-section h3 {
        color: #333;
        font-size: 22px;
        font-weight: 600;
        margin-top: 25px;
        margin-bottom: 15px;
    }

    .career-section p,
    .career-section li {
        color: #666;
        line-height: 1.8;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .career-section ul {
        padding-left: 30px;
    }

    .career-section ul li {
        margin-bottom: 10px;
    }

    .career-actions {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #eee;
        text-align: center;
    }

    .btn-apply {
        background: #000;
        color: #fff;
        padding: 15px 40px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 18px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-apply:hover {
        background: #333;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-back {
        color: #666;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-right: 20px;
        transition: color 0.3s ease;
    }

    .btn-back:hover {
        color: #000;
    }

    @media (max-width: 768px) {
        .career-header h1 {
            font-size: 28px;
        }
        
        .career-meta {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<div class="career-page">
    <div class="career-header">
        <div class="container" style="max-width: 1400px; margin: 0 auto;">
            <h1>{{ $career->title }}</h1>
            
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
                
                @if($career->salary_min && $career->salary_max)
                <div class="career-meta-item">
                    <i class="material-icons">attach_money</i>
                    <span>৳{{ number_format($career->salary_min, 0) }} - ৳{{ number_format($career->salary_max, 0) }}</span>
                </div>
                @elseif($career->salary_min)
                <div class="career-meta-item">
                    <i class="material-icons">attach_money</i>
                    <span>৳{{ number_format($career->salary_min, 0) }}+</span>
                </div>
                @endif
                
                @if($career->deadline)
                <div class="career-meta-item">
                    <i class="material-icons">event</i>
                    <span>{{ __('messages.careers.deadline') }}: {{ date('F d, Y', strtotime($career->deadline)) }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 1400px; margin: 0 auto;">
        <div class="career-content">
            <div class="career-section">
                <h2>{{ __('messages.careers.description') }}</h2>
                <div>
                    {!! $career->description !!}
                </div>
            </div>

            @if($career->requirements)
            <div class="career-section">
                <h2>{{ __('messages.careers.requirements') }}</h2>
                <div>
                    {!! $career->requirements !!}
                </div>
            </div>
            @endif

            <div class="career-actions">
                <a href="{{ route('careers') }}" class="btn-back">
                    <i class="material-icons">arrow_back</i>
                    {{ __('messages.careers.back_to_list') }}
                </a>
                <a href="#" class="btn-apply" data-toggle="modal" data-target="#applicationModal">
                    <i class="material-icons">send</i>
                    {{ __('messages.careers.apply_now') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Application Modal -->
<div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="applicationModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
        <div class="modal-content" style="border-radius: 12px; border: none;">
            <div class="modal-header" style="background: #000; color: #fff; border-radius: 12px 12px 0 0; padding: 20px 30px;">
                <h4 class="modal-title" id="applicationModalLabel" style="font-weight: 600;">
                    <i class="material-icons" style="vertical-align: middle; margin-right: 10px;">work</i>
                    {{ __('messages.careers.apply_for') }}: {{ $career->title }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; opacity: 0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="applicationForm" action="{{ route('career.application.submit', $career->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 30px;">
                    <div id="applicationMessage" style="display: none; margin-bottom: 20px; padding: 15px; border-radius: 8px;"></div>
                    
                    <div class="form-group">
                        <label for="applicant_name">{{ __('messages.careers.applicant_name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="applicant_name" name="applicant_name" required style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_email">{{ __('messages.careers.applicant_email') }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="applicant_email" name="applicant_email" required style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_phone">{{ __('messages.careers.applicant_phone') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="applicant_phone" name="applicant_phone" required style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_address">{{ __('messages.careers.applicant_address') }}</label>
                        <textarea class="form-control" id="applicant_address" name="applicant_address" rows="2" style="border-radius: 8px; padding: 12px;"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_experience">{{ __('messages.careers.applicant_experience') }}</label>
                        <textarea class="form-control" id="applicant_experience" name="applicant_experience" rows="3" placeholder="{{ __('messages.careers.experience_placeholder') }}" style="border-radius: 8px; padding: 12px;"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_cover_letter">{{ __('messages.careers.cover_letter') }}</label>
                        <textarea class="form-control" id="applicant_cover_letter" name="applicant_cover_letter" rows="4" placeholder="{{ __('messages.careers.cover_letter_placeholder') }}" style="border-radius: 8px; padding: 12px;"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant_resume">{{ __('messages.careers.resume') }} (PDF, DOC, DOCX - Max 5MB)</label>
                        <input type="file" class="form-control" id="applicant_resume" name="applicant_resume" accept=".pdf,.doc,.docx" style="border-radius: 8px; padding: 12px;">
                    </div>
                    
                    <input type="hidden" name="career_id" value="{{ $career->id }}">
                    <input type="hidden" name="career_title" value="{{ $career->title }}">
                </div>
                <div class="modal-footer" style="padding: 20px 30px; border-top: 1px solid #eee;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px; padding: 10px 20px;">{{ __('messages.careers.cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="submitApplicationBtn" style="background: #000; border: none; border-radius: 8px; padding: 10px 30px;">
                        <i class="material-icons" style="vertical-align: middle; margin-right: 5px; font-size: 18px;">send</i>
                        {{ __('messages.careers.submit_application') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-content {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }
    
    .form-control:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }
    
    #submitApplicationBtn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<script>
    document.getElementById('applicationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitApplicationBtn');
        const messageDiv = document.getElementById('applicationMessage');
        const formData = new FormData(this);
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="material-icons" style="vertical-align: middle; margin-right: 5px; font-size: 18px;">hourglass_empty</i> {{ __('messages.careers.submitting') }}...';
        messageDiv.style.display = 'none';
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.className = 'alert alert-success';
                messageDiv.innerHTML = '<i class="material-icons" style="vertical-align: middle; margin-right: 5px;">check_circle</i> ' + data.message;
                messageDiv.style.display = 'block';
                this.reset();
                setTimeout(() => {
                    $('#applicationModal').modal('hide');
                    messageDiv.style.display = 'none';
                }, 2000);
            } else {
                messageDiv.className = 'alert alert-danger';
                messageDiv.innerHTML = '<i class="material-icons" style="vertical-align: middle; margin-right: 5px;">error</i> ' + (data.message || '{{ __('messages.careers.submission_error') }}');
                messageDiv.style.display = 'block';
            }
        })
        .catch(error => {
            messageDiv.className = 'alert alert-danger';
            messageDiv.innerHTML = '<i class="material-icons" style="vertical-align: middle; margin-right: 5px;">error</i> {{ __('messages.careers.submission_error') }}';
            messageDiv.style.display = 'block';
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="material-icons" style="vertical-align: middle; margin-right: 5px; font-size: 18px;">send</i> {{ __('messages.careers.submit_application') }}';
        });
    });
</script>

@endsection

