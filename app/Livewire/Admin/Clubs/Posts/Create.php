<?php

namespace App\Livewire\Admin\Clubs\Posts;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Club;
use App\Models\CategoryPost;
use App\Enums\StatusPost;
use Livewire\Attributes\Validate;

class Create extends Component
{
    protected $listeners = [
        'refreshCategoryPost' =>'refreshCategoryPost',
        'storeDate' => 'storeDate'
    ];

    use WithFileUploads;
    public $club_id;

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
    public $toggleAddCategoryPost = false;
    public $toggleCalender = false;

    public function render()
    {
        $categories = CategoryPost::all();
        return view('livewire.admin.clubs.posts.create',[
            'categories' => $categories,
        ]);
    }
    public function mount($club_id){
        $this->status = StatusPost::draft;
        $this->datetime = Carbon::now()->format('Y-m-d H:i:s');
    }

    public function store(){
        if(Auth::user()->hasPermissonClub('Quản lý bài viết', $this->club_id) == true){
            $this->status = StatusPost::published;
        }
        elseif (Auth::user()->hasPermissonClub('Tạo bài viết mới', $this->club_id) == true){
            $this->status = StatusPost::pending;
        }
        else{
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn không có quyền tạo bài viết');
            return;
        }
        $this->validate();
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->club_id = $this->club_id;
        $post->category_post_id = $this->category;
        $post->status = $this->status;
        $post->sort_content = $this->sort_content;
        $post->user_id = auth()->user()->id;
        $post->slug = str($this->title)->slug();
        $post->publicDate = Carbon::now()->format('Y-m-d H:i:s');
        if($this->thumbnail){
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->save();
        if($this->status == StatusPost::published){
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
        session()->flash('success', 'Thêm bài viết thành công.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
    }

    public function storeDraft(){
        $this->status = StatusPost::draft;
        $this->validate();
        $post = new Post();
        if($this->title==null){
            $post->title = 'Bản nháp ngày '. Carbon::now()->format('d-m-Y H:i:s');
            $post->slug = null;
        }else{
            $post->title = $this->title;
            $post->slug = str($this->title)->slug();
        }
        $post->content = $this->content;
        $post->club_id = $this->club_id;
        $post->category_post_id = $this->category;
        $post->status = $this->status;
        $post->sort_content = $this->sort_content;
        $post->user_id = auth()->user()->id;
        $post->publicDate = null;
        if($this->thumbnail){
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->save();
        session()->flash('success', 'Lưu bản nháp thành công');
        return redirect()->route('admin.club.post-index',['id'=>$this->club_id]);
    }
    public function storeDate($date)
    {
        $this->validate([
            'title' => 'required|string|max:255|unique:posts,title',
            'content' => 'required|string',
            'thumbnail' => 'image|max:2048',
            'category' => 'required|exists:category_posts,id',
            'status' => 'required',
            'sort_content' => 'required|string|max:500',
        ]);
        $this->validate([
            'datetime' => 'required|date',
        ]);
        $this->datetime = $date;
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->club_id = $this->club_id;
        $post->category_post_id = $this->category;
        $post->sort_content = $this->sort_content;
        $post->status = StatusPost::scheduled;
        $post->user_id = auth()->user()->id;
        $post->slug = str($this->title)->slug();
        $post->publicDate = $this->datetime;
        if($this->thumbnail){
            $path = $this->thumbnail->store('Clubs/Posts', 'public');
            $post->thumbnail = $path;
        }
        $post->save();
        $club = Club::query()->where('id', $this->club_id)->first();
        $club->posts_count++;
        $club->save();

        session()->flash('success', 'Lên lịch đăng bài viết thành công.');
        return redirect()->route('admin.club.post-index', ['id' => $this->club_id]);
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

    protected function rules(){
        if($this->status == StatusPost::draft){
            return [
                'title' => 'nullable|string|max:255|unique:posts,title',
                'content' => 'nullable|string',
                'thumbnail' => 'nullable|image|max:2048',
                'category' => 'nullable|exists:category_posts,id',
                'status' => 'nullable',
                'sort_content' => 'nullable'
            ];
        }
        return [
            'title' => 'required|string|max:255|unique:posts,title',
            'content' => 'required|string',
            'thumbnail' => 'image|max:2048',
            'category' => 'required|exists:category_posts,id',
            'status' => 'required',
            'sort_content' => 'required|string|max:500',
        ];
    }
}
