<div>
    <div wire:ignore x-data x-init="tinymce.init({
        selector: '#{{ $editorId }}',
        plugins: 'advlist autolink lists link image charmap preview table',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image',
        height: 500,
        license_key: 'gpl',
        resize: false,
        statusbar: false,
        skin_url: '/tinymce/skins/ui/oxide',
        content_css: '/tinymce/skins/content/default/content.css',
        relative_urls: false,
        remove_script_host: false,
        images_upload_url: '{{ route('rich-text-editor.upload') }}',
        images_upload_credentials: true,
        images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('upload', blobInfo.blob(), blobInfo.filename());
    
            fetch('{{ route('rich-text-editor.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    resolve(result.location);
                })
                .catch(error => {
                    reject('Image upload failed');
                });
        }),
        image_dimensions: false,
        image_class_list: [
            { title: 'Responsive', value: 'img-fluid' }
        ],
        file_picker_types: 'image',
        setup: (editor) => {
            const debounce = (func, wait) => {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            };
    
            const updateContent = debounce(() => {
                $wire.updateContent(editor.getContent());
            }, 300);
    
            editor.on('change', updateContent);
            editor.on('keyup', updateContent);
            editor.on('input', updateContent);
            editor.on('blur', updateContent);
    
            editor.on('init', () => {
                editor.setContent(@js($content));
            });
        }
    });">
        <textarea id="{{ $editorId }}" class="w-full">{{ $content }}</textarea>
    </div>

</div>
