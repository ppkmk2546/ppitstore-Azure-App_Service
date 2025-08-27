<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;

class AdminCouponsComponent extends Component
{
    public function thorwdelete()
    {
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        session()->flash('message', 'Coupon has been deleted successfully!');

        $this->dispatchBrowserEvent('hide-delete-modal');
    }

    public function render()
    {
        $coupons = Coupon::all();
        return view('livewire.admin.admin-coupons-component',['coupons'=>$coupons])->layout('layouts.admin-dash');
    }
}
