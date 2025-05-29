<?php

namespace App\Livewire\Admin\Clubs\CategoryPosts;

use Livewire\Component;
use App\Models\CategoryPost;
use Livewire\Attributes\Validate;

class Create extends Component
{
    public $club_id;

    #[Validate(as: 'tên danh mục')]
    public $name;

    public function render()
    {
        return view('livewire.admin.clubs.category-posts.create');
    }

    public function store()
    {
        $this->validate();
        CategoryPost::create([
            'club_id' => $this->club_id,
            'name' => $this->name,
        ]);
        session()->flash('success', 'Tạo danh mục bài viết thành công');
        return redirect()->route('admin.club.category-post.index',['id'=>$this->club_id]);
    }

    public function rules(): array{
        return [
            'name' => 'required|string|max:255|unique:category_posts,name,' . $this->club_id,
        ];
    }
}
