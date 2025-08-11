<?php

namespace App\Livewire\Administracion;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministracionUsuarios extends Component
{
    use WithPagination;

    public $buscar;

    protected $queryString = [
        'buscar' => ['except' => '']
    ];

    //variables para agregar laboratorio
    public $modalagregarlaboratorio = false;
    public $titulo,$mensajemodal;
    public $nombre, $correo, $laboratorio, $rif, $codigo_internacional, $codigo_operador, $nrotelefono, $whatsapp ;

    protected function rules()
    {
        if ($modalagregarlaboratorio = true) {
            return [
                'nombre' => 'required|string|min:4|max:45',
                'correo' => 'required|string|email|min:12|max:160|unique:users,email',
                'laboratorio' => 'required|string|min:4|max:255',
                'rif' => 'required|string|min:8|max:14',                
                'codigo_internacional' => 'required|string|min:3|max:5', 
                'codigo_operador' => 'required|string|min:3|max:4', 
                'nrotelefono' => 'required|string|min:7|max:11', 
                'whatsapp' => 'required|boolean' 
            ];
        }        
    }

    public function render()
    {
        //listar los usuarios y consultar por nombre y correo
        $usuarios = User::where('name', 'like', '%'.$this->buscar . '%')  //buscar por nombre de usuario
                      ->orWhere('email', 'like', '%'.$this->buscar . '%') //buscar por correo de usuario
                      ->orderBy('id','desc') //ordenar de forma decendente
                      ->paginate(10); //paginacion

        $roles = Role::all();

        return view('livewire.administracion.administracion-usuarios',[
            'usuarios' => $usuarios,
            'roles' => $roles
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

    public function agregarlaboratorio()
    {
        $this->titulo = "Registro de Laboratorio";
        $this->reset(['nombre']);
        $this->reset(['correo']);
        $this->reset(['rif']);
        $this->reset(['laboratorio']);
        $this->reset(['codigo_internacional']);
        $this->reset(['codigo_operador']);
        $this->reset(['nrotelefono']);
        $this->reset(['whatsapp']);
        $this->modalagregarlaboratorio = true;
    }

    public function guardarlaboratorio()
    {
        
        //validamos los datos del formulario    
        $this->validate();

        $registro = User::create([
            'name'=> $this->nombre,
            'email'=> $this->correo,
            'password'=> Hash::make('123456789')
        ])->assignRole('Laboratorio')->laboratorio()->create([
            'rif'=> $this->rif,
            'nombre'=> $this->laboratorio
        ])->telefono()->create([
            'codigo_internacional'=> $this->codigo_internacional,
            'codigo_operador'=> $this->codigo_operador,
            'nrotelefono'=> $this->nrotelefono,
            'whatsapp'=> $this->whatsapp
        ]);

        $this->modalagregarlaboratorio = false;
        
    }
}
