<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $image;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $newimage;

    public function mount($slide_id)
    {
        $slider = HomeSlider::find($slide_id);
        $this->image = $slider->image;
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->status = $slider->status;
        $this->slider_id = $slider->id;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required|numeric',
            'link' => 'required',
        ]);
    }

    public function updateSlide()
    {
        $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'price' => 'required|numeric',
            'link' => 'required',
        ]);
        $slider = HomeSlider::find($this->slider_id);
        if($this->newimage){
            $imgename = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('sliders',$imgename);
            $slider->image = $imgename;
        }
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $slider->save();
        session()->flash('message', 'Slide has been updated successfully!');

    }

    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.admin-dash');
    }
}
