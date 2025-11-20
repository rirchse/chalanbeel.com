@extends('home')
@section('title', __('messages.speed_test.title'))
@section('content')

<style type="text/css">
    .speed-test-page {
        min-height: calc(100vh - 70px);
        padding: 150px 20px 80px;
        background: #fff;
        position: relative;
        overflow: hidden;
    }

    .speed-test-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(0,0,0,0.03)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
    }

    .speed-test-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .speed-test-header {
        text-align: center;
        margin-bottom: 60px;
        color: #000;
    }

    .speed-test-title {
        font-size: 48px;
        font-weight: 800;
        color: #000;
        margin: 0 0 15px 0;
    }

    .speed-test-subtitle {
        font-size: 18px;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .speed-test-card {
        background: #fff;
        border: 2px solid #e0e0e0;
        border-radius: 24px;
        padding: 60px 40px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .speed-gauge-container {
        position: relative;
        width: 300px;
        height: 300px;
        margin: 0 auto 40px;
    }

    .speed-gauge {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .speed-gauge-circle {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 20px solid #e0e0e0;
        border-top-color: #000;
        border-right-color: #000;
        transform: rotate(-90deg);
        transition: all 0.3s ease;
    }

    .speed-gauge-inner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .speed-value {
        font-size: 56px;
        font-weight: 800;
        color: #000;
        line-height: 1;
        margin-bottom: 5px;
    }

    .speed-unit {
        font-size: 20px;
        color: #666;
        font-weight: 600;
    }

    .speed-label {
        font-size: 16px;
        color: #999;
        margin-top: 5px;
    }

    .speed-test-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .test-btn {
        padding: 18px 40px;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .test-btn-primary {
        background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
        color: #fff;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .test-btn-primary:hover:not(:disabled) {
        background: linear-gradient(135deg, #1a1a1a 0%, #000 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    }

    .test-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .test-btn-secondary {
        background: transparent;
        border: 2px solid #000;
        color: #000;
    }

    .test-btn-secondary:hover:not(:disabled) {
        background: #000;
        color: #fff;
        transform: translateY(-3px);
    }

    .speed-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .speed-stat-card {
        background: #f8f9fa;
        padding: 30px 20px;
        border-radius: 16px;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .speed-stat-card:hover {
        border-color: #000;
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .speed-stat-label {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .speed-stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #000;
        line-height: 1;
    }

    .speed-stat-unit {
        font-size: 16px;
        color: #999;
        margin-left: 5px;
    }

    .test-status {
        margin-top: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        border-left: 4px solid #000;
        display: none;
    }

    .test-status.active {
        display: block;
    }

    .test-status-text {
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: #e0e0e0;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 15px;
        display: none;
    }

    .progress-bar.active {
        display: block;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #000 0%, #333 100%);
        width: 0%;
        transition: width 0.3s ease;
        border-radius: 4px;
    }

    @media (max-width: 768px) {
        .speed-test-page {
            padding: 80px 15px 60px;
        }

        .speed-test-title {
            font-size: 36px;
        }

        .speed-test-subtitle {
            font-size: 16px;
        }

        .speed-test-card {
            padding: 40px 25px;
        }

        .speed-gauge-container {
            width: 250px;
            height: 250px;
        }

        .speed-value {
            font-size: 42px;
        }

        .test-btn {
            padding: 16px 30px;
            font-size: 16px;
        }

        .speed-stats {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="speed-test-page">
    <div class="speed-test-container">
        <div class="speed-test-header">
            <h1 class="speed-test-title">{{ __('messages.speed_test.title') }}</h1>
            <p class="speed-test-subtitle">{{ __('messages.speed_test.subtitle') }}</p>
        </div>

        <div class="speed-test-card">
            <!-- Download Speed Gauge -->
            <div class="speed-gauge-container">
                <div class="speed-gauge">
                    <svg class="speed-gauge-circle" id="downloadGauge" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="90" fill="none" stroke="#e0e0e0" stroke-width="20"/>
                        <circle cx="100" cy="100" r="90" fill="none" stroke="#000" stroke-width="20" 
                                stroke-dasharray="565.48" stroke-dashoffset="565.48" 
                                id="downloadProgress" transform="rotate(-90 100 100)"/>
                    </svg>
                    <div class="speed-gauge-inner">
                        <div class="speed-value" id="downloadSpeed">0</div>
                        <div class="speed-unit">Mbps</div>
                        <div class="speed-label" id="downloadLabel">{{ __('messages.speed_test.download') }}</div>
                    </div>
                </div>
            </div>

            <!-- Test Buttons -->
            <div class="speed-test-buttons">
                <button class="test-btn test-btn-primary" id="startTestBtn">
                    <i class="material-icons">play_arrow</i>
                    {{ __('messages.speed_test.start_test') }}
                </button>
                <button class="test-btn test-btn-secondary" id="resetTestBtn" disabled>
                    <i class="material-icons">refresh</i>
                    {{ __('messages.speed_test.reset') }}
                </button>
            </div>

            <!-- Test Status -->
            <div class="test-status" id="testStatus">
                <div class="test-status-text" id="statusText"></div>
                <div class="progress-bar" id="progressBar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
            </div>

            <!-- Speed Stats -->
            <div class="speed-stats">
                <div class="speed-stat-card">
                    <div class="speed-stat-label">{{ __('messages.speed_test.download') }}</div>
                    <div class="speed-stat-value">
                        <span id="statDownload">0</span>
                        <span class="speed-stat-unit">Mbps</span>
                    </div>
                </div>
                <div class="speed-stat-card">
                    <div class="speed-stat-label">{{ __('messages.speed_test.upload') }}</div>
                    <div class="speed-stat-value">
                        <span id="statUpload">0</span>
                        <span class="speed-stat-unit">Mbps</span>
                    </div>
                </div>
                <div class="speed-stat-card">
                    <div class="speed-stat-label">{{ __('messages.speed_test.ping') }}</div>
                    <div class="speed-stat-value">
                        <span id="statPing">0</span>
                        <span class="speed-stat-unit">ms</span>
                    </div>
                </div>
                <div class="speed-stat-card">
                    <div class="speed-stat-label">{{ __('messages.speed_test.jitter') }}</div>
                    <div class="speed-stat-value">
                        <span id="statJitter">0</span>
                        <span class="speed-stat-unit">ms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startBtn = document.getElementById('startTestBtn');
    const resetBtn = document.getElementById('resetTestBtn');
    const downloadSpeed = document.getElementById('downloadSpeed');
    const downloadProgress = document.getElementById('downloadProgress');
    const downloadLabel = document.getElementById('downloadLabel');
    const testStatus = document.getElementById('testStatus');
    const statusText = document.getElementById('statusText');
    const progressBar = document.getElementById('progressBar');
    const progressFill = document.getElementById('progressFill');
    
    const statDownload = document.getElementById('statDownload');
    const statUpload = document.getElementById('statUpload');
    const statPing = document.getElementById('statPing');
    const statJitter = document.getElementById('statJitter');

    let isTesting = false;
    let downloadResult = 0;
    let uploadResult = 0;
    let pingResult = 0;
    let jitterResult = 0;

    // Calculate circumference for progress circle
    const circumference = 2 * Math.PI * 90; // radius = 90

    function updateGauge(value, maxValue = 100) {
        const percentage = Math.min((value / maxValue) * 100, 100);
        const offset = circumference - (percentage / 100) * circumference;
        downloadProgress.style.strokeDashoffset = offset;
        downloadSpeed.textContent = value.toFixed(2);
    }

    function updateProgress(percent) {
        progressFill.style.width = percent + '%';
    }

    function setStatus(text, showProgress = false) {
        statusText.textContent = text;
        testStatus.classList.add('active');
        if (showProgress) {
            progressBar.classList.add('active');
        } else {
            progressBar.classList.remove('active');
        }
    }

    function resetTest() {
        downloadResult = 0;
        uploadResult = 0;
        pingResult = 0;
        jitterResult = 0;
        
        updateGauge(0);
        statDownload.textContent = '0';
        statUpload.textContent = '0';
        statPing.textContent = '0';
        statJitter.textContent = '0';
        
        testStatus.classList.remove('active');
        progressBar.classList.remove('active');
        updateProgress(0);
        
        downloadLabel.textContent = '{{ __('messages.speed_test.download') }}';
        startBtn.disabled = false;
        resetBtn.disabled = true;
        isTesting = false;
    }

    async function testDownloadSpeed() {
        return new Promise(async (resolve, reject) => {
            setStatus('{{ __('messages.speed_test.testing_download') }}...', true);
            downloadLabel.textContent = '{{ __('messages.speed_test.testing') }}';
            
            try {
                const testSizes = [1, 2, 5]; // Test with 1MB, 2MB, 5MB files
                let totalBytes = 0;
                let totalTime = 0;
                
                for (let i = 0; i < testSizes.length; i++) {
                    const size = testSizes[i];
                    const startTime = performance.now();
                    
                    const response = await fetch(`/speed-test/download?size=${size}&t=${Date.now()}`, {
                        method: 'GET',
                        cache: 'no-cache'
                    });
                    
                    if (!response.ok) {
                        throw new Error('Download test failed');
                    }
                    
                    const blob = await response.blob();
                    const endTime = performance.now();
                    
                    const bytes = blob.size;
                    const time = (endTime - startTime) / 1000; // Convert to seconds
                    
                    totalBytes += bytes;
                    totalTime += time;
                    
                    // Calculate current speed in Mbps
                    const currentSpeed = (bytes * 8) / time / 1000000;
                    const progress = ((i + 1) / testSizes.length) * 100;
                    
                    updateGauge(currentSpeed, 100);
                    updateProgress(progress);
                    
                    // Small delay between tests
                    if (i < testSizes.length - 1) {
                        await new Promise(resolve => setTimeout(resolve, 200));
                    }
                }
                
                // Calculate average speed in Mbps
                const averageSpeed = (totalBytes * 8) / totalTime / 1000000;
                resolve(averageSpeed);
            } catch (error) {
                console.error('Download test error:', error);
                reject(error);
            }
        });
    }

    // Get CSRF token helper function
    function getCsrfToken() {
        // Try to get from meta tag first
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            return metaTag.getAttribute('content');
        }
        
        // Fallback to cookie
        const name = 'XSRF-TOKEN=';
        const decodedCookie = decodeURIComponent(document.cookie);
        const ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return '';
    }

    async function testUploadSpeed() {
        return new Promise(async (resolve, reject) => {
            setStatus('{{ __('messages.speed_test.testing_upload') }}...', true);
            downloadLabel.textContent = '{{ __('messages.speed_test.upload') }}';
            
            try {
                const testSizes = [0.5, 1, 2]; // Test with 0.5MB, 1MB, 2MB uploads
                let totalBytes = 0;
                let totalTime = 0;
                
                const csrfToken = getCsrfToken();
                
                for (let i = 0; i < testSizes.length; i++) {
                    const sizeMB = testSizes[i];
                    const sizeBytes = sizeMB * 1024 * 1024;
                    
                    // Generate random data for upload
                    const data = new Uint8Array(sizeBytes);
                    for (let j = 0; j < sizeBytes; j++) {
                        data[j] = Math.floor(Math.random() * 256);
                    }
                    
                    const blob = new Blob([data], { type: 'application/octet-stream' });
                    const startTime = performance.now();
                    
                    const headers = {
                        'Content-Type': 'application/octet-stream',
                        'X-Requested-With': 'XMLHttpRequest'
                    };
                    
                    // Add CSRF token if available
                    if (csrfToken) {
                        headers['X-CSRF-TOKEN'] = csrfToken;
                    }
                    
                    const response = await fetch('/speed-test/upload', {
                        method: 'POST',
                        body: blob,
                        headers: headers,
                        cache: 'no-cache',
                        credentials: 'same-origin'
                    });
                    
                    if (!response.ok) {
                        throw new Error('Upload test failed');
                    }
                    
                    const endTime = performance.now();
                    const time = (endTime - startTime) / 1000; // Convert to seconds
                    
                    totalBytes += sizeBytes;
                    totalTime += time;
                    
                    // Calculate current speed in Mbps
                    const currentSpeed = (sizeBytes * 8) / time / 1000000;
                    const progress = ((i + 1) / testSizes.length) * 100;
                    
                    updateGauge(currentSpeed, 100);
                    updateProgress(progress);
                    
                    // Small delay between tests
                    if (i < testSizes.length - 1) {
                        await new Promise(resolve => setTimeout(resolve, 200));
                    }
                }
                
                // Calculate average speed in Mbps
                const averageSpeed = (totalBytes * 8) / totalTime / 1000000;
                resolve(averageSpeed);
            } catch (error) {
                console.error('Upload test error:', error);
                reject(error);
            }
        });
    }

    async function testPing() {
        return new Promise(async (resolve, reject) => {
            try {
                const pings = [];
                const numTests = 5;
                
                for (let i = 0; i < numTests; i++) {
                    const startTime = performance.now();
                    
                    const response = await fetch(`/speed-test/ping?t=${Date.now()}`, {
                        method: 'GET',
                        cache: 'no-cache'
                    });
                    
                    if (!response.ok) {
                        throw new Error('Ping test failed');
                    }
                    
                    const endTime = performance.now();
                    const ping = endTime - startTime;
                    pings.push(ping);
                    
                    // Small delay between pings
                    if (i < numTests - 1) {
                        await new Promise(resolve => setTimeout(resolve, 100));
                    }
                }
                
                // Calculate average ping
                const averagePing = pings.reduce((a, b) => a + b, 0) / pings.length;
                resolve(averagePing);
            } catch (error) {
                console.error('Ping test error:', error);
                reject(error);
            }
        });
    }

    async function testJitter() {
        return new Promise(async (resolve, reject) => {
            try {
                const pings = [];
                const numTests = 10;
                
                for (let i = 0; i < numTests; i++) {
                    const startTime = performance.now();
                    
                    const response = await fetch(`/speed-test/ping?t=${Date.now()}`, {
                        method: 'GET',
                        cache: 'no-cache'
                    });
                    
                    if (!response.ok) {
                        throw new Error('Jitter test failed');
                    }
                    
                    const endTime = performance.now();
                    const ping = endTime - startTime;
                    pings.push(ping);
                    
                    // Small delay between pings
                    if (i < numTests - 1) {
                        await new Promise(resolve => setTimeout(resolve, 50));
                    }
                }
                
                // Calculate jitter (average variation between consecutive pings)
                let jitterSum = 0;
                for (let i = 1; i < pings.length; i++) {
                    jitterSum += Math.abs(pings[i] - pings[i - 1]);
                }
                const jitter = jitterSum / (pings.length - 1);
                
                resolve(jitter);
            } catch (error) {
                console.error('Jitter test error:', error);
                reject(error);
            }
        });
    }

    async function runSpeedTest() {
        if (isTesting) return;
        
        isTesting = true;
        startBtn.disabled = true;
        resetBtn.disabled = true;
        
        try {
            // Test Ping
            setStatus('{{ __('messages.speed_test.testing_ping') }}...', false);
            pingResult = await testPing();
            statPing.textContent = pingResult.toFixed(0);
            
            // Test Jitter
            setStatus('{{ __('messages.speed_test.testing_jitter') }}...', false);
            jitterResult = await testJitter();
            statJitter.textContent = jitterResult.toFixed(1);
            
            // Test Download
            downloadResult = await testDownloadSpeed();
            statDownload.textContent = downloadResult.toFixed(2);
            updateGauge(downloadResult, 100);
            
            // Test Upload
            uploadResult = await testUploadSpeed();
            statUpload.textContent = uploadResult.toFixed(2);
            updateGauge(uploadResult, 100);
            
            // Final status
            setStatus('{{ __('messages.speed_test.test_complete') }}', false);
            downloadLabel.textContent = '{{ __('messages.speed_test.download') }}';
            updateGauge(downloadResult, 100);
            resetBtn.disabled = false;
            
        } catch (error) {
            setStatus('{{ __('messages.speed_test.test_error') }}', false);
            console.error('Speed test error:', error);
        } finally {
            isTesting = false;
            startBtn.disabled = false;
        }
    }

    startBtn.addEventListener('click', runSpeedTest);
    resetBtn.addEventListener('click', resetTest);
    
    // Initialize
    resetTest();
});
</script>

@endsection

