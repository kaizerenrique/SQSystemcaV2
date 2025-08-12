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

    public $eliminarlaboratorio = false;
    public $idusuario;

    public $modalverlaboratorio = false;

    public $modaleditarlaboratorio = false;

    public $mostrarTokenApi = false;
    public $token;

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
                'whatsapp' => 'required' 
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

        // Paso 1: Crear el usuario
        $user = User::create([
            'name' => $this->nombre,
            'email' => $this->correo,
            'password' => Hash::make('123456789')
        ]);

        // Paso 2: Asignar el rol
        $user->assignRole('Laboratorio');

        // Paso 3: Crear el laboratorio asociado al usuario
        $laboratorio = $user->laboratorio()->create([
            'rif' => $this->rif,
            'nombre' => $this->laboratorio
        ]);

        // Paso 4: Crear el teléfono asociado al laboratorio
        $laboratorio->telefono()->create([
            'codigo_internacional' => $this->codigo_internacional,
            'codigo_operador' => $this->codigo_operador,
            'nrotelefono' => $this->nrotelefono,
            'whatsapp' => $this->whatsapp
        ]);

        // Paso 5: Generar el token usando el USUARIO (no el laboratorio ni el teléfono)
        $token = $user->createToken(
            name: $this->laboratorio,
            abilities: ["read", "create", "update", "delete"]
        )->plainTextToken;
        
        $this->modalagregarlaboratorio = false;  

        $this->titulo = "Token API";
        $this->token = $token;
        $this->mostrarTokenApi = true; 
              

        //dd($token);
        session()->flash('message', 'Se a registrado correctamente');
        
    }

    public function consultaborrarlaboratorio(User $usuario)
    {
        $this->titulo = "Borrar laboratorio";
        $this->mensajemodal = "Está seguro de querer borrar el laboratorio ". $usuario->laboratorio->nombre;
        $this->idusuario = $usuario->id;

        $this->eliminarlaboratorio = true;
    }

    public function borrarlaboratorio(User $usuario)
    {
        $this->eliminarlaboratorio = false;
        $nombre = $usuario->laboratorio->nombre;
        $usuario->delete(); 
        session()->flash('message', 'Se a eliminado correctamente el laboratorio: '.$nombre);
    }

    public function verlaboratorio(User $usuario)
    {
        $this->titulo = "Ver Datos de Laboratorio";
        $this->nombre = $usuario->name;
        $this->correo = $usuario->email;
        $this->rif = $usuario->laboratorio->rif;
        $this->laboratorio = $usuario->laboratorio->nombre;
        $this->codigo_internacional = $usuario->laboratorio->telefono->codigo_internacional;
        $this->codigo_operador = $usuario->laboratorio->telefono->codigo_operador;
        $this->nrotelefono = $usuario->laboratorio->telefono->nrotelefono;
        $this->whatsapp = $usuario->laboratorio->telefono->whatsapp;
        $this->modalverlaboratorio = true;
    }

    public function editarlaboratorio(User $usuario)
    {
        $this->titulo = "Editar Datos de Laboratorio";
        $this->nombre = $usuario->name;
        $this->correo = $usuario->email;
        $this->rif = $usuario->laboratorio->rif;
        $this->laboratorio = $usuario->laboratorio->nombre;
        $this->codigo_internacional = $usuario->laboratorio->telefono->codigo_internacional;
        $this->codigo_operador = $usuario->laboratorio->telefono->codigo_operador;
        $this->nrotelefono = $usuario->laboratorio->telefono->nrotelefono;
        $this->whatsapp = $usuario->laboratorio->telefono->whatsapp;
        $this->modaleditarlaboratorio = true;
    }

    public function editarlab(User $usuario)    
    {
        $this->validate([
            'nombre' => 'required|string|min:4|max:45',
                'correo' => 'required|string|email|min:12|max:160|unique:users,email',
                'laboratorio' => 'required|string|min:4|max:255',
                'rif' => 'required|string|min:8|max:14',                
                'codigo_internacional' => 'required|string|min:3|max:5', 
                'codigo_operador' => 'required|string|min:3|max:4', 
                'nrotelefono' => 'required|string|min:7|max:11', 
                'whatsapp' => 'required' 
        ]);
        
        try {
        // Buscar el usuario
        $user = User::findOrFail($usuario->id);

        // Actualizar datos de usuario
        $user->update([
            'name' => $this->nombre,
            'email' => $this->correo,
        ]);

        // Actualizar datos de laboratorio (asumiendo relación one-to-one)
        $user->laboratorio()->update([
            'rif' => $this->rif,
            'nombre' => $this->laboratorio,
        ]);

        // Actualizar teléfono (asumiendo relación one-to-one)
        $user->telefono()->update([
            'codigo_internacional' => $this->codigo_internacional,
            'codigo_operador' => $this->codigo_operador,
            'nrotelefono' => $this->nrotelefono,
            'whatsapp' => $this->whatsapp,
        ]);

        // Cerrar modal y mostrar mensaje
        $this->modaleditarlaboratorio = false;
        session()->flash('success', 'Registro actualizado correctamente');
        
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar: ' . $e->getMessage());
        }

    }
}
