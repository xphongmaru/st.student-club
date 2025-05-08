<?php

namespace App\Livewire\Client\Index;

use Livewire\Component;
use \App\Models\Faculty;
use App\Models\Club;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use App\Models\RequestMemberClub;
use App\Enums\StatusRequestClub;

class FormJoinClub extends Component
{
    public $user;
    public $clubs;

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
    #[Validate(as:'Câu lạc bộ')]
    public $club_id;

    #[Validate(as:'Điểm mạnh và điểm yếu')]
    public $advantage_and_disadvantage;
    #[Validate(as:'Lý do tham gia CLB')]
    public $reason;

    public function render()
    {
        return view('livewire.client.index.form-join-club',[
            'faculties' => $this->faculties,
            'clubs' => $this->clubs,

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

        $this->clubs = Club::whereHas('recruitmentClubs', function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now());
        })->get();
    }

    public function submit(){
        $this->validate();
        $club = Club::find($this->club_id);

        if($this->user == null){
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng đăng nhập để tham gia câu lạc bộ.');
            return;
        }
        if($this->user->isMemberOfClub($club->id)){
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn đã là thành viên của câu lạc bộ này.');
            return;
        }

        $hasRequest = RequestMemberClub::query()->where('club_id', $club->id)->where('user_id',$this->user->id)->exists();

        if($hasRequest){
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn đã gửi yêu cầu tham gia câu lạc bộ này.');
            return;
        }

        if(($this->faculty_id == 0 || $this->faculty_id == null) && ($this->club_id == 0 || $this->club_id == null)){
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng chọn chọn câu lạc bộ tham gia và khoa.');
            return;
        }
        elseif($this->faculty_id == 0 || $this->faculty_id == null){
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng chọn chọn khoa.');
            return;
        }
        elseif($this->club_id == 0 || $this->club_id == null){
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng chọn chọn câu lạc bộ tham gia.');
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

        $recruitment = $club->recruitmentClubs()->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())->first();
        RequestMemberClub::create([
            'recruitment_club_id'=>$recruitment->id,
            'club_id'=>$club->id,
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
        $this->reset([ 'email', 'phone', 'class_name', 'faculty_id', 'advantage_and_disadvantage', 'reason']);
        $this->dispatch('closeModal');
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
        ];
    }



}
