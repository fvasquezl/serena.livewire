<?php

namespace App\Http\Livewire\Admin\Permissions;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionController extends Component
{
    use WithPagination;


    public $permission;
    public $modalFormVisible = false;
    public $modelId;
    public $name;
    public $display_name;

    //Table
    public $readyToLoad = false;
    public $search = '';
    public $direction = 'desc';
    public $sort = 'id';
    public $show = '10';


    protected $queryString = [
        'show' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'render',
        // 'delete',
        // 'createModal' => 'createShowModal',
        'updateModal' => 'updateShowModal'
    ];



    /**
     * rules
     *
     * @return void
     */
    public function rules()
    {
        $rules =  [
            'display_name' => ['required'],
        ];

        return $rules;
    }

    /**
     * The livewire mount function
     *
     * @return void
     */
    public function mount()
    {   //Resets the pagination after reloading the page
        $this->resetPage();
    }

    // /**
    //  * the create function
    //  *
    //  * @return void
    //  */
    // public function create()
    // {
    //     $this->validate();
    //     Permission::create($this->modelData());
    //     $this->modalFormVisible = false;
    //     $this->resetVars();
    //     $this->emit('alert', 'The permission was create successfully');
    // }

    /**
     * The read function
     *
     * @return void
     */
    public function read()
    {
        return Permission::paginate(5);
    }



    /**
     * the update function
     *
     * @return void
     */
    function update()
    {
        $this->validate();
        Permission::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

        $this->emit('alert', 'The permission was updated successfully');
    }

    // /**
    //  * the delete function
    //  *
    //  * @return void
    //  */
    // function delete(Permission $permission)
    // {

    //     $permission->delete();
    //     $this->resetPage();
    // }


    // /**
    //  * Shows the form modal
    //  * of the create function
    //  *
    //  * @return void
    //  */
    // public function createShowModal()
    // {
    //     $this->resetValidation();
    //     $this->resetVars();
    //     $this->modalFormVisible = true;
    // }

    /**
     * Show s the form modal
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    /**
     * loads the model model
     * in this component
     *
     * @return void
     */
    public function loadModel()
    {
        $data = Permission::find($this->modelId);
        $this->name = $data->name;
        $this->display_name = $data->display_name;
    }

    /**
     * the data for de model mapped
     * in this component
     *
     * @return void
     */
    public function modelData()
    {
        $permission =  [
            'name' => $this->name,
            'display_name' => $this->display_name,
        ];
        return $permission;
    }

    /**
     * Resets all the cariables
     * to null
     *
     * @return void
     */
    public function resetVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->display_name = null;
    }



    /**
     * The render function
     *
     * @return void
     */
    public function render()
    {
        $permissions = Permission::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('display_name', 'LIKE', "%{$this->search}%")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->show);

        return view('livewire.admin.permissions.index', compact('permissions'));
    }


    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }
}
