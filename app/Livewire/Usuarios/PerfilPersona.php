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

    public $modalagregarperfil = false;
    public $titulo, $nombres, $apellidos, $fnacimiento, $sexo, $nacionalidad, $cedula, $codigo_internacional, $codigo_operador, $nrotelefono, $whatsapp ;

    public $modalbuscarperfil = false;
    public $modalconfirmarperfil = false;

    protected function rules()
    {
        if ($modalagregarperfil = true) {
            return [
                'nombres' => 'required|string|min:4|max:120',
                'apellidos' => 'required|string|min:4|max:120',
                'fnacimiento' => 'required|date',
                'sexo' => 'required|in:Femenino,Masculino', 
                'nacionalidad' => 'required|string|in:V,E',
                'cedula' => 'required|string|min:6|max:12|unique:personas,cedula',                
                'codigo_internacional' => 'required|string|min:3|max:5', 
                'codigo_operador' => 'required|string|min:3|max:4', 
                'nrotelefono' => 'required|string|min:7|max:11', 
                'whatsapp' => 'required' 
            ];
        }        
    }

    
    public function render()
    {
        $persona = auth()->user()->persona;        

        // Manejar el caso cuando no hay persona asociada
        $historiales = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([]), // Colección vacía
            0,           // Total de items
            5,           // Items por página
            1            // Página actual
        );
        
        if ($persona) {
            $historiales = Historial::where('persona_id', $persona->id)
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
            
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

    public function buscarperfil()
    {
        $this->reset(['cedula']);
        $this->modalbuscarperfil = true;
    }

    public function identificarperfil()
    {        
        $this->modalbuscarperfil = false;

        // Buscar persona usando una sola consulta optimizada
        $persona = Persona::where('cedula', $this->cedula)->first();

        if (!$persona) {
            $this->desplegarmodalderegistro();
        } else {
            $this->modalconfirmarperfil = true;
            $this->cedula = $persona->cedula;
            $this->nombres = $persona->nombres;
            $this->apellidos = $persona->apellidos;
        }
        
        
    }

    public function guardaperfil()
    {        
        $this->modalconfirmarperfil = false;

        // Buscar persona usando una sola consulta optimizada
        $persona = Persona::where('cedula', $this->cedula)->first();

        $usua = auth()->user()->id;

        // Actualizar datos de usuario
        $resul = $persona->update([
            'user_id' => $usua ,
        ]);
        
        session()->flash('message', 'Se a registrado correctamente');

    }

    public function desplegarmodalderegistro()
    {
        $this->titulo = "Registro";
        $this->reset(['nombres']);
        $this->reset(['apellidos']);
        $this->reset(['fnacimiento']);
        $this->reset(['sexo']);
        $this->reset(['nacionalidad']);
        $this->reset(['cedula']);
        $this->reset(['codigo_internacional']);
        $this->reset(['codigo_operador']);
        $this->reset(['nrotelefono']);
        $this->reset(['whatsapp']);
        $this->modalagregarperfil = true;
    }

    public function guardarperfil()
    {
        //validamos los datos del formulario    
        $this->validate();

        $persona = auth()->user()->persona()->create([
            'nacionalidad' => $this->nacionalidad,
            'cedula' => $this->cedula,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'fnacimiento' => $this->fnacimiento,
            'sexo' => $this->sexo,
        ]); 

        $persona->telefono()->create([
            'codigo_internacional' => $this->codigo_internacional,
            'codigo_operador' => $this->codigo_operador,
            'nrotelefono' => $this->nrotelefono,
            'whatsapp' => $this->whatsapp
        ]);

        $this->modalagregarperfil = false;  

        session()->flash('message', 'Se a registrado correctamente');
    }
}
