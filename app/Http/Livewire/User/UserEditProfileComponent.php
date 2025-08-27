<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class UserEditProfileComponent extends Component
{
    use WithFileUploads;
    public $image;
    public $name;
    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $district;
    public $country;
    public $zipcode;
    public $newimage;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->profile->image;
        $this->firstname = $user->profile->firstname;
        $this->lastname = $user->profile->lastname;
        $this->mobile = $user->profile->mobile;
        $this->line1 = $user->profile->line1;
        $this->line2 = $user->profile->line2;
        $this->city = $user->profile->city;
        $this->province = $user->profile->province;
        $this->district = $user->profile->district;
        $this->country = $user->profile->country;
        $this->zipcode = $user->profile->zipcode;
    }

    public function updateProfile()
    {
        $user = User::find(Auth::user()->id);
        $user->name = $this->name;
        $user->save();

        $user->profile->mobile = $this->mobile;
        if($this->newimage)
        {
            if($this->image)
            {
                unlink('assets/images/profiles/'.$this->image);
            }
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('profiles', $imageName);
            $user->profile->image = $imageName;
        }
        $user->profile->firstname = $this->firstname;
        $user->profile->lastname = $this->lastname;
        $user->profile->line1 = $this->line1;
        $user->profile->line2 = $this->line2;
        $user->profile->city = $this->city;
        $user->profile->province = $this->province;
        $user->profile->district = $this->district;
        $user->profile->country = $this->country;
        $user->profile->zipcode = $this->zipcode;
        $user->profile->save();
        session()->flash('message', 'Profile updated successfully');
    }

    public function render()
    {
        return view('livewire.user.user-edit-profile-component')->layout('layouts.base');
    }
}
