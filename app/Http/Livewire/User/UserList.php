<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Base\BaseLive;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class UserList extends BaseLive
{
    use WithFileUploads;

    public $searchTerm;
    public $name;
    public $email;
    public $avatar;
    public $password;
    public $confirm_password;
    public $updateMode = false;
    public $user_id;
    public $phone;
    public $gender = '0';
    public $iteration;
    public $oldAvatar;
    public $deleted_id;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['saveData'];

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'phone' => 'nullable|min:10',
        'gender' => 'nullable',
        'confirm_password'=> 'required_with:password|same:password',
        'avatar' => 'image|max:1024'
    ];

    
    public function render()
    {
        $query = User::query();
        if($this->searchTerm)
        {
            $query = $query->where('name','like','%'.$this->searchTerm.'%')
            ->orwhere('email','like','%'.$this->searchTerm.'%')
            ;
        }

        $getListUsers = $query->orderBy('created_at','desc')->paginate($this->perPage);

        return view('livewire.user.user-list',[
            'data' => $getListUsers 
        ]);
    }


    

    
    public function resetSearch()
    {
        $this->search = "";
    }

    public function resetInputFields()
    {
         $this->reset([
            'name',
            'email',
            'password',
            'phone',
            'avatar',
            'confirm_password',
            'gender'
         ]);
    }

    public function saveData()
    {
        
        if($this->updateMode == false)
        {
            $validateData = $this->validate();
            $validateData['name'] = $this->name;
            $validateData['email'] = $this->email;
            $validateData['avatar'] = $this->avatar->store('public');
            $validateData['password'] = Hash::make($validateData['password']);
            $validateData['phone'] = $this->phone;
            $validateData['gender'] = $this->gender;
            User::create($validateData);
    
            session()->flash('message', 'Tạo mới người dùng thành công');
            $this->resetInputFields();
        }
        else{
            // dd('1');

            User::where('id',$this->user_id)->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'avatar' => $this->avatar ? $this->avatar->store('public') : $this->oldAvatar,
                'gender' => $this->gender
            ]);

            
            session()->flash('message', 'Chỉnh sửa người dùng thành công');
            $this->resetInputFields();
        }

        $this->emit('close-edit-modal');
    }

    public function edit($user_id)
    {
        $this->updateMode = true;
        $getUser = User::findOrFail($user_id);
        if($getUser)
        {
            $this->user_id = $getUser->id;
            $this->name = $getUser->name;
            $this->email = $getUser->email;
            $this->phone = $getUser->phone;
            $this->oldAvatar = $getUser->avatar;
            $this->gender = $getUser->gender;

            
        }
        else{
            return redirect()->route('user.list');
        }
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->avatar = null;
        $this->iteration++;
    }

    public function openCreateModal()
    {
        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function deleteId($id)
    {
        $this->deleted_id = $id;
    }

    public function delete()
    {
        try {
            $deletedUser = User::find($this->deleted_id);
    
            $deletedUser->delete();
    
            $this->emit('close-delete-modal');
    
            session()->flash('message', 'Xóa người dùng thành công');
        } catch (\Throwable $th) {
            session()->flash('message', 'Xóa người dùng thất bại');
        }
    }

}
