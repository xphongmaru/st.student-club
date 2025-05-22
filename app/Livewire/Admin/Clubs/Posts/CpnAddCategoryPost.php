<?php

namespace App\Livewire\Admin\Clubs\Posts;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\CategoryPost;

class CpnAddCategoryPost extends Component
{
    public $club_id;
    #[Validate(as: 'Tên danh mục bài viết')]
    public $newCategory;

    public function render()
    {
        return view('livewire.admin.clubs.posts.cpn-add-category-post');
    }

    public function store(){
        $this->validate();
        $category = new CategoryPost();
        $category->name = $this->newCategory;
        $category->club_id = $this->club_id;
        $category->save();

        $this->dispatch('flashMessage', type: 'success', message: 'Thêm danh mục bài viết thành công');
        $this->dispatch('refreshCategoryPost');
        $this->reset();
    }

    protected function rules()
    {
        return [
            'newCategory' => 'required|string|max:255|unique:category_posts,name',
        ];
    }
}
