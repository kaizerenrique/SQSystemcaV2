<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;
use App\Models\Historial;
use Livewire\WithPagination;

class PerfilPersona extends Component
{

    use WithPagination;

    
    public function render()
    {
        $persona = auth()->user()->persona;        

        $historiales = Historial::where('persona_id', $persona->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        
        return view('livewire.usuarios.perfil-persona',[
            'persona' => $persona,
            'historiales' => $historiales,
        ]);
    }

    /**
     * Corrige la numeracion de la tabla al realizar 
     * una busqueda
     */
    public function updatingBuscar()
    {
        $this->resetPage();
    }
}
