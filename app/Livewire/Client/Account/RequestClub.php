<?php

namespace App\Livewire\Client\Account;

use Livewire\Component;
use App\Models\RequestClub as RequestClubModel;
use App\Enums\StatusRequestClub;

class RequestClub extends Component
{
    public function render()
    {
        $requestClubs = RequestClubModel::query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        return view('livewire.client.account.request-club',[
            'requestClubs' => $requestClubs,
        ]);
    }

    public function CancelRequest($id){
        $requestClub = RequestClubModel::query()->where('id', $id)->first();
        if($requestClub == null){
            $this->dispatch('flashMessage',type:'warning', message: 'Yêu cầu không tồn tại');
            return;
        }

        if($requestClub->status == StatusRequestClub::Cancelled->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Yêu cầu đã được hủy trước đó');
            return;
        }

        if($requestClub->status == StatusRequestClub::Approved->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Yêu cầu đã được duyệt trước đó');
            return;
        }


        if($requestClub->status != StatusRequestClub::Pending->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Yêu cầu đã được xử lý bạn không thể hủy');
            return;
        }

        $requestClub->status = StatusRequestClub::Cancelled->value ;
        $requestClub->save();
        $this->dispatch('flashMessage',type:'success', message: 'Đã hủy yêu cầu tham gia câu lạc bộ');
    }
}
