<div>
    <div class="bg-white shadow">
        <div class="flex items-baseline justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin/Users') }}
            </h2>
            <div class="mr-2">
                <x-jet-button wire:click="$emitTo('admin.permissions.index-permissions', 'createModal')"
                    class="bg-blue-500 hover:bg-blue-700">
                    <i class="fas fa-plus"></i>&nbsp; {{ __('Create permission') }}
                </x-jet-button>
            </div>
        </div>
    </div>

    <div class="bg-teal-800">text</div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table>
                    <div class="px-6 py-4 flex items-center">
                        <div class="flex items-center">
                            <span>Show</span>
                            <select
                                class="ml-2 mt-1 block w-full py-2 px-5 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                wire:model='show'>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span>Search:</span>
                        </div>
                        <x-jet-input class="flex-1 mx-4 form-control" placeholder="Search.." type="text"
                            wire:model="search" />
                        {{-- @livewire('admin.permissions.create-permissions') --}}
                    </div>


                    <table class="w-full divide-y divide-gray-800">
                        @if ($permissions->count())
                            <thead class="bg-teal-200 border">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 cursor-pointer text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('id')">
                                        Id
                                        @if ($sort == 'id')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right"></i>
                                        @endif
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 cursor-pointer text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('name')">
                                        Identificador
                                        @if ($sort == 'name')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right"></i>
                                        @endif
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 cursor-pointer text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        wire:click="order('display_name')">
                                        Nombre
                                        @if ($sort == 'display_name')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                            @else
                                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right"></i>
                                        @endif
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Options
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($permissions as $permission)
                                    <tr class="hover:bg-gray-100 text-gray-900 border-b">
                                        <td class="px-4 py-2 text-center whitespace-nowrap">
                                            {{ $permission->id }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ $permission->name }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ $permission->display_name }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-center text-sm font-medium">
                                            <x-jet-button
                                                wire:click="$emitTo('admin.permissions.index-permissions', 'updateModal',{{ $permission->id }} )"
                                                class="bg-green-500 hover:bg-green-700">
                                                <i class="fas fa-edit"></i>
                                            </x-jet-button>
                                            <x-jet-button wire:click="$emit('deleteUser',{{ $permission->id }})"
                                                class="bg-red-500 hover:bg-red-700">
                                                <i class="fas fa-trash"></i>
                                            </x-jet-button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap" colspan="4">No results
                                        found
                                    </td>
                                </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="bg-white px-4 py-3 border-gray-200 sm:px-6">
                        {{ $permissions->links() }}
                    </div>

                </x-table>
            </div>
        </div>
    </div>

    {{-- modal form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save User') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.80ms="name" />
                <x-jet-input-error for="name" />
            </div>
            <div class="mt-4">
                <x-jet-label for="display_name" value="{{ __('Display Name') }}" />
                <x-jet-input id="display_name" class="block mt-1 w-full" type="email"
                    wire:model.debounce.80ms="email" />
                <x-jet-input-error for="display_name" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            @if ($modelId)
                <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>


    @push('js')
        <script>
            Livewire.on('deleteUser', permissionId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.permissions.index-permissions', 'delete', permissionId);

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        </script>
    @endpush

</div>
