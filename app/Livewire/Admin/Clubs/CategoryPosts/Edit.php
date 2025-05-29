<?php

namespace App\Livewire\Admin\Clubs\CategoryPosts;

use Livewire\Component;
use App\Models\CategoryPost;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    #[Validate(as: 'tên danh mục')]
    public $name;

    public $club_id;
    public $category_id;

    public function render()
    {
        return view('livewire.admin.clubs.category-posts.edit');
    }

    public function update()
    {
        $this->validate();
        $category = CategoryPost::findOrFail($this->category_id);
        $category->update([
            'name' => $this->name,
        ]);
        session()->flash('success', 'Cập nhật danh mục bài viết thành công');
        return redirect()->route('admin.club.category-post.index', ['id' => $this->club_id]);
    }

    public function mount(){
        $category= CategoryPost::findOrFail($this->category_id);
        $this->name=$category->name;
    }

    public function rules(): array{
        return [
            'name' => 'required|string|max:255|unique:category_posts,name,' . $this->category_id,
        ];
    }

}
