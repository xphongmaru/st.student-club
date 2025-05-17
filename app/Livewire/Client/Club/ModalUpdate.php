<?php

namespace App\Livewire\Client\Club;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Website;

class ModalUpdate extends Component
{
    protected $listeners=[
        'removeCPNLinkWeb'=>'removeCPNLinkWeb',
        'updateCPNLinkWeb'=>'updateCPNLinkWeb'
    ];


    public $club;
    #[Validate(as: 'Slogan')]
    public $slogan;
    #[Validate(as: 'Lĩnh vực hoạt động')]
    public $field;
    #[Validate(as: 'Mô tả câu lạc bộ')]
    public $description;
    #[Validate(as: 'Địa chỉ')]
    public $address;
    #[Validate(as: 'Ngày thành lập CLB')]
    public $foundation_date;
    #[Validate(as: 'Điện thoại')]
    public $phone;
    #[Validate(as: 'Email')]
    public $email;


    public function render()
    {
        $websites= Website::query()->where('club_id',$this->club->id)->get();
        return view('livewire.client.club.modal-update',[
            'websites' => $websites,
        ]);
    }

    public function mount($club){
        $this->club = $club;
        $this->slogan = $club->slogan;
        $this->field = $club->field_of_activity;
        $this->description = $club->description;
        $this->address = $club->address;
        $this->foundation_date = $club->foundation_date;
        $this->phone = $club->phone;
        $this->email = $club->email;

        $websites= Website::query()->where('club_id',$this->club->id)->get();
        $linkId=0;
        foreach ($websites as $website){
            $this->dataLinkWeb[$website->id] = [
                'icon_id' => $website->icon_id,
                'url' => $website->url,
                'club_id' => $this->club->id,
            ];
            $this->components[]=$website->id;
            $linkId=$website->id;
        }

        $this->nextIndex= $linkId+1;

    }

    public function store(){
        $this->validate();
        $this->club->slogan = $this->slogan;
        $this->club->field_of_activity = $this->field;
        $this->club->description = $this->description;
        $this->club->address = $this->address;
        $this->club->foundation_date = $this->foundation_date;
        $this->club->phone = $this->phone;
        $this->club->email = $this->email;
        $this->club->save();

        //xoa link web
        $websites = Website::query()->where('club_id', $this->club->id)->get();
        foreach ($websites as $website) {
            if (!isset($this->dataLinkWeb[$website->id])) {
                $website->delete();
            }
        }
        if (count($this->dataLinkWeb) > 0) {
            foreach ($this->dataLinkWeb as $item) {
                Website::updateOrCreate(
                    ['club_id' => $item['club_id'], 'icon_id' => $item['icon_id']],
                    ['url' => $item['url']]
                );

            }
        }

        $this->dispatch('flashMessage', type: 'success', message: 'Cập nhật thông tin câu lạc bộ thành công');
        $this->dispatch('refreshPage');
    }


    protected function rules()
    {
        return [
            'slogan' => 'string|max:255|nullable',
            'field' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
            'address' => 'string|max:255|nullable',
            'foundation_date' => 'date|after:1900-01-01|before:today',
            'phone' => 'string|regex:/^0[0-9]{9,14}$/|nullable',
            'email' => 'email|max:255|nullable',
        ];
    }

    protected function messages(){
        return [
            'foundation_date.date' => 'Ngày thành lập không hợp lệ',
            'foundation_date.after' => 'Ngày thành lập không hợp lệ',
            'foundation_date.before' => 'Ngày thành lập phải là ngày trong quá khứ',
        ];
    }

    public array $components = [];
    public int $nextIndex = 0;
    public $dataLinkWeb = [];

    public function addComponent()
    {
        $this->components[] = $this->nextIndex;
        $this->nextIndex++;
    }

    public function removeCPNLinkWeb($id)
    {
        $this->components = array_filter($this->components, fn($item) => $item !== $id);
        unset($this->dataLinkWeb[$id]);
    }

    public function updateCPNLinkWeb($data)
    {
        $this->dataLinkWeb[$data['id']] = [
            'icon_id' => $data['icon_id'],
            'url' => $data['url'],
            'club_id' => $this->club->id,
        ];
    }
}
