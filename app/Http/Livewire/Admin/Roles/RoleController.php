<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Component
{
    use WithPagination;
    //  protected $paginationTheme = 'bootstrap';

    public $role;
    public $modalFormVisible = false;
    public $modelId;
    public $name;
    public $display_name;
    public $permissions = [];

    //Table
    public $readyToLoad = false;
    public $search = '';
    public $direction = 'asc';
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
        'delete',
        'createModal' => 'createShowModal',
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
            'name' => 'required',
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

    /**
     * the create function
     *
     * @return void
     */
    public function create()
    {
        $this->validate();
        Role::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
        $this->emit('alert', 'The user was create successfully');
    }

    /**
     * The read function
     *
     * @return void
     */
    public function read()
    {
        return Role::paginate(5);
    }



    /**
     * the update function
     *
     * @return void
     */
    function update()
    {
        $this->validate();
        Role::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;

        $this->emit('alert', 'The role was updated successfully');
    }

    /**
     * the delete function
     *
     * @return void
     */
    function delete(Role $role)
    {

        $role->delete();
        $this->resetPage();
    }


    /**
     * Shows the form modal
     * of the create function
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

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
        $data = Role::find($this->modelId);
        $this->name = $data->name;
        $this->display_name = $data->display_name;
        $this->permissions = Permission::pluck('name', 'id');
    }

    /**
     * the data for de model mapped
     * in this component
     *
     * @return void
     */
    public function modelData()
    {
        $role =  [
            'name' => $this->name,
            'display_name' => $this->display_name,
        ];
        return $role;
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
        $roles = Role::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('display_name', 'LIKE', "%{$this->search}%")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->show);

        return view('livewire.admin.roles.index', compact('roles'));
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
