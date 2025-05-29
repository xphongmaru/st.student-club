<?php

namespace App\Livewire\Admin\Clubs\CategoryPosts;

use Livewire\Component;
use App\Models\CategoryPost;
use Livewire\WithPagination;

class Index extends Component
{

    protected $listeners = [
        'deleteCategoryPost' =>'deleteCategoryPost'
    ];
    use WithPagination;
    public $club_id;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $id;

    public function render()
    {
        $categoryPosts = CategoryPost::query()
            ->where('club_id', $this->club_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('livewire.admin.clubs.category-posts.index',[
            'categoryPosts' => $categoryPosts,
        ]);
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function openDeleteModel($id)
    {
        $this->id = $id;
        $this->dispatch('openModel', type:'warning', title: 'Xoá danh mục bài viết', text: 'Bạn có chắc chắn muốn xoá danh mục này không?', confirmEvent: 'deleteCategoryPost');
    }

    public function deleteCategoryPost(){
        $categoryPost = CategoryPost::find($this->id);
        if($categoryPost->posts()->count() > 0){
            $this->dispatch('flashMessage', type: 'error', message:'Danh mục bài viết này đang có bài viết, không thể xoá.');
            return;
        }
        if ($categoryPost) {
            $categoryPost->delete();
            $this->dispatch('flashMessage', type: 'success', message: 'Danh mục bài viết đã được xoá thành công.');
        } else {
            $this->dispatch('flashMessage', type: 'error', title: 'Xoá thất bại', text: 'Danh mục bài viết không tồn tại.');
        }
        $this->reset('id');

    }
}
