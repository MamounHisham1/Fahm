<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{
        state: $wire.$entangle('{{ $getStatePath() }}'),
        videoUrl: null,
        videoPublicId: null,
        isUploading: false,
        progress: 0,
        error: null,
        
        init() {
            if (this.state && this.state.url) {
                this.videoUrl = this.state.url;
                this.videoPublicId = this.state.public_id;
            }
        },
        
        uploadVideo() {
            this.isUploading = true;
            this.progress = 0;
            this.error = null;
            
            const uploadWidget = cloudinary.createUploadWidget({
                cloudName: '{{ env('CLOUDINARY_CLOUD_NAME') }}',
                uploadPreset: '{{ env('CLOUDINARY_UPLOAD_PRESET') }}',
                sources: ['local', 'url', 'camera'],
                multiple: false,
                resourceType: 'video',
                maxFileSize: 100000000, // 100MB
                folder: 'lessons',
                showAdvancedOptions: false,
                styles: {
                    palette: {
                        window: '#FFFFFF',
                        windowBorder: '#90A0B3',
                        tabIcon: '#0078FF',
                        menuIcons: '#5A616A',
                        textDark: '#000000',
                        textLight: '#FFFFFF',
                        link: '#0078FF',
                        action: '#FF620C',
                        inactiveTabIcon: '#0E2F5A',
                        error: '#F44235',
                        inProgress: '#0078FF',
                        complete: '#20B832',
                        sourceBg: '#E4EBF1'
                    }
                }
            }, (error, result) => {
                if (!error && result && result.event === 'success') {
                    this.videoUrl = result.info.secure_url;
                    this.videoPublicId = result.info.public_id;
                    this.state = {
                        url: result.info.secure_url,
                        public_id: result.info.public_id
                    };
                    this.isUploading = false;
                    this.progress = 100;
                }
                
                if (error) {
                    this.error = error.message || 'Upload failed';
                    this.isUploading = false;
                }
                
                if (result && result.event === 'close') {
                    this.isUploading = false;
                }
            });
            
            uploadWidget.open();
        },
        
        removeVideo() {
            if (confirm('Are you sure you want to remove this video?')) {
                this.videoUrl = null;
                this.videoPublicId = null;
                this.state = null;
                this.progress = 0;
            }
        }
    }" class="space-y-2">
        <!-- Video Preview -->
        <div x-show="videoUrl" class="relative rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
            <div class="aspect-video">
                <video x-bind:src="videoUrl" controls class="w-full h-full object-contain"></video>
            </div>
            <button 
                type="button" 
                x-on:click="removeVideo"
                class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Upload Button -->
        <div x-show="!videoUrl">
            <button 
                type="button" 
                x-on:click="uploadVideo"
                class="w-full py-2.5 px-4 border border-dashed border-gray-300 dark:border-gray-700 rounded-lg flex items-center justify-center gap-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <span>{{ __('Upload Video') }}</span>
            </button>
        </div>
        
        <!-- Progress Bar -->
        <div x-show="isUploading" class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" x-bind:style="'width: ' + progress + '%'"></div>
        </div>
        
        <!-- Error Message -->
        <div x-show="error" x-text="error" class="text-sm text-red-500"></div>
        
        <!-- Hidden Input -->
        <input 
            type="hidden" 
            x-bind:value="JSON.stringify(state)" 
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}" 
        />
    </div>
    
    <!-- Cloudinary Upload Widget Script -->
    <script src="https://upload-widget.cloudinary.com/global/all.js"></script>
</x-dynamic-component>
