<?php

namespace App\Livewire\Admin\Clubs\Posts;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Post;

class CpnCalender extends Component
{
    public $club_id;
    public $post_id;

    #[validate(as: 'Ngày đăng bài viết')]
    public $datetime;

    public function render()
    {
        return view('livewire.admin.clubs.posts.cpn-calender');
    }

    public function mount(){
        if($this->post_id != null){
            $this->datetime = Post::query()->find($this->post_id)->publicDate;
        }
        else{
            $this->datetime = now()->format('Y-m-d H:i:s');
        }
    }

    protected function rules()
    {
        return [
            'datetime' => 'required|date',
        ];
    }

    public function store(){
        $this->validate();
        $this->dispatch('storeDate', $this->datetime);
    }

    public function resetDate(){
        $this->datetime = now()->format('Y-m-d H:i:s');
    }



}
