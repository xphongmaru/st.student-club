<?php

namespace App\Livewire\Admin\Clubs\Notifications;

use App\Models\Club;
use App\Models\Notification;
use Livewire\Component;
use Livewire\Attributes\Validate;
use function PHPUnit\Framework\isEmpty;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    protected $listeners = ['updateMultiselect' => 'setSelectedOptions'];

    public $club_id;

    #[Validate(as:'nội dung thông báo')]
    public $content='';

    #[Validate(as:'tiêu đề thông báo')]
    public $title;

    #[Validate(as:'các tệp đính kèm')]
    public $attachments = [];

    public $selectUser=[];

    public function render()
    {
        $club = Club::query()->where('id', $this->club_id)->first();
        $roles = $club->roleClubs;

        return view('livewire.admin.clubs.notifications.create',[
            'club' => $club,
            'roles' => $roles,
        ]);
    }

    public function store()
    {
        $this->validate();

        if(empty($this->selectUser)){
            $this->dispatch('flashMessage', type:'warning', message:'Vui lòng chọn ít nhất một người dùng để gửi thông báo.');
            return;
        }


        $club = Club::query()->where('id',$this->club_id);

        $notification = new Notification();
        $notification->club_id = $this->club_id;
        $notification->title = $this->title;
        $notification->content = $this->content;
        $notification->sender_id = auth()->user()->id;
        $notification->type = 'new_notification_club';
        $notification->save();
        $notification->url = route('client.notification-detail', ['notification_id' => $notification->id]);
        $notification->save();

        // Lưu file đính kèm
        foreach ($this->attachments as $file) {
            $path = $file->store('notifications', 'public');

            // Nếu bạn có bảng notification_attachments
            $notification->attachments()->create([
                'path' => $path,
                'name' => $file->getClientOriginalName(),
            ]);
        }

        //gửi thông báo đến tất cả người dùng
        foreach ($this->selectUser as $item) {
            $notification->notificationUsers()->attach($item, [
                'is_read' => false,
            ]);
        }
        session()->flash('success', 'Thông báo đã được gửi thành công!');
        return redirect()->route('admin.club.notification-index', ['id' => $this->club_id]);


    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255|unique:notifications,title',
            'content' => 'required|string',
            'attachments' => 'array|max:4|nullable',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,txt|max:5120',
        ];
    }

    protected function messages()
    {
        return [
            'title.required' => 'Tiêu đề thông báo là bắt buộc.',
            'title.string' => 'Tiêu đề thông báo phải là một chuỗi.',
            'title.max' => 'Tiêu đề thông báo không được vượt quá 255 ký tự.',
            'title.unique' => 'Tiêu đề thông báo đã tồn tại.',
            'content.required' => 'Nội dung thông báo là bắt buộc.',
            'content.string' => 'Nội dung thông báo phải là một chuỗi.',
            'attachments.array' => 'Các tệp đính kèm phải là một mảng.',
            'attachments.max' => 'Bạn chỉ có thể đính kèm tối đa 4 tệp.',
            'attachments.*.file' => 'Mỗi tệp đính kèm phải là một tệp hợp lệ.',
            'attachments.*.mimes' => 'Các tệp đính kèm phải có định dạng jpg, jpeg, png, pdf, doc, docx, xls, xlsx hoặc txt.',
            'attachments.*.max' => 'Mỗi tệp đính kèm không được vượt quá 5MB.',
        ];

    }

    public function setSelectedOptions(...$selected)
    {
        $this->selectUser = $selected;
    }

    public function removeAttachment($id)
    {
        unset($this->attachments[$id]);
        $this->attachments = array_values($this->attachments);

    }
}
