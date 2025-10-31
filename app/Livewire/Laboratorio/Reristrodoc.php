<?php

namespace App\Livewire\Laboratorio;

use Livewire\Component;
use App\Models\User;
use App\Models\Persona;
use App\Models\Historial;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Reristrodoc extends Component
{
    use WithPagination;

    public $buscar, $lim;
    public $fecha_inicio, $fecha_fin;

    protected $queryString = [
        'buscar' => ['except' => ''],
        'fecha_inicio' => ['except' => ''],
        'fecha_fin' => ['except' => '']
    ];

    public function render()
    {
        $laboratorio = auth()->user()->laboratorio;  

        if ($this->lim == null) {
            $this->lim = 10;
        } 

        // Inicializar paginador vacío
        $historiales = new \Illuminate\Pagination\LengthAwarePaginator(
            collect([]),
            0,
            $this->lim,
            1
        );

        if ($laboratorio) {
            $query = Historial::where('laboratorio_id', $laboratorio->id);

            // 🔍 Aplicar búsqueda por nombre (asumiendo que hay una relación con persona)
            if (!empty($this->buscar)) {
                $query->whereHas('persona', function($q) {
                    $q->where('nombres', 'like', '%' . $this->buscar . '%')
                      ->orWhere('cedula', 'like', '%' . $this->buscar . '%');
                });
            }

            // 📅 Aplicar filtro por rango de fechas
            if (!empty($this->fecha_inicio)) {
                $query->whereDate('created_at', '>=', $this->fecha_inicio);
            }

            if (!empty($this->fecha_fin)) {
                $query->whereDate('created_at', '<=', $this->fecha_fin);
            }

            $historiales = $query->orderBy('created_at', 'desc')
                                ->paginate($this->lim);
        }

        return view('livewire.laboratorio.reristrodoc',[
            'laboratorio' => $laboratorio,
            'historiales' => $historiales,
        ]);
    }

    /**
     * Resetear paginación cuando se realizan búsquedas
     */
    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function updatingFechaInicio()
    {
        $this->resetPage();
    }

    public function updatingFechaFin()
    {
        $this->resetPage();
    }

    /**
     * Limpiar todos los filtros
     */
    public function limpiarFiltros()
    {
        $this->buscar = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->resetPage();
    }

    /**
     * Método para formatear fechas (opcional, para mostrar en la vista)
     */
    public function formatearFecha($fecha)
    {
        return Carbon::parse($fecha)->format('d/m/Y');
    }
}
