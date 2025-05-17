<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="thumbnail background">
                <img class="radius w-100" src="{{$club->banner==null?asset('assets/client/images/bg/default-banner.jpg'):asset('storage/'.$club->banner)}}" alt="Images">
                @if(Auth::check())
                    @if(Auth::user()->hasPermissonClub('Quản lý trang CLB', $club->id))
                        <label for="banner" class="background_edit w-100 @error('banner') is-invalid @enderror"><span><i class='fa fa-edit'></i> Thay ảnh</span>
                            <input hidden="" wire:model="banner" type="file" id="banner" accept="image/jpeg,image/png,image/jpg">
                        </label>

                        @if ($banner)
                            @if (Str::startsWith($banner->getMimeType(), 'image/'))
                                <div class="background_result">
                                    <div class="file-uploaded">
                                        <img src="{{ $banner->temporaryUrl() }}" alt="Preview file" style="max-height: 230px">
                                    </div>
                                    <div class="remove-thumbnail" wire:click="removeBanner">X</div>
                                    <button wire:click="updateBanner" class="btn btn-default btn-icon mt-3 change_banner">
                                        <span>Lưu</span>
                                    </button>
                                </div>
                            @endif
                        @endif
                    @endif
                @endif
            </div>
            <div wire:loading wire:target="banner" class="mt-3" style="margin-left: 15px; color: var(--color-vnua); font-size: 16px; font-weight: 500" >
                Đang tải lên...
            </div>
            <div wire:loading wire:target="banner">
                <button type="button" class="btn-default btn-small mt-3" x-on:click="$wire.cancelUpload('banner')" style="padding:0 10px ; height: 30px; line-height: 27px">Hủy</button>
            </div>
        </div>
    </div>
    <div class="row row--15">
        <div class="col-12">
            <div class="rainbow-team team-style-default">
                <div class="inner">
{{--                    <div class="d-flex">--}}
                        <div>
                            <div class="thumbnailAv avatar">
                                <img src="{{asset('storage/'.$club->thumbnail)}}" alt="Corporate Template">
                                @if(Auth::check())
                                    @if(Auth::user()->hasPermissonClub('Quản lý trang CLB', $club->id))
                                        <label for="logo" class="avatar-change w-100"><span><i class='fa fa-edit'></i> Thay logo</span>
                                            <input hidden="" wire:model="thumbnail" type="file" id="logo" accept="image/jpeg,image/png,image/jpg">
                                        </label>
                                    @endif
                                    @if ($thumbnail)
                                        @if (Str::startsWith($thumbnail->getMimeType(), 'image/'))
                                            <div class="logo_result">
                                                <div class="file-uploaded">
                                                    <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview file" style="max-height: 230px">
                                                </div>
                                                <div class="remove-thumbnail" wire:click="removeThumbnail">X</div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>

                        </div>
                        <div class="content">
                            <h2 class="title">{{$club->name}} </h2>
                            <div class="description">{{$club->slogan}}</div>
                            <div class="description">
                                <span class="count-like me-4">{{$club->likes_count}} lượt thích</span>
                                <span>{{$club->followers_count}} lượt theo dõi</span>
                            </div>
                            <div wire:loading wire:target="thumbnail" class="mt-3" style="margin-left: 15px; color: var(--color-vnua); font-size: 16px; font-weight: 500" >
                                Đang tải lên...
                            </div>
                            <div wire:loading wire:target="thumbnail">
                                <button type="button" class="btn-default btn-small mt-3" x-on:click="$wire.cancelUpload('thumbnail')" style="padding:0 10px ; height: 30px; line-height: 27px">Hủy</button>
                            </div>
                            @if ($thumbnail)
                                <button wire:click="updateThumbnail" class="btn btn-default btn-icon me-3 change_logo">
                                    <span>Lưu logo</span>
                                </button>
                            @endif
                        </div>
{{--                    </div>--}}
                    <div class="count-famous">
                        <button class="btn btn-default btn-icon me-3" wire:click="handleLike">
                            <span>@if($liked) Đã thích @else Thích @endif
                                <span class="icon">
                                    <i class="fa fa-thumbs-o-up"></i>
                                    </span>
                                </span>
                        </button>
                        <button class="btn btn-default btn-icon ms-3" wire:click="handleFollow">
                            <span> @if($followed) Đang theo dõi @else Theo dõi @endif
                                <span class="icon">
                                        @if($followed) <i class='fa fa-bell'></i> @else <i class='fa fa-user-plus'></i> @endif
                                    </span>
                                </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
