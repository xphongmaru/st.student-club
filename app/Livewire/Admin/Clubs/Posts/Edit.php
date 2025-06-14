<?php

namespace App\Livewire\Admin\Clubs\Posts;

use App\Models\CategoryPost;
use App\Models\Club;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post;
use App\Enums\StatusPost;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'refreshCategoryPost' =>'refreshCategoryPost',
        'storeDate' => 'storeDate',
        'resendInvite' =>'resendInvite'
    ];

    public $club_id;
    public $post_id;

    #[Validate(as: 'nội dung bài viết')]
    public $content;
    #[Validate(as: 'tiêu đề bài viết')]
    public $title;
    #[Validate(as: 'ảnh đại diện bài viết')]
    public $thumbnail;
    #[Validate(as: 'danh mục bài viết')]
    public $category;
    #[Validate(as: 'trạng thái bài viết')]
    public $status;
    #[Validate(as: 'ngày đăng bài viết')]
    public $datetime;
    #[Validate(as: 'nội dung ngắn')]
    public $sort_content;
    public $oldThumbnail;
    public $oldThumbnail_2;
    public $oldStatus;

    public $toggleAddCategoryPost = false;

    public function render()
    {
        $categories = CategoryPost::all();
        return view('livewire.admin.clubs.posts.edit',[
            'categories' => $categories,
        ]);
    }

    public function mount()
    {
        $post= Post::find($this->post_id);
        $this->title = $post->title;
        $this->content = $post->content;
        $this->oldThumbnail = $post->thumbnail;
        $this->category = $post->category_post_id;
        $this->status = $post->status;
        $this->oldStatus = $post->status;
        $this->datetime = $post->datetime;
        $this->club_id = $post->club_id;
        $this->sort_content = $post->sort_content;
    }

    public function updatedThumbnail()
    {

        $this->oldThumbnail_2= $this->oldThumbnail;
        $this->oldThumbnail = 1;

    }

    public function ShowAddCategoryPost(){
        if($this->toggleAddCategoryPost){
            $this->toggleAddCategoryPost = false;
        }else{
            $this->toggleAddCategoryPost = true;
        }
    }

    public function refreshCategoryPost(){
        $this->toggleAddCategoryPost = false;
    }

    public function updateDraft(){
        if($this->oldStatus!= StatusPost::draft->name){
            $this->dispatch('flashMessage', type: 'warning', message: 'Không thể lưu bản nháp khi bài viết đã được xuất bản.');
            return;
        }
        $this->validate([
            'title' => 'nullable|string|max:255|unique:posts,title,'.$this->post_id,
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
            'category' => 'nullable|exists:category_posts,id',
            'status' => 'nullable',
            'sort_content' => 'nullable|string|max:500',
        ]);
        $post = Post::find($this->post_id);
        if($this->title==null){
            $post->title = 'Bản nháp ngày '. Carbon::now()->format('d-m-Y H:i:s');
            $post->slug = null;
        }else{
            $post->title = $this->title;
            $post->slug = str($this->title)->slug();
        }
        $post->content = $this->content;
        $post->sort_content = $this->sort_content;
        $post->category_post_id = $this->category;
        if($this->thumbnail){
            if($this->oldThumbnail==1){
                $oldImagePath = public_path('storage/' . $this->oldThumbnail_2);
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->save();
        session()->flash('success', 'Lưu bản nháp thành công');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function update()
    {
        $this->status = StatusPost::published;
        $this->validate();
        $post = Post::query()->find($this->post_id);
        $post->title = $this->title;
        $post->slug = str($this->title)->slug();
        $post->content = $this->content;
        $post->sort_content = $this->sort_content;
        $post->category_post_id = $this->category;
        if($this->thumbnail){
            if($this->oldThumbnail==1){
                $oldImagePath = public_path('storage/' . $this->oldThumbnail_2);
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->status = $this->status;
        if($this->oldStatus!=StatusPost::published->name){
            $post->publicDate = Carbon::now()->format('Y-m-d H:i:s');
        }
        else{
            $post->publicDate = $this->datetime;
        }
        $post->save();
        $mess='Cập nhật bài viết thành công.';
        if($this->oldStatus==StatusPost::draft->name || $this->oldStatus==StatusPost::pending->name || $this->oldStatus==StatusPost::scheduled->name){
            $mess = 'Đăng bài viết thành công.';
            $club = Club::query()->where('id', $this->club_id)->first();
            $club->posts_count++;
            $club->save();

            //tạo thông báo đến thành viên câu lạc bô
            $notification = Notification::query()->create([
                'title' => $club->name . ' đã có bài viết mới',
                'content' => $this->title,
                'type' => 'newPost',
                'club_id' => $this->club_id,
                'url' => route('client.club.post-detail', ['id' => $this->club_id, 'slug' => str($this->title)->slug()]),
            ]);
            $users = $club->users;
            $followers = $club->followers;

            // Hợp nhất danh sách thành viên và người theo dõi, sau đó loại bỏ trùng lặp
            $uniqueUsers = $users->merge($followers)->unique('id');
            // Tạo thông báo cho từng người dùng duy nhất

            foreach ($uniqueUsers as $user) {
                $notification->notificationUsers()->attach($user->id, [
                    'is_read' => false,
                ]);
            }
        }
        session()->flash('success', $mess);
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);

    }

    public function storeDate($date)
    {
        $this->validate();
        $this->datetime = $date;
        $this->validate([
            'datetime' => 'required|date',
        ]);
        $post = Post::query()->find($this->post_id);
        $post->title = $this->title;
        $post->slug = str($this->title)->slug();
        $post->content = $this->content;
        $post->sort_content = $this->sort_content;
        $post->category_post_id = $this->category;
        if($this->thumbnail){
            if($this->oldThumbnail==1){
                $oldImagePath = public_path('storage/' . $this->oldThumbnail_2);
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->status = StatusPost::scheduled;
        $post->publicDate = $this->datetime;

        $post->save();
        $club = Club::query()->where('id', $this->club_id)->first();
        $club->posts_count++;
        $club->save();
        session()->flash('success', 'Lên lịch bài viết thành công.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function reject()
    {
        $post = Post::find($this->post_id);
        $post->status = StatusPost::rejected;
        $post->save();
        session()->flash('success', 'Bạn đã từ chối bài viết thành công.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function privatePost()
    {
        $post = Post::find($this->post_id);
        $post->status = StatusPost::private;
        $post->save();
        $club = Club::query()->where('id', $this->club_id)->first();
        $club->posts_count--;
        $club->save();
        session()->flash('success', 'Bài viết đã được chuyển sang chế độ riêng tư.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function publicPost()
    {
        $post = Post::find($this->post_id);
        $post->status = StatusPost::published;
        $post->save();
        session()->flash('success', 'Bài viết đã được chuyển sang chế độ công khai.');
        $club = Club::query()->where('id', $this->club_id)->first();
        $club->posts_count++;
        $club->save();
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function updateNormal()
    {
        if($this->oldStatus == StatusPost::published->name){
            $this->dispatch('flashMessage', type: 'warning', message: 'Không thể lưu bản nháp khi bài viết đã được xuất bản.');
            return;
        }
        if($this->oldStatus == StatusPost::approved->name){
            $this->dispatch('openModel',type:'warning' , title:'Gửi yêu cầu duyệt lại', text: 'Bài viết của bạn đã được duyệt, bạn có muốn sửa lại không. ', confirmEvent: 'resendInvite');
            return;
        }
        if($this->oldStatus == StatusPost::scheduled->name){
            $this->dispatch('openModel',type:'warning' , title:'Gửi yêu cầu duyệt lại', text: 'Bài viết của bạn đã được lên lịch đăng, bạn có muốn sửa lại không. ', confirmEvent: 'resendInvite');
            return;
        }
        if($this->oldStatus == StatusPost::rejected->name){
            $this->dispatch('openModel',type:'warning' , title:'Gửi yêu cầu duyệt lại', text: 'Bài viết của bạn đã bị từ chối, bạn có muốn sửa lại không. ', confirmEvent: 'resendInvite');
            return;
        }
        if($this->oldStatus == StatusPost::pending->name){
            $this->dispatch('openModel',type:'warning' , title:'Gửi yêu cầu duyệt lại', text: 'Bài viết của bạn đã gửi duyệt, bạn có muốn sửa lại không. ', confirmEvent: 'resendInvite');
            return;
        }

        $this->status = StatusPost::pending;
        $this->validate([
            'title' => 'required|string|max:255|unique:posts,title,'.$this->post_id,
            'content' => 'required|string',
            'thumbnail' => 'image|max:2048',
            'category' => 'required|exists:category_posts,id',
            'status' => 'required',
            'sort_content' => 'required|string|max:500',
        ]);
        $post = Post::find($this->post_id);
        $post->title = $this->title;
        $post->slug = str($this->title)->slug();
        $post->content = $this->content;
        $post->sort_content = $this->sort_content;
        $post->category_post_id = $this->category;
        if($this->thumbnail){
            if($this->oldThumbnail==1){
                $oldImagePath = public_path('storage/' . $this->oldThumbnail_2);
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->status = $this->status;
        $post->publicDate = Carbon::now()->format('Y-m-d H:i:s');
        $post->save();
        session()->flash('success', 'Gửi duyệt bài thành công.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function resendInvite()
    {
        $this->status = StatusPost::pending;
        $this->validate();
        $post = Post::find($this->post_id);
        $post->title = $this->title;
        $post->slug = str($this->title)->slug();
        $post->content = $this->content;
        $post->category_post_id = $this->category;
        if($this->thumbnail){
            if($this->oldThumbnail==1){
                $oldImagePath = public_path('storage/' . $this->oldThumbnail_2);
                if (is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->status = $this->status;
        $post->publicDate = Carbon::now()->format('Y-m-d H:i:s');
        $post->save();
        session()->flash('success', 'Gửi duyệt bài lại thành công.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    protected function rules(){
        if($this->oldThumbnail){
            return [
                'title' => 'required|string|max:255|unique:posts,title,'.$this->post_id,
                'content' => 'required|string',
                'thumbnail' => 'nullable|image|max:2048',
                'category' => 'required|exists:category_posts,id',
                'sort_content' => 'required|string|max:500',
                'status' => 'required',
            ];
        }
        return [
            'title' => 'required|string|max:255|unique:posts,title,'.$this->post_id,
            'content' => 'required|string',
            'thumbnail' => 'image|max:2048',
            'category' => 'required|exists:category_posts,id',
            'status' => 'required',
            'sort_content' => 'required|string|max:500',
        ];
    }

}
