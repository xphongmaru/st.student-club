<?php

namespace App\Livewire\Admin\Clubs\Notifications;

use App\Models\Club;
use App\Models\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    protected $listeners = ['updateMultiselect' => 'setSelectedOptions'];

    public $club_id;
    public $notification_id;


    #[Validate(as:'Nội dung thông báo')]
    public $content='';

    #[Validate(as:'Tiêu đề thông báo')]
    public $title;

    #[Validate(as:'các tệp đính kèm')]
    public $attachments = [];

    public $oldAttachments = [];
    public $deletedAttachmentIds = [];

    public $selectUser=[];
    public $newSelectUser=[];


    public function render()
    {
        $club = Club::query()->where('id', $this->club_id)->first();
        $roles = $club->roleClubs;
        return view('livewire.admin.clubs.notifications.edit',[
            'club' => $club,
            'roles' => $roles,
        ]);
    }

    public function mount(){
        $notification = Notification::query()->where('id', $this->notification_id)->first();
        if ($notification) {
            $this->club_id = $notification->club_id;
            $this->title = $notification->title;
            $this->content = $notification->content;
            $this->selectUser = $notification->notificationUsers->pluck('id')->toArray();
            $this->newSelectUser = $this->selectUser; // Khởi tạo với người dùng đã chọn
            $this->oldAttachments = $notification->attachments->map(function ($attachment) {
                return [
                    'path' => $attachment->path,
                    'name' => $attachment->name,
                    'id' => $attachment->id,
                ];
            })->toArray();

        } else {
            session()->flash('error', 'Thông báo không tồn tại.');
            return redirect()->route('admin.club.notification-index', ['id' => $this->club_id]);
        }

    }

    public function update()
    {
        $this->validate();
        if (empty($this->newSelectUser)) {
            $this->dispatch('flashMessage', type: 'warning', message: 'Vui lòng chọn ít nhất một người dùng để gửi thông báo.');
            return;
        }
        $club = Club::query()->where('id',$this->club_id);
        $notification = Notification::query()->where('id', $this->notification_id)->first();
        $notification->title = $this->title;
        $notification->content = $this->content;
        $notification->save();

        // XÓA các tệp đính kèm cũ đã bị loại bỏ
        foreach ($this->deletedAttachmentIds as $id) {
            $attachment = $notification->attachments()->where('id', $id)->first();
            if ($attachment) {
                Storage::disk('public')->delete($attachment->path); // Xóa file vật lý
                $attachment->delete(); // Xóa khỏi DB
            }
        }

        // LƯU các tệp đính kèm mới
        foreach ($this->attachments as $file) {
            $path = $file->store('notifications', 'public');
            $notification->attachments()->create([
                'path' => $path,
                'name' => $file->getClientOriginalName(),
            ]);
        }

        // Cập nhật người dùng nhận thông báo
        $notification->notificationUsers()->sync($this->newSelectUser, [
            'is_read' => false,
        ]);

        session()->flash('success', 'Chỉnh sửa thông báo thành công!');
        return redirect()->route('admin.club.notification-index', ['id' => $this->club_id]);

    }

    public function setSelectedOptions(...$selected)
    {
        $this->newSelectUser = $selected;
    }

    protected function rules()
    {
        $existingCount = count($this->oldAttachments ?? []);

        $remainingSlots = max(0, 4 - $existingCount);
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachments' => ['array', 'max:' . $remainingSlots, 'nullable'],
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

    public function removeAttachment($id)
    {
        unset($this->attachments[$id]);
        $this->attachments = array_values($this->attachments);

    }

    public function removeOldAttachment($id)
    {
        // Xóa khỏi danh sách hiển thị
        $this->oldAttachments = array_filter($this->oldAttachments, function ($attachment) use ($id) {
            return $attachment['id'] != $id;
        });

        // Ghi nhớ ID để xóa sau
        $this->deletedAttachmentIds[] = $id;
    }
}
