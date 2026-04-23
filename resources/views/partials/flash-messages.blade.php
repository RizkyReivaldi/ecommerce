{{-- ================================================
FLASH MESSAGES – GLASS INSTAX
================================================ --}}

<div id="instax-toast-container">

    @if(session('success'))
        <div class="instax-toast success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button class="toast-close">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="instax-toast error">
            <i class="bi bi-x-circle-fill"></i>
            <span>{{ session('error') }}</span>
            <button class="toast-close">&times;</button>
        </div>
    @endif

    @if(session('info'))
        <div class="instax-toast info">
            <i class="bi bi-info-circle-fill"></i>
            <span>{{ session('info') }}</span>
            <button class="toast-close">&times;</button>
        </div>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="instax-toast error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ $error }}</span>
                <button class="toast-close">&times;</button>
            </div>
        @endforeach
    @endif

</div>

