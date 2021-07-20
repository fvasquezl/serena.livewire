<div>
    <div class="bg-white shadow">
        <div class="flex items-baseline justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin/Roles') }}
            </h2>
            @can('create', $roles->first())
                <div class="mr-2">
                    <x-jet-button wire:click="$emitTo('admin.roles.role-controller', 'createModal')"
                        class="bg-blue-500 hover:bg-blue-700">
                        <i class="fas fa-plus"></i>&nbsp; {{ __('Create roles') }}
                    </x-jet-button>
                </div>
            @endcan
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <x-table>

                    <div class="bg-white flex items-center justify-between px-4 py-3 border-gray-200 sm:px-6">
                        <span class="mr-2 text-gray-700">Show:</span>
                        <select id="search" name="search" autocomplete="search"
                            class="mt-1 block py-2 px-7 text-gray-500 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            wire:model='show'>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>

                        <span class="ml-3 mr-2 text-gray-700">Search:</span>
                        <input type="text" name="search" id="search" autocomplete="search"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            wire:model="search">
                    </div>

                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-teal-600 font-medium text-sm text-white  uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-2 text-center" wire:click="order('id')">
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
                                <th scope="col" class="px-6 py-2 text-left" wire:click="order('name')">
                                    Identifier
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
                                <th scope="col" class="px-6 py-2 text-left" wire:click="order('display_name')">
                                    Name
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

                                <th scope="col" class="px-6 py-2 text-left" wire:click="order('permissions')">
                                    Name
                                    {{-- @if ($sort == 'display_name')
                                        @if ($direction == 'asc')
                                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                        @else
                                            <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort float-right"></i>
                                    @endif --}}
                                </th>


                                <th scope="col" class="px-6 py-3 text-center ">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($roles->count())
                                @foreach ($roles as $role)
                                    <tr
                                        class="hover:bg-sky-700 hover:text-white hover:font-normal font-normal text-gray-500">
                                        <td class="px-6 py-2 whitespace-nowrap text-center">
                                            {{ $role->id }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base">
                                            {{ $role->name }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-base">
                                            {{ $role->display_name }}
                                        </td>
                                        <td>{{ count($role->permissions) ? $role->permissions->pluck('display_name')->implode(', ') : 'No permissions Added' }}
                                        </td>

                                        @can('update', $role)
                                            <td class="px-6 py-2 whitespace-nowrap text-left">

                                                <x-jet-button
                                                    wire:click="$emitTo('admin.roles.role-controller', 'updateModal',{{ $role->id }} )"
                                                    class="bg-blue-500 hover:bg-blue-700  text-base font-medium">
                                                    <i class="fas fa-edit"></i>
                                                </x-jet-button>
                                                @can('delete', $role)
                                                    @if ($role->id !== 1)
                                                        <x-jet-button wire:click="$emit('deleteUser',{{ $role->id }})"
                                                            class="bg-red-500 hover:bg-red-700  text-base font-medium">
                                                            <i class="fas fa-trash"></i>
                                                        </x-jet-button>
                                                    @endif
                                                @endcan
                                            </td>
                                        @endcan
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
                        {{ $roles->links() }}
                    </div>

                </x-table>
            </div>
        </div>
    </div>


    {{-- modal form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Update Roles') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full bg-gray-200" type="text" wire:model.debounce.80ms="name"
                    disabled />
                <x-jet-input-error for="name" />
            </div>
            <div class="mt-4">
                <x-jet-label for="display_name" value="{{ __('Display Name') }}" />
                <x-jet-input id="display_name" class="block mt-1 w-full" type="text"
                    wire:model.debounce.80ms="display_name" />
                <x-jet-input-error for="display_name" />
            </div>

            @foreach ($permissions as $permission)
                <ul class="list-unstyled">
                    @foreach ($roles as $role)
                        <li>
                            <label>
                                <input name="roles[]" type="checkbox" value="{{ $role->id }}"
                                    {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                {{ $role->name }} <br>
                                <small
                                    class="text-muted">{{ $role->permissions->pluck('name')->implode(', ') }}</small>
                            </label>
                        </li>
                    @endforeach
                </ul>
            @endforeach

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

</div>
