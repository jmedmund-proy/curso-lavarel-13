<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Category;

new class extends Component
{

    use WithFileUploads;

    // 3ra Forma

    #[Validate('required|min:2|max:255')]
    public $title;

    public $slug;

    #[Validate('nullable')]
    public $text;

    public $image;

    public $category;

//  1ra Forma
    // protected $rules = [
    //     'title' => "required|min:2|max:255",
    //     'text' => "nullable",
    // ];

    

    function mount(?int $id = null){
        if($id){
            $this->category = Category::findOrFail($id);
            $this->title = $this->category->title;
            $this->slug = $this->category->slug;
            $this->text = $this->category->text;
        }
    }

    function submit(){
        // 1ra Forma
        // $this->validate();

        // 2da Forma
        // $this->validate([
        //     'title' => "required|min:2|max:255",
        //     'text' => "nullable",
        // ]);

        // 3ra Forma
        // $this->validate();

        // dd($this->title);

        if($this->category){
            $this->category->update($this->validate());
            $this->dispatch("update");
        }else{
            $this->category = Category::create($this->validate());
            $this->dispatch("created");
        }

        if($this->image){
            if($this->category->image){
                Storage::disk('public_upload')->delete('image/category/'.$this->category->image);
            }
            $imageName = $this->category->slug .'.'. $this->image->getClientOriginalExtension();
            $this->image->storeAs('image/category',$imageName,'public_upload');
            $this->category->update([
                'image' => $imageName
            ]);
        }
    }

};
?>

<div>

    <x-action-message on="created">
        {{ __('Created category success') }}
    </x-action-message>

    <x-action-message on="updated">
        {{ __('Updated category success') }}
    </x-action-message>


    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Category') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage...') }}</flux:subheading>
        <flux:separator variant="subtle"/>
    </div>

    {{ $title }}

    <form wire:submit.prevent="submit" class="space-y-4">
        <flux:input label="Title" wire:model.blur="title" placeholder="Escribe el título..." />
        <flux:textarea label="Text" wire:model="text" placeholder="Escribe el texto..." />
        <flux:input label="Image" type="file" wire:model="image"/>

        <flux:button type="submit" variant="primary">
            Send
        </flux:button>

        {{-- <label for="">Title</label>
        <input type="text" wire:model="title">
        <label for="">Text</label>
        <input type="text" wire:model="text">
        <button type="submit">Send</butoon> --}}
    </form>
</div>