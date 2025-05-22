@section('script')
    <script>
        const style = document.createElement('style');
        style.innerHTML = `
            .ck-content img {
                height: auto;
                display: block;
            }
        `;
        document.head.appendChild(style);
        function ImageResponsivePlugin(editor) {
            editor.conversion.for('downcast').add(dispatcher => {
                dispatcher.on('insert:image', (evt, data, conversionApi) => {
                    const viewWriter = conversionApi.writer;
                    const figure = conversionApi.mapper.toViewElement(data.item);
                    const imageElement = figure.getChild(0);

                    viewWriter.setAttribute('class', 'img-responsive', imageElement);
                    viewWriter.removeAttribute('style', imageElement);
                });
            });
        }

        const CKEditorDocument = function() {
            // Document editor
            const _componentCKEditorDocument = function() {
                if (typeof DecoupledEditor == 'undefined') {
                    console.warn('Warning - ckeditor_document.js is not loaded.');
                    return;
                }

                // Basic example
                DecoupledEditor.create(document.querySelector('#document_editor_basic .document-editor-editable'), {
                    extraPlugins: [ImageResponsivePlugin],
                    simpleUpload: {
                        // Chỉ sử dụng một cấu hình upload
                        uploadUrl: '{{ route("admin.post.upload") }}',
                        withCredentials: true,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    },
                    image: {
                        resizeOptions: [
                            { name: 'resizeImage:original', value: null, label: 'Original' },
                            { name: 'resizeImage:50',     value: '100',  label: '100px' },
                            { name: 'resizeImage:100',    value: '200',  label: '200px' },
                            { name: 'resizeImage:150',    value: '300',  label: '300px' },
                            { name: 'resizeImage:200',    value: '400',  label: '400px' },
                            { name: 'resizeImage:250',    value: '500',  label: '500px' },
                            { name: 'resizeImage:300',    value: '600',  label: '600px' },
                            { name: 'resizeImage:350',    value: '700',  label: '700px' },
                            { name: 'resizeImage:400',    value: '800',  label: '800px' },
                            { name: 'resizeImage:450',    value: '900',  label: '900px' },
                            { name: 'resizeImage:500',    value: '1000', label: '1000px' }
                        ],
                        toolbar: [
                            'imageStyle:inline',
                            'imageStyle:block',
                            'imageStyle:side',
                            '|',
                            'toggleImageCaption',
                            'imageTextAlternative',
                            '|',
                            'resizeImage',
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                        ]
                    },
                    fontSize: {
                        options: [
                            '10px',
                            '11px',
                            '12px',
                            '13px',
                            '14px',
                            '15px',
                            '16px',
                            '17px',
                            '18px',
                            '19px',
                            '20px',
                            '21px',
                            '22px',
                            '23px',
                            '24px',
                            '25px',
                            '26px',
                            '27px',
                            '28px',
                            '29px',
                            '30px',
                            '36px',
                            '38px',
                            '40px',
                            '42px',
                            '44px',
                            '46px',
                            '48px',
                            '50px',
                            '52px',
                            '54px',
                            '56px',
                            '58px',
                            '60px',
                            '62px',
                            '64px',
                            '66px',
                            '68px',
                            '70px',
                            '72px',
                        ],
                        supportAllValues: true
                    },
                }).then(editor => {
                    // Add custom upload adapter if needed
                    editor.plugins.get('FileRepository').createUploadAdapter = loader => {
                        return {
                            upload: () => {
                                return loader.file.then(file => {
                                    const formData = new FormData();
                                    formData.append('upload', file);

                                    return fetch('{{ route("admin.post.upload") }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: formData
                                    })
                                        .then(response => response.json())
                                        .then(response => {
                                            if (!response.uploaded) {
                                                throw response.error.message;
                                            }
                                            return {
                                                default: response.url
                                            };
                                        });
                                });
                            },
                            abort: () => {
                                console.log('Upload aborted');
                            }
                        };
                    };
                    window.editor = editor;
                    // Push về Livewire
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    });

                    // Nhận dữ liệu từ Livewire (nếu cần)
                    Livewire.on('contentUpdated', content => {
                        if (content !== null && content !== undefined) {
                            editor.setData(content);
                        }
                    });
                    const toolbarContainer = document.querySelector('#document_editor_basic .document-editor-toolbar');
                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                })
                    .catch(error => {
                        console.error(error);
                    });
            };
            return {
                init: function() {
                    _componentCKEditorDocument();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function() {
            CKEditorDocument.init();
        });

    </script>

@endsection
@section('style_custom')
    <style>
        /* Giới hạn dropdown chiều cao và thêm thanh cuộn */
        .ck-dropdown__panel .ck-list {
            max-height: 200px; /* Hoặc 150px tùy bạn */
            overflow-y: auto;
        }
    </style>
@endsection
<div class="row">

    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin bài viết
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">
                        Tiêu đề: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="title" type="text" placeholder="Nhập vào tiêu đề bài viết" class="form-control  @error('title') is-invalid @enderror">
                        @error('title')
                            <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Ảnh đại diện: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="thumbnail" type="file" class="form-control  @error('thumbnail') is-invalid @enderror">
                        @error('thumbnail')
                            <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mt-2">
                        @if ($thumbnail)
                            <img src="{{ $thumbnail->temporaryUrl() }}" alt="New thumbnail" class="img-thumbnail" width="250">
                        @endif
                    </div>
                </div>

                <div class="form-group mt-2">
                    <label class="form-label">
                        Danh mục bài viết: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <div class="d-flex gap-3">
                            <select wire:model.live="category" class="form-control  @error('category') is-invalid @enderror">
                                <option value="">Chọn danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if(!$toggleAddCategoryPost)
                            <button wire:click="ShowAddCategoryPost" class="btn btn-primary" style="width: 230px"><i class="ph-plus"></i>Thêm danh mục</button>
                            @else
                            <button wire:click="ShowAddCategoryPost" class="btn btn-danger" style="width: 230px"><i class="ph-x"></i>Hủy</button>
                            @endif
                        </div>
                        @if($toggleAddCategoryPost)
                            <livewire:admin.clubs.posts.cpn-add-category-post :club_id="$club_id" />
                        @endif
                        @error('category')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-2">
                    <label class="form-label">
                        Nội dung bài viết: <span class="text-danger">*</span>
                    </label>

                    <div class="document-editor" id="document_editor_basic" wire:ignore>
                        <div class="document-editor-toolbar"></div>
                        <div class="document-editor-container">
                            <div class="document-editor-editable" style="width: 100%;">
                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                    @error('content')
                    <label class="text-danger mt-1">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex flex-wrap align-items-center gap-1">
                <button wire:click="storeDraft" class="btn btn-success" type="submit"><i class="ph-file"></i>Lưu bản nháp</button>
                @if(Auth::user()->hasPermissonClub('Quản lý bài viết', $this->club_id)) <button wire:click="store" class="btn btn-primary" type="submit"><i class="ph-floppy-disk"></i>Đăng ngay</button>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#calender" type="button" class="btn btn-info"><i class="ph-calendar"></i>Lên lịch</a>
                @elseif(Auth::user()->hasPermissonClub('Tạo bài viết mới', $this->club_id))
                    <button wire:click="store" class="btn btn-primary" type="submit"><i class="ph-paper-plane-right"></i>Gửi duyệt bài</button>
                @endif
                <a href="{{ route('admin.club.post-index',['id'=>$club_id]) }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
            <div class="card-body d-flex align-items-center gap-1" style="padding-top: 0">
            </div>
        </div>
    </div>
</div>
