<?php
/* namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Modelo;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;

class ModeloGaleria extends Component
{
    use WithFileUploads;

    public $modelo;
    public $fotos = [];
    public $newPhotos = [];
    public $isOpen = false;

    protected $listeners = ['openGallery' => 'showGallery'];

    protected $rules = [
        'newPhotos.*' => 'image|max:2048', // 2MB Max por imagen
    ];

    public function showGallery($modeloId)
    {
        $this->modelo = Modelo::findOrFail($modeloId);
        $this->fotos = $this->modelo->fotos;
        $this->isOpen = true;
    }

    public function addPhotos()
    {
        $this->validate();

        foreach ($this->newPhotos as $photo) {
            $photoPath = $photo->store('photos', 'public');
            $this->modelo->fotos()->create(['url' => $photoPath]);
        }

        $this->fotos = $this->modelo->fotos->toArray();
        $this->newPhotos = [];
    }

    public function deletePhoto($photoId)
    {
        $photo = Foto::findOrFail($photoId);
        Storage::disk('public')->delete($photo->url);
        $photo->delete();

        $this->fotos = $this->modelo->fotos->toArray();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modelo-galeria');
    }
} */

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;

class ModeloGaleria extends Component
{
    use WithFileUploads;

    public $isOpen = false;
    public $newPhotos = [];
    public $fotos = [];
    public $modeloId;

    protected $listeners = ['openGallery' => 'openModal'];

    public function mount()
    {
        $this->loadPhotos();
    }

    public function loadPhotos()
    {
        // Carga las fotos del modelo (asumiendo que hay una relación definida)
        $this->fotos = Foto::where('modelo_id', $this->modeloId)->get();
    }

    public function openModal($modeloId)
    {
        $this->isOpen = true;
        $this->modeloId = $modeloId;
        $this->loadPhotos();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function addPhotos()
    {
        $this->validate([
            'newPhotos.*' => 'image|max:2048', // 2MB máximo
        ]);

        foreach ($this->newPhotos as $photo) {
            $photoPath = $photo->store('photos', 'public');
            Foto::create([
                'modelo_id' => $this->modeloId,
                'url' => $photoPath,
            ]);
        }

        $this->newPhotos = [];
        $this->loadPhotos();
    }

    public function deletePhoto($photoId)
    {
        $photo = Foto::find($photoId);
        if ($photo) {
            Storage::disk('public')->delete($photo->url);
            $photo->delete();
            $this->loadPhotos();
        }
    }

    public function removeTemporaryPhoto($index)
    {
        array_splice($this->newPhotos, $index, 1);
    }

    public function render()
    {
        return view('livewire.modelo-galeria');
    }
}

