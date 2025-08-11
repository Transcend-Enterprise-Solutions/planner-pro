<div class="px-2 min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-indigo-900 transition-all duration-300">
    <style>
        .project-details{
            width: 20%;
        }
        .project-summary{
            width: 80%;
        }

        @media (max-width: 1024px){
            .project-details,
            .project-summary{
                width: 100%;
            }   
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="backdrop-blur-md bg-emerald-100/80 dark:bg-emerald-900/40 border border-emerald-300/50 dark:border-emerald-600/50 text-emerald-700 dark:text-emerald-300 px-6 py-4 rounded-xl shadow-lg mb-6 transition-all duration-300" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">{{ session('message') }}</span>
                    </div>
                </div>
            @endif

            <!-- Projects Section -->
            <div class="backdrop-blur-xl bg-white/70 dark:bg-gray-900/70 border dark:border-gray-700 dark:border-gray-700/50 overflow-hidden shadow-2xl rounded-2xl p-8 mb-8 transition-all duration-300">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Projects</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Manage your project portfolio</p>
                    </div>
                    <button @click="$wire.createProject()" class="group relative px-4 py-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-500 dark:to-indigo-500 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 dark:hover:from-blue-400 dark:hover:to-indigo-400 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="relative z-10 font-semibold text-sm">Add New Project</span>
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    @forelse ($projectsList as $project)
                        <div class="mb-8 w-full flex flex-wrap border dark:border-gray-700 hover:bg-white/80 dark:hover:bg-gray-800/50 transition-all duration-200">
                            <div class="project-details px-6 py-5 text-xs relative">
                                <span class="font-semibold text-gray-900 dark:text-white text-sm">{{ $project->title }}</span><br>
                                Company: <span class="text-gray-600 dark:text-gray-400 mt-1 text-xs">{{ $project->company }}</span><br>
                                Client: <span class="text-gray-600 dark:text-gray-400 mt-1 text-xs">{{ $project->client }}</span><br>
                                Price: <span class="text-gray-600 dark:text-gray-400 mt-1 text-xs">₱{{ number_format($project->price, 2) }}</span><br>
                                Duration: <span class="text-gray-600 dark:text-gray-400 mt-1 text-xs">{{ $project->date_started->format('M d, Y') }} - {{ $project->date_end ? $project->date_end->format('M d, Y') : 'Ongoing' }}</span>

                                <div class="flex flex-col justify-center items-center py-4 mt-4">
                                    <span class="text-xs">Team's Commission</span>
                                    <p class="text-lg text-gray-700 dark:text-gray-100 font-semibold">₱{{ number_format($project->revenue, '2', '.', ',') }}</p>
                                    {{-- <span class="text-xs">(N - N * 12%) * 40%</span> --}}
                                </div>

                                <div class="mb-8 flex flex-col justify-center items-center py-4 mt-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700">
                                    <span class="text-xs">Claimable Commission</span>
                                    <p class="text-2xl text-gray-700 dark:text-gray-100 font-semibold">₱{{ number_format(($project->revenue - $project->total_expenses), '2', '.', ',') }}</p>
                                </div>

                                <div class="w-full flex gap-3 absolute left-0 bottom-0 justify-center text-xs pb-4">
                                    {{-- <button @click="$wire.viewProject('{{ $project->id }}')" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-200 font-medium">View</button> --}}
                                    <button @click="$wire.editProject('{{ $project->id }}')" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200 font-medium">Edit</button>
                                    <button @click="$wire.deleteProject('{{ $project->id }}')" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200 font-medium">Delete</button>
                                </div>
                            </div>


                            <div class="project-summary p-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800">
                                
                                {{-- Personnel ------------------------ --}}
                                <div class="overflow-x-auto mb-8">
                                    <div class="px-2 flex justify-between items-center bg-gray-200 dark:bg-gray-700 py-2 border-b dark:border-gray-800 border-gray-100">
                                        <p class="font-semibold uppercase">Personnel</p>

                                        <button wire:click="toggleAddPersonnel({{ $project->id }})"
                                            class="text-xs text-green-500 dark:text-green-300 dark:hover:text-white">
                                            <i class="bi bi-plus"></i> Add
                                        </button>
                                    </div>
                                    <table class="min-w-full border dark:border-gray-700">
                                        <tbody class="border-b dark:border-gray-700">
                                            @forelse ($project->personnel as $person)
                                                <tr class="border-b dark:border-gray-700">
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-left">
                                                        {{ $this->getUsersName($person->user_id) }}
                                                    </td>
                                                    <td width="10%" class="px-6 py-4 whitespace-nowrap text-xs font-medium text-center">
                                                        <div class="flex gap-3 justify-center flex-wrap text-xs">
                                                            <button @click="$wire.deletePersonnel('{{ $person->id }}')" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200 font-medium">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-4 text-center text-xs text-gray-500">
                                                        No personnel in this project!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Expenses ------------------------ --}}
                                <div class="overflow-x-auto">
                                    <div class="px-2 flex justify-between items-center bg-gray-200 dark:bg-gray-700 py-2 border-b dark:border-gray-800 border-gray-100">
                                        <p class="font-semibold uppercase">Expences |<span class="text-xs text-red-800 dark:text-red-300"> Total: ₱{{ number_format($project->total_expenses, '2', '.', ',') }}</span></p>

                                        <button wire:click="toggleAddExpense({{ $project->id }})"
                                            class="text-xs text-green-500 dark:text-green-300 dark:hover:text-white">
                                            <i class="bi bi-plus"></i> Add
                                        </button>
                                    </div>
                                    <table class="min-w-full border dark:border-gray-700">
                                        <thead class="bg-gray-200 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expense</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Expense For</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/s</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-b dark:border-gray-700">
                                            @forelse ($project->expenses as $expense)
                                                <tr class="border-b dark:border-gray-700">
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-left">
                                                        <span class="text-md text-gray-800 dark:text-gray-100">{{ $expense->type }}</span><br>
                                                        <span>Amount:</span> ₱{{ number_format($expense->amount, '2', '.', ',') }} <br>
                                                        <span>Provided By:</span> {{ $this->getUsersName($expense->expense_by ) }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-center">
                                                        {{ $this->getUsersName($expense->expense_for) }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-left">
                                                        <span>Date Provided:</span> {{ $expense->date_released ? \Carbon\Carbon::parse($expense->date_released)->format('F d, Y') : '--' }} <br>
                                                        <span>Date Settled:</span> {{ $expense->date_settled ? \Carbon\Carbon::parse($expense->date_settled)->format('F d, Y') : '--' }} <br>
                                                    </td>
                                                    <td class="px-6 py-4 capitalize whitespace-nowrap text-xs text-center">
                                                        {{ $expense->status }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-center">
                                                        <div class="flex gap-3 justify-center flex-wrap text-xs">
                                                            <button @click="$wire.editExpense('{{ $expense->id }}')" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200 font-medium">Edit</button>
                                                            <button @click="$wire.deleteExpense('{{ $expense->id }}')" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200 font-medium">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-4 text-center text-xs text-gray-500">
                                                        No expenses in this project!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>
                    @empty
                        <div class="w-full flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-medium text-gray-900 dark:text-white mb-1">No projects found</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Create your first project to get started</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $projectsList->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Project Modal -->
    <div x-show="$wire.showProjectModal" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" x-cloak>
        <div class="fixed inset-0 transform transition-all" x-on:click="$wire.showProjectModal = false">
            <div class="absolute inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm"></div>
        </div>
        <div class="p-6 backdrop-blur-xl bg-white/90 dark:bg-gray-900/90 border dark:border-gray-700 dark:border-gray-700/50 rounded-2xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-3xl sm:mx-auto" 
             x-show="$wire.showProjectModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="px-8 py-6 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-blue-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:to-indigo-900/20">
                <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">
                    {{ $operation === 'create' ? 'Create New Project' : 'Edit Project' }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Fill in the details below to {{ $operation === 'create' ? 'create a new' : 'update the' }} project</p>
            </div>
            <div class="px-8 py-6">
                <form wire:submit.prevent="saveProject">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Project Title</label>
                            <input wire:model="title" type="text" id="title" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                            @error('title') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="company" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Company</label>
                            <select wire:model="company" id="company" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                                <option value="">-- Select --</option>
                                <option value="transcend">Transcend</option>
                                <option value="wattsavers">Wattsavers</option>
                            </select>
                            @error('company') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="client" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Client</label>
                            <input wire:model="client" type="text" id="client" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                            @error('client') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price ($)</label>
                            <input wire:model="price" type="number" step="0.01" id="price" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                            @error('price') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="date_started" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                            <input wire:model="date_started" type="date" id="date_started" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200">
                            @error('date_started') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="date_end" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">End Date <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span></label>
                            <input wire:model="date_end" type="date" id="date_end" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200">
                            @error('date_end') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" @click="$wire.showProjectModal = false" class="px-6 py-3 border border-gray-300 dark:border-gray-600 backdrop-blur-sm bg-white/70 dark:bg-gray-800/70 shadow-sm text-sm font-semibold rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 border border-transparent bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-500 dark:to-blue-500 shadow-sm text-sm font-semibold rounded-xl text-white hover:from-indigo-700 hover:to-blue-700 dark:hover:from-indigo-400 dark:hover:to-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ $operation === 'create' ? 'Create Project' : 'Update Project' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Expense Modal -->
    <div x-show="$wire.showExpenseModal" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" x-cloak>
        <div class="fixed inset-0 transform transition-all" x-on:click="$wire.showExpenseModal = false">
            <div class="absolute inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm"></div>
        </div>
        <div class="backdrop-blur-xl bg-white/90 dark:bg-gray-900/90 border border-white/20 dark:border-gray-700/50 rounded-2xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-3xl sm:mx-auto" 
             x-show="$wire.showExpenseModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="px-8 py-6 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-emerald-50/50 to-teal-50/50 dark:from-emerald-900/20 dark:to-teal-900/20">
                <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">
                    {{ $operation === 'create' ? 'Add New Expense' : 'Edit Expense' }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage project expenses and track spending</p>
            </div>
            <div class="px-8 py-6">
                <form wire:submit.prevent="saveExpense">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="project_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Project</label>
                            <select wire:model="project_id" id="project_id" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200" {{ $operation === 'edit' ? 'disabled' : '' }}>
                                <option value="">Select Project</option>
                                @foreach($projectsList as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                            @error('project_id') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Expense Type</label>
                            <input wire:model="type" type="text" id="type" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                            @error('type') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Amount ($)</label>
                            <input wire:model="amount" type="number" step="0.01" id="amount" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                            @error('amount') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="expense_for" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Expense For</label>
                            <select wire:model="expense_for" type="text" id="expense_for" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                                  <option value="">-- Select --</option>
                                @foreach ($personnels as $personnel)
                                        <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                                @endforeach
                            </select>
                            @error('expense_for') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="expense_by" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Expense By</label>
                            <select wire:model="expense_by" type="text" id="expense_by" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                                <option value="">-- Select --</option>
                                @foreach ($personnels as $personnel)
                                        <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                                @endforeach
                            </select>
                            @error('expense_by') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="date_released" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Date Released</label>
                            <input wire:model="date_released" type="date" id="date_released" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200">
                            @error('date_released') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="date_settled" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Date Settled <span class="text-gray-500 dark:text-gray-400 font-normal">(Optional)</span></label>
                            <input wire:model="date_settled" type="date" id="date_settled" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200">
                            @error('date_settled') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select wire:model="status" id="status" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200">
                                <option value="unsettled">Unsettled</option>
                                <option value="settled">Settled</option>
                            </select>
                            @error('status') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="remarks" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Remarks</label>
                            <textarea wire:model="remarks" id="remarks" rows="4" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"></textarea>
                            @error('remarks') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" @click="$wire.showExpenseModal = false" class="px-6 py-3 border border-gray-300 dark:border-gray-600 backdrop-blur-sm bg-white/70 dark:bg-gray-800/70 shadow-sm text-sm font-semibold rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 border border-transparent bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 shadow-sm text-sm font-semibold rounded-xl text-white hover:from-emerald-700 hover:to-teal-700 dark:hover:from-emerald-400 dark:hover:to-teal-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ $operation === 'create' ? 'Add Expense' : 'Update Expense' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Personnel Modal -->
    <div x-show="$wire.showPersonnelModal" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" x-cloak>
        <div class="fixed inset-0 transform transition-all" x-on:click="$wire.showPersonnelModal = false">
            <div class="absolute inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm"></div>
        </div>
        <div class="backdrop-blur-xl bg-white/90 dark:bg-gray-900/90 border border-white/20 dark:border-gray-700/50 rounded-2xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-3xl sm:mx-auto" 
             x-show="$wire.showPersonnelModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="px-8 py-6 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-emerald-50/50 to-teal-50/50 dark:from-emerald-900/20 dark:to-teal-900/20">
                <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">
                    {{ $operation === 'create' ? 'Add Personnel' : 'Edit Personnel' }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage project personnel</p>
            </div>
            <div class="px-8 py-6">
                <form wire:submit.prevent="savePersonnel">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="project_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Project</label>
                            <select wire:model="project_id" id="project_id" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white transition-all duration-200" {{ $operation === 'edit' ? 'disabled' : '' }}>
                                <option value="">Select Project</option>
                                @foreach($projectsList as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                            @error('project_id') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="personnelId" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Personnel </label>
                            <select wire:model="personnelId" type="text" id="personnelId" class="text-sm block w-full rounded-xl border-gray-300/50 dark:border-gray-600/50 bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200">
                                  <option value="">-- Select --</option>
                                @foreach ($personnels as $personnel)
                                        <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                                @endforeach
                            </select>
                            @error('personnelId') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" @click="$wire.showPersonnelModal = false" class="px-6 py-3 border border-gray-300 dark:border-gray-600 backdrop-blur-sm bg-white/70 dark:bg-gray-800/70 shadow-sm text-sm font-semibold rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 border border-transparent bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 shadow-sm text-sm font-semibold rounded-xl text-white hover:from-emerald-700 hover:to-teal-700 dark:hover:from-emerald-400 dark:hover:to-teal-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 transform hover:-translate-y-0.5 transition-all duration-200">
                            {{ $operation === 'create' ? 'Add Personnel' : 'Update Personnel' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="$wire.showDeleteConfirmation" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" x-cloak>
        <div class="fixed inset-0 transform transition-all" x-on:click="$wire.showDeleteConfirmation = false">
            <div class="absolute inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm"></div>
        </div>
        <div class="backdrop-blur-xl bg-white/90 dark:bg-gray-900/90 border border-white/20 dark:border-gray-700/50 rounded-2xl overflow-hidden shadow-2xl transform transition-all sm:w-full sm:max-w-md sm:mx-auto" 
             x-show="$wire.showDeleteConfirmation" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="px-8 py-6 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-red-50/50 to-pink-50/50 dark:from-red-900/20 dark:to-pink-900/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-100/80 dark:bg-red-900/40 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white">
                            Confirm Deletion
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">This action cannot be undone</p>
                    </div>
                </div>
            </div>
            <div class="px-8 py-6">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">Are you sure you want to delete this item? All associated data will be permanently removed from the system.</p>
            </div>
            <div class="px-8 py-6 bg-gray-50/50 dark:bg-gray-800/30 backdrop-blur-sm flex justify-end space-x-4">
                <button type="button" @click="$wire.showDeleteConfirmation = false" class="px-6 py-3 border border-gray-300 dark:border-gray-600 backdrop-blur-sm bg-white/70 dark:bg-gray-800/70 shadow-sm text-sm font-semibold rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50/80 dark:hover:bg-gray-700/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-gray-400 transition-all duration-200">
                    Cancel
                </button>
                <button type="button" @click="$wire.confirmDelete()" class="px-6 py-3 border border-transparent bg-gradient-to-r from-red-600 to-pink-600 dark:from-red-500 dark:to-pink-500 shadow-sm text-sm font-semibold rounded-xl text-white hover:from-red-700 hover:to-pink-700 dark:hover:from-red-400 dark:hover:to-pink-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-red-400 transform hover:-translate-y-0.5 transition-all duration-200">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>