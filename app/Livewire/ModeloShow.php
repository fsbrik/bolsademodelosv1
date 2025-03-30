<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Modelo;
use Livewire\Attributes\On;


class ModeloShow extends Component
{
    public $modelo, $modeloId, $profile_photo_url, $localidades;
    public $modelosSeleccionadas;
    // saber de que pagina proviene, de create o de edit
    public $action = null;

    public function mount($modeloId)
    {
        $this->localidades = include(public_path('storage/localidades/localidades.php'));
        $modelo = Modelo::findOrFail($modeloId); 
        $this->profile_photo_url = $modelo->user->profile_photo_url;   
        $this->modelo = $modelo->toArray();
        $this->modeloId = $modeloId;   

        // mostrar las modelos seleccionadas en el alert
        $this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);
    }

    public function checkForSessions()
    {
        if(session()->get('contratacion') == 'contratCreate'){            
            return redirect()->route('empresas.contrataciones.create');
        } 
        elseif(session()->get('contratacion') == 'contratEdit'){
            return redirect()->route('empresas.contrataciones.edit', session()->get('contratacionId'));
        }        
    } 

    /* agregar por valores de sesion a modelos seleccionadas */
    public function selectModelo($modeloId)
    {
        // Obtén el modelo por su id
        $modelo = Modelo::findOrFail($modeloId);

        // Verifica si el mod_id no está ya en el array
        if (!in_array($modelo->mod_id, $this->modelosSeleccionadas)) {
            // Agrega el mod_id al array
            $this->modelosSeleccionadas[] = $modelo->mod_id;
        }
        
        // ordena el array de las modelos
        asort($this->modelosSeleccionadas, SORT_NATURAL);
    }

    public function removeModelo($modeloId)
    {
        // Obtén el modelo por su id
        $modelo = Modelo::findOrFail($modeloId);

        // Obtén el array de modelos seleccionados desde la sesión
        //$this->modelosSeleccionadas = session()->get('modelos_seleccionadas', []);

        // Elimina el mod_id del array
        $this->modelosSeleccionadas = array_diff($this->modelosSeleccionadas, [$modelo->mod_id]);

        // ordena el array de las modelos seleccionadas
        asort($this->modelosSeleccionadas, SORT_NATURAL);

        // ----------- lo siguiente se agrega solo para ModeloShow -------------- //
        // Actualiza la sesión con el nuevo array
        session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);

       // redirige dependiendo la session de contratacion
       $this->checkForSessions();
    }

    public function addModeloSeleccionada($modeloId)
    {
        $this->selectModelo($modeloId);

        // Actualiza la sesión con el nuevo array
        session()->put('modelos_seleccionadas', $this->modelosSeleccionadas);//dd(session()->get('contratacion'));

        // redirige dependiendo la session de contratacion
        $this->checkForSessions();        
    }

    public function getSexoDisplayProperty()
    {
        return $this->modelo['sexo'] == 'F' ? 'Femenino' : 'Masculino';
    }

    public function getColcabDisplayProperty()
    {
        return ucfirst($this->modelo['col_cab']);
    }

    public function getDisviaDisplayProperty()
    {
        return $this->modelo['dis_via'] ?? '-' ? 'Sí' : 'No';
    }

    public function getTitmodDisplayProperty()
    {
        return $this->modelo['tit_mod'] ?? '-' ? 'Sí' : 'No';
    }

    public function getInglesDisplayProperty()
    {
        switch ($this->modelo['ingles'])
        {
            case 'basico':
                return 'Básico';
            
            case 'intermedio':
                return 'Intermedio';
            
            case 'avanzado':
                return 'Avanzado';
        }
    }

    public function getDistraDisplayProperty()
    {
        return ucfirst($this->modelo['dis_tra']);
    }

    public function getEstadoDisplayProperty()
    {
        return $this->modelo['estado'] == 1 ? 'Activo' : 'Inactivo';
    }

    public function getHabilitaDisplayProperty()
    {
        return $this->modelo['habilita'] == 1 ? 'Sí' : 'No';
    }

    public function render()
    {
        return view('livewire.modelo-show');
    }
}
