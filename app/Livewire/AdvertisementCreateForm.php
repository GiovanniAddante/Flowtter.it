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

class AdvertisementCreateForm extends Component
{
    use WithFileUploads;
    // #[Validate('required', message: 'Il campo titolo è richiesto')]
    // #[Validate('min:3', message: 'Il campo titolo deve essere minimo di 3 caratteri')]
    public $title;
    // #[Validate('required|min:3|max:8000')]
    public $description;
    public $temporary_images;
    public $images = [];
    public $image;
    // #[Validate('required|numeric|gt:0')]
    public $price;
    // #[Validate('required')]
    public $category;
    public $advertisement;

    protected $rules = [
        'title'=>'required|min:3',
        'description'=>'required|min:3|max:8000',
        'price'=>'required|numeric|gt:0',
        'category'=>'required',
        'images.*'=>'required|image|max:1536',
        'temporary_images.*'=>'image|max:1536',
        ];

    protected $messages = [
        'required'=>'Il campo :attribute è richiesto',
        'min'=>'Il campo :attribute deve contenere :min caratteri',
        'max'=>'Il campo :attribute deve contenere :max caratteri',
        'images.*.max'=>'L\'immagine a caricare non può superare i :max Kb',
        'temporary_images.*.max'=>'L\'immagine a caricare non può superare i :max Kb',
        'temporary_images.*.image'=>'I file devono essere immagini',
        'numeric'=>'Il campo :attribute dev\'essere numerico',
        'gt:0'=>'Il campo :attribute dev\'essere maggiore di :gt',
        'image'=>'Il campo :attribute dev\'essere di tipo immagine',
        ];

    public function validationAttributes() 
    {
        return [
            'title' => 'titolo',
            'price' => 'prezzo',
            'description' => 'descrizione',
        ];
    }
    
    public function store(){
        
        $this->validate();

        //$category=Category::find($this->category);
        
        $this->advertisement = Category::find($this->category)->advertisements()->create($this->validate());
        if(count($this->images)){
            foreach($this->images as $image){
                // $this->advertisement->images()->create(['path'=>$image->store('images', 'public')];
                $newFileName = "advertisements/{$this->advertisement->id}";
                $newImage = $this->advertisement->images()->create(['path'=>$image->store($newFileName, 'public')]);

                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 400, 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }
        
        $this->advertisement->update([
            // 'title' => $this->title,
            // 'description' => $this->description,
            // 'price' => $this->price,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', __('ui.advUploaded'));

        $this->reset();
    }

    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*'=>'image|max:1536',
        ])){
            foreach($this->temporary_images as $image){
                $this->images[]=$image;
            }
        }
    }

    public function removeImage($key){
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function render()
    {
        return view('livewire.advertisement-create-form');
    }
}
