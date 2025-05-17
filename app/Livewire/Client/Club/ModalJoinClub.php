<?php

namespace App\Livewire\Client\Club;

use App\Enums\StatusRequestClub;
use App\Models\Club;
use App\Models\Faculty;
use App\Models\RequestMemberClub;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalJoinClub extends Component
{
    public $user;
    public $club;

    #[Validate(as:'Họ và tên')]
    public $name;
    #[Validate(as:'Mã sinh viên')]
    public $code;
    #[Validate(as:'Email')]
    public $email;
    #[Validate(as:'Số điện thoại')]
    public $phone;
    #[Validate(as:'Giới tính')]
    public $gender='Nam';
    #[Validate(as:'Lớp')]

    public $class_name;

    public $faculties;
    #[Validate(as:'Khoa')]
    public $faculty_id;

    #[Validate(as:'Điểm mạnh và điểm yếu')]
    public $advantage_and_disadvantage;
    #[Validate(as:'Lý do tham gia CLB')]
    public $reason;

    #[Validate(as:'Mã bảo mật ')]
    public string $captcha = '';
    public string $captchaImage;

    public function render()
    {
        return view('livewire.client.club.modal-join-club',[
            'club' => $this->club,
            'faculties' => $this->faculties,
        ]);
    }

    public function mount()
    {
        $this->faculties = Faculty::all();
        if(auth()->check()) {
            $this->user = auth()->user();
            $this->name = $this->user->full_name;
            $this->code = $this->user->code;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone;
            $this->class_name = $this->user->class_name;
            $this->gender = $this->user->gender;
        }

        $this->generateCaptcha();
    }

    public function submit(){
        if(!Auth::check()){
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn cần đăng nhập tài khoản để đăng câu lạc bộ');
            return;
        }

        $this->validate();

        if($this->faculty_id == 0 || $this->faculty_id == null){
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng chọn chọn khoa.');
            return;
        }

        $validator = Validator::make(
            ['captcha' => $this->captcha],
            ['captcha' => 'required|captcha'],
            ['captcha.required' => 'Vui lòng nhập mã xác thực', 'captcha.captcha' => 'Mã xác thực không đúng']
        );

        if ($validator->fails()) {
            $this->addError('captcha', $validator->errors()->first('captcha'));
            $this->dispatch('flashMessage', type: 'warning', message: $validator->errors()->first('captcha'));
            $this->generateCaptcha();
            return;
        }

        if($this->user == null){
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng đăng nhập để tham gia câu lạc bộ.');
            return;
        }
        if($this->user->isMemberOfClub($this->club->id)){
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn đã là thành viên của câu lạc bộ này.');
            return;
        }

        $hasRequest = RequestMemberClub::query()->where('club_id', $this->club->id)->where('user_id',$this->user->id)->exists();

        if($hasRequest){
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn đã gửi yêu cầu tham gia câu lạc bộ này.');
            return;
        }


        if($this->user->phone==null){
            $this->user->phone = $this->phone;
        }
        if($this->user->class_name==null){
            $this->user->class_name = $this->class_name;
        }
        if($this->user->faculty_id==null){
            $this->user->faculty_id = $this->faculty_id;
        }
        if($this->user->gender == null){
            $this->user->gender = $this->gender;
        }
        $this->user->save();

        $recruitment = $this->club->recruitmentClubs()->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())->first();
        RequestMemberClub::create([
            'recruitment_club_id'=>$recruitment->id,
            'club_id'=>$this->club->id,
            'user_id'=>$this->user->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'email'=>$this->email,
            'gender'=>$this->gender,
            'phone_number'=>$this->phone,
            'class'=>$this->class_name,
            'faculty_id'=>$this->faculty_id,
            'advantage_and_disadvantage'=>$this->advantage_and_disadvantage,
            'reason'=>$this->reason,
            'status'=>StatusRequestClub::Pending,
        ]);

        $this->dispatch('flashMessage', type: 'success', message: 'Gửi yêu cầu tham gia câu lạc bộ thành công.');
        $this->reset([ 'email', 'phone', 'class_name', 'faculty_id', 'advantage_and_disadvantage', 'reason', 'captcha']);
        $this->generateCaptcha();
        $this->dispatch('closeModal');
    }

    public function generateCaptcha(): void
    {
        $this->captchaImage = captcha_src('numeric') . '?' . rand();
    }

    protected function rules(){
        return [
            'name'=> 'required|string|max:255',
            'code'=> 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'phone' => 'required|regex:/^0[0-9]{9,14}$/',
            'class_name'=> 'required|string|max:255',
            'advantage_and_disadvantage'=> 'required|string|max:1500',
            'reason'=> 'required|string|max:1500',
//            'faculty_id'=> 'required|exists:faculties,id',
//            'club_id'=> 'required|exists:clubs,id',
            'captcha' => 'required',
            'gender' => 'required|in:Nam,Nữ',
        ];
    }
}
