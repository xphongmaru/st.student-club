<div class="modal-content">
    <div class="logo-mini">
        <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
    </div>
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Đăng ký tham gia Câu lạc bộ </h5>
        <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
    </div>
    <div class="quick-veiw-area">
        <div class="px-5 pt-3 pb-5">
            @if(!Auth()->check())
                <div class="alert alert-danger" role="alert">
                    Bạn cần đăng nhập để đăng ký tham gia câu lạc bộ
                </div>
            @endif
            <form class="contact-form-1 rainbow-dynamic-form" wire:submit.prevent="submit" >
                <div class="form-group" wire:ignore>
                    <label class="mb-2"> Tên câu lạc bộ: <span>*</span></label>
                    <select wire:model="club_id" name="club_id" id="selectCLB" class="select2" onchange="@this.set('club_id', this.value)">
                        <option class="placeholder" value="0">Chọn 1 câu lạc bộ</option>
                        @foreach($clubs as $club)
                            <option value="{{$club->id}}">{{$club->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-2">Họ và tên: <span>*</span> </label>
                    <input type="text" wire:model.live="name" readonly name="fullName" placeholder="Nhập vào họ và tên" class="@error('name') is-invalid @enderror">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="mb-2"> Mã sinh viên: <span>*</span></label>
                    <input type="text" wire:model.live="code" readonly placeholder="Nhập vào mã sinh viên" class="@error('code') is-invalid @enderror">
                    @if ($errors->has('code'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    @endif
                </div>
                <div class="form-group d-flex">
                    <label class="mb-2 me-3" style="line-height: 50px"> Giới tính: <span>*</span></label>
                    <div class="radio-inputs">
                        <label class="me-3">
                            <input class="radio-input" type="radio" name="gender" wire:model.live="gender" value="Nam">
                            <span class="radio-tile">
                                            <span class="radio-icon">
                                            <svg viewBox="0 0 100000 100000" text-rendering="geometricPrecision" shape-rendering="geometricPrecision" image-rendering="optimizeQuality" clip-rule="evenodd" fill-rule="evenodd" class="h-8 w-8 fill-current peer-checked:fill-blue-500" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M35927 32903c412,2646 927,5119 1312,6767 -1320,-1159 -6849,-6682 -6569,-1799 342,5954 5284,6851 5297,6853l826 176 0 841c0,18 -115,6164 5054,8983 2585,1411 5371,2117 8155,2117 2783,0 5567,-706 8152,-2117 5169,-2819 5054,-8965 5054,-8983l0 -841 826 -176c13,-2 4955,-899 5297,-6853 273,-4760 -5035,428 -6400,1585 466,-2425 1265,-6640 1627,-10534 -707,-1139 -1761,-2058 -3310,-2445 -5841,-1459 -12802,2359 -14487,-898 -1685,-3256 -4043,-5728 -4043,-5728 0,0 -1461,5389 -4266,7749 -1302,1095 -2073,3278 -2525,5303zm7891 26143c0,0 -2213,3386 -2734,5600 -521,2213 -16015,783 -16407,9375 -392,8593 -391,16666 -391,16666l51429 0c0,0 1,-8073 -391,-16666 -392,-8592 -15886,-7162 -16407,-9375 -520,-2214 -2734,-5600 -2734,-5600 89,59 -103,-469 -339,-1065 1123,-370 2228,-847 3303,-1433 5035,-2746 5946,-8013 6109,-10011 1747,-593 5810,-2604 6152,-8552 329,-5738 -2626,-5167 -4942,-3884 588,-3342 1229,-9312 59,-16047 -1797,-10330 -8310,-7860 -13363,-8645 -5054,-786 -11791,3480 -11791,3480 0,0 -6064,-785 -8872,4717 -1830,3589 -79,10904 1361,15557l178 1232c-2363,-1457 -5799,-2573 -5444,3590 341,5948 4404,7959 6151,8552 163,1998 1075,7265 6110,10011 1074,586 2179,1063 3302,1433 -236,596 -428,1124 -339,1065zm11413 -875c37,1566 129,3813 367,5042 391,2019 -326,4297 -326,4297l-5271 5389 -5272 -5389c0,0 -717,-2278 -326,-4297 238,-1229 330,-3475 367,-5042 1719,502 3476,753 5232,753 1755,0 3511,-251 5229,-753z"></path>
                                            </svg>
                                            </span>
                                        <span class="radio-label">Nam</span>
                                        </span>
                        </label>
                        <label>
                            <input class="radio-input" type="radio" name="gender" wire:model.live="gender" value="Nữ">
                            <span class="radio-tile">
                                                <span class="radio-icon">
                                                    <svg id="female" viewBox="0 0 128 128" class="h-7 w-6 fill-gray-100" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M64,72.7c0,0,0-0.1,0-0.1c0,0,0,0,0,0V72.7z" fill="#000"></path>
                                                      <path d="M54.6 49.2c.7 0 1.4-.3 1.9-.8.5-.5.8-1.2.8-1.9s-.3-1.4-.8-1.9c-.5-.5-1.2-.8-1.9-.8-.7 0-1.4.3-1.9.8-.5.5-.8 1.2-.8 1.9 0 .7.3 1.4.8 1.9C53.2 48.9 53.9 49.2 54.6 49.2zM73.8 49.2c.7 0 1.4-.3 1.9-.8.5-.5.8-1.2.8-1.9s-.3-1.4-.8-1.9c-.5-.5-1.2-.8-1.9-.8s-1.4.3-1.9.8c-.5.5-.8 1.2-.8 1.9s.3 1.4.8 1.9C72.5 48.9 73.1 49.2 73.8 49.2z" fill="#000"></path>
                                                      <path d="M40.6 78.1h10.7V67.1c3.7 2.4 8.1 3.7 12.5 3.7v0c0 0 .1 0 .1 0 0 0 .1 0 .1 0v0c4.4 0 8.8-1.3 12.5-3.7v11.1h10.7c.2 0 .4 0 .6 0h8.3V34.4c0-17.8-14.4-32.2-32.1-32.3v0c0 0-.1 0-.1 0 0 0-.1 0-.1 0v0C46.2 2.2 31.8 16.7 31.8 34.4v43.7H40C40.2 78.1 40.4 78.1 40.6 78.1zM44 38.1c0-3.2 2.6-5.8 5.8-5.8h14.1.2 14.1c3.2 0 5.8 2.6 5.8 5.8v9.1c0 4.5-1.5 8.6-4 12-1 1.3-2.2 2.6-3.4 3.6-3.4 2.8-7.8 4.5-12.6 4.5-4.8 0-9.2-1.7-12.6-4.5-1.3-1.1-2.5-2.3-3.4-3.6-2.5-3.4-4-7.5-4-12V38.1zM116.8 123.3c-.9-5.2-3-16.3-3.5-17.8-2.3-7-8.2-10.4-14.5-13-.8-.3-1.6-.7-2.4-1-5.5-2.1-11-4.3-16.5-6.4-2.6 6.2-8.8 10.5-15.9 10.5s-13.3-4.3-15.9-10.5c-5.5 2.1-11 4.3-16.5 6.4-.8.3-1.6.6-2.4 1-6.3 2.6-12.1 6-14.5 13-.5 1.4-2.5 12.6-3.5 17.8-.2 1 .3 1.9 1.1 2.3.3.2.7.3 1.1.3h101.1c.4 0 .8-.1 1.1-.3C116.5 125.1 116.9 124.2 116.8 123.3z" class="fill-current"></path>
                                                    </svg>
                                                </span>
                                                <span class="radio-label">Nữ</span>
                                            </span>
                        </label>
                    </div>
                </div>
                <div class="form-group" wire:ignore>
                    <label class="mb-2"> Tên khoa: <span>*</span></label>
                    <select wire:model="faculty_id" name="faculty_id" id="selectKhoa" class="select2" onchange="@this.set('faculty_id', this.value)">
                        <option class="placeholder" selected value="0">Chọn một khoa</option>
                        @foreach($faculties as $faculty)
                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('faculty_id'))
                        <span class="text-danger">{{ $errors->first('faculty_id') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="mb-2"> Tên lớp: <span>*</span></label>
                    <input type="text" wire:model.live="class_name" placeholder="Nhập vào tên lớp" class="@error('class_name') is-invalid @enderror">
                    @if ($errors->has('class_name'))
                        <span class="text-danger">{{ $errors->first('class_name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="mb-2">Số điện thoại: <span>*</span></label>
                    <input type="text" wire:model.live="phone" placeholder="Nhập vào số điện thoại" class="@error('phone') is-invalid @enderror">
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="mb-2">Email: <span>*</span></label>
                    <input type="text" wire:model.live="email" placeholder="Nhập vào email" class="@error('email') is-invalid @enderror">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Điểm mạnh và điểm yếu: <span>*</span></label>
                    <textarea wire:model.live="advantage_and_disadvantage" placeholder="Điểm mạnh và điểm yếu của bạn là gì?" class="@error('advantage_and_disadvantage') is-invalid @enderror"></textarea>
                    @if ($errors->has('advantage_and_disadvantage'))
                        <span class="text-danger">{{ $errors->first('advantage_and_disadvantage') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Mục đich tham gia CLB: <span>*</span></label>
                    <textarea wire:model.live="reason" placeholder="Mục đích tham gia câu lạc bộ của bạn là gì?" class="@error('reason') is-invalid @enderror"></textarea>
                    @if ($errors->has('reason'))
                        <span class="text-danger">{{ $errors->first('reason') }}</span>
                    @endif
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button name="submit" type="submit" id="submit" class="btn-default btn-small  rainbow-btn">
                        <span>Đăng ký tham gia</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
