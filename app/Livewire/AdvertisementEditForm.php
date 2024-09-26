<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Models\Advertisement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AdvertisementEditForm extends Component
{
    use WithFileUploads;
    
    public $advertisement;
    public $title;
    public $description;
    public $price;
    public $image;
    public $images = [];
    public $old_image;
    public $category;
    public $temporary_images;

    protected $rules = [
        'title'=>'required|min:3',
        'description'=>'required|min:3|max:8000',
        'price'=>'required|numeric|gt:0',
        'category'=>'required',
        'image.*'=>'required|image|max:1536|mimes:jpg,webp,gif,png',
        'temporary_images.*'=>'image|max:1536|mimes:jpg,webp,gif,png',
        ];

    protected $messages = [
        'required'=>'Il campo :attribute è richiesto',
        'min'=>'Il campo :attribute deve contenere :min caratteri',
        'max'=>'Il campo :attribute deve contenere :max caratteri',
        'image.*.max'=>'L\'immagine a caricare non può superare i :max Kb',
        'mimes' => 'L\'immagine può essere in formato :values',
        'temporary_images.*.max'=>'L\'immagine a caricare non può superare i :max Kb',
        'temporary_images.*.image'=>'I file devono essere immagini',
        'temporary_images.*.mimes'=>'L\'immagine può essere in formato :values',
        'numeric'=>'Il campo :attribute dev\'essere numerico',
        'gt:0'=>'Il campo :attribute dev\'essere maggiore di :gt',
        'image'=>'Il campo :attribute dev\'essere di tipo immagine',
        ];

    public function mount(){
        $this->title = $this->advertisement->title;
        $this->description = $this->advertisement->description;
        $this->price = $this->advertisement->price;
        $this->image = $this->advertisement->image;
        $this->category = $this->advertisement->category;
        
    }

    public function update(){
        
        $this->validate();
        
        // $this->advertisement = Category::find($this->category)->advertisements()->update($this->validate());
        
        $this->advertisement->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,
            'is_accepted'=> null,
        ]);

        // Devo prima eliminare le immagini esistenti
        if (count($this->images)) {
            $this->advertisement->images()->delete();
        }

        if(count($this->images)){
            foreach($this->images as $image){
                // $this->advertisement->images()->create(['path'=>$image->store('images', 'public')];
                    $newFileName = "advertisements/{$this->advertisement->id}";
                    $newImage = $this->advertisement->images()->create(['path'=>$image->store($newFileName, 'public')]);

                    // Ora inserisco le nuove immagini
                    RemoveFaces::withChain([
                        new ResizeImage($newImage->path, 400, 300),
                        new GoogleVisionSafeSearch($newImage->id),
                        new GoogleVisionLabelImage($newImage->id)
                    ])->dispatch($newImage->id);
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('message', __('ui.advEdited'));
        $this->reset('image');
    }
    
    public function updatedTemporaryImages(){
        if($this->validate()){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key){
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        session()->flash('message', __('ui.deleteSuccess'));
    }
    
    public function render()
    {
        return view('livewire.advertisement-edit-form');
    }
}
