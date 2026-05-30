@props(['text' => 'Upload Document'])

<form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data" x-data="{ uploading: false }">
    @csrf

    <input type="file" name="file" id="fileInput" accept=".pdf" style="display: none;" required x-ref="fileInput"
        @change="if ($event.target.files.length > 0) { uploading = true; $el.form.submit(); }">

    <button type="button" class="btn btn-primary btn-lg px-4 d-flex align-items-center gap-2 upload-btn"
        style="width: 11em;" @click="$refs.fileInput.click()" x-bind:disabled="uploading">
        <template x-if="!uploading">
            <span class="d-flex align-items-center gap-2">
                <i class="ti ti-upload"></i>
                <span>{{ $text }}</span>
            </span>
        </template>
        <template x-if="uploading">
            <span class="d-flex align-items-center gap-2">
                <span class="spinner-border spinner-border-sm" role="status"></span>
                <span>Uploading...</span>
            </span>
        </template>
    </button>
</form>
