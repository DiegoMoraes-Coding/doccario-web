@props(['href' => '#', 'text' => 'Upload Document'])
<a href="{{ $href }}" class="btn btn-primary btn-lg px-4 d-flex align-items-center gap-2 upload-btn" role="button"
    x-loading-btn style="width: 11em;">
    <i class="ti ti-upload"></i>
    <span>{{ $text }}</span>
</a>
