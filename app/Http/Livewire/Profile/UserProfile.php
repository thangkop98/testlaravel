<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
class UserProfile extends Component
{
    use WithFileUploads;
    public $name,$email,$phone,$gender,$avatar,$user_id,$oldAvatar;
    
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->oldAvatar = $user->avatar;
    }
    public function render()
    {
        return view('livewire.profile.user-profile');
    }

    public function save()
    {
        $this->user_id = Auth::user()->id;
        
        // dd($this->oldAvatar,$this->avatar);
        User::where('id',$this->user_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'avatar' => $this->avatar ? $this->avatar->store('public') : $this->oldAvatar
        ]);

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=> 'Cập nhật profile thành công'
        ]);
    }
}
