<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Projects;
use App\Models\Expenses;
use App\Models\ProjectPersonel;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Project Management')]
class ProjectManagement extends Component
{
    use WithPagination;

    public $projects = [];
    public $expenses = [];
    public $showProjectModal = false;
    public $showExpenseModal = false;
    public $showPersonnelModal = false;
    public $showDeleteConfirmation = false;
    public $currentProjectId = null;
    public $currentExpenseId = null;
    public $currentPersonnelId = null;
    public $personnelId;
    public $totalExpenses = 0;
    public $operation = 'create'; // 'create' or 'edit'

    // Project form fields
    public $title = '';
    public $company = '';
    public $client = '';
    public $price = '';
    public $date_started = '';
    public $date_end = '';
    public $tor = '';
    public $rfq = '';

    // Expense form fields
    public $project_id = '';
    public $type = '';
    public $amount = '';
    public $expense_for = '';
    public $expense_by = '';
    public $date_released = '';
    public $date_settled = '';
    public $status = 'pending';
    public $remarks = '';
    public $personnels;

        public $pageSize = 10; 
    public $pageSizes = [10, 20, 30, 50, 100]; 

    public function mount()
    {
        $this->projects = Projects::with('expenses')->latest()->get();
        $this->personnels = User::where('user_role', 'user')->get();
    }

    public function render()
    {
        $projectList = Projects::with('expenses', 'personnel')->paginate($this->pageSize);
        $projectList->getCollection()->transform(function ($project) {
            if(strtolower($project->company) == 'transcend'){
                $project->revenue = $project->price;
            }else{
                $project->revenue = ($project->price - ($project->price * 0.12)) * 0.40;
            }
            $project->total_expenses = $project->expenses->sum('amount');
            return $project;
        });


        return view('livewire.project-management', [
            'projectsList' => $projectList,
        ]);
    }

    public function createProject()
    {
        $this->operation = 'create';
        $this->resetProjectForm();
        $this->showProjectModal = true;
    }

    public function editProject($id)
    {
        $this->operation = 'edit';
        $this->currentProjectId = $id;
        $project = Projects::findOrFail($id);
        
        $this->title = $project->title;
        $this->company = $project->company;
        $this->client = $project->client;
        $this->price = $project->price;
        $this->date_started = $project->date_started->format('Y-m-d');
        $this->date_end = $project->date_end?->format('Y-m-d');
        $this->tor = $project->tor;
        $this->rfq = $project->rfq;

        $this->showProjectModal = true;
    }

    public function saveProject()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'date_started' => 'required|date',
        ]);

        $data = [
            'title' => $this->title ?? null,
            'company' => $this->company ?? null,
            'client' => $this->client ?? null,
            'price' => $this->price ?? null,
            'date_started' => $this->date_started ?? null,
            'date_end' => $this->date_end && $this->date_end != '' ? $this->date_end : null,
            'tor' => $this->tor && $this->tor != '' ? $this->tor : null,
            'rfq' => $this->rfq && $this->rfq != '' ? $this->rfq : null,
        ];

        if ($this->operation === 'create') {
            Projects::create($data);
            session()->flash('message', 'Project created successfully.');
        } else {
            Projects::findOrFail($this->currentProjectId)->update($data);
            session()->flash('message', 'Project updated successfully.');
        }

        $this->showProjectModal = false;
        $this->resetProjectForm();
        $this->mount();
    }

    public function deleteProject($id)
    {
        $this->currentProjectId = $id;
        $this->showDeleteConfirmation = true;
    }

    public function confirmDelete()
    {
        if($this->currentPersonnelId){
            $this->confirmPersonnelDelete();
            return;
        }

        if($this->currentProjectId){
            Projects::findOrFail($this->currentProjectId)->delete();
            session()->flash('message', 'Project deleted successfully.');
            $this->showDeleteConfirmation = false;
            $this->mount();

            return;
        }
    }

    public function resetProjectForm()
    {
        $this->reset([
            'title', 'company', 'client', 'price', 
            'date_started', 'date_end', 'tor', 'rfq',
            'currentProjectId'
        ]);
    }

    // Expense CRUD operations
    public function toggleAddExpense($projectId)
    {
        $this->operation = 'create';
        $this->project_id = $projectId;
        $this->resetExpenseForm();
        $this->showExpenseModal = true;
    }

    public function editExpense($id)
    {
        $this->operation = 'edit';
        $this->currentExpenseId = $id;
        $expense = Expenses::findOrFail($id);
        
        $this->project_id = $expense->project_id;
        $this->type = $expense->type;
        $this->amount = $expense->amount;
        $this->expense_for = $expense->expense_for;
        $this->expense_by = $expense->expense_by;
        $this->date_released = $expense->date_released->format('Y-m-d');
        $this->date_settled = $expense->date_settled?->format('Y-m-d');
        $this->status = $expense->status;
        $this->remarks = $expense->remarks;

        $this->showExpenseModal = true;
    }

    public function saveExpense()
    {
        $this->validate([
            'project_id' => 'required|exists:projects,id',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_for' => 'required|string|max:255',
            'expense_by' => 'required|string|max:255',
            'date_released' => 'required|date',
            'status' => 'required|in:pending,settled,rejected',
        ]);

        $dateSettled = null;
        if($this->date_settled){
            $dateSettled = $this->date_settled;
        }elseif($this->status == 'settled' && !$this->date_settled){
            $dateSettled = now();
        }

        $data = [
            'project_id' => $this->project_id ?? null,
            'type' => $this->type ?? null,
            'amount' => $this->amount ?? null,
            'expense_for' => $this->expense_for ?? null,
            'expense_by' => $this->expense_by ?? null,
            'date_released' => $this->date_released ?? null,
            'date_settled' => $dateSettled,
            'status' => $this->status ?? null,
            'remarks' => $this->remarks && $this->remarks != '' ? $this->remarks : null,
        ];

        if ($this->operation === 'create') {
            Expenses::create($data);
            session()->flash('message', 'Expense created successfully.');
        } else {
            Expenses::findOrFail($this->currentExpenseId)->update($data);
            session()->flash('message', 'Expense updated successfully.');
        }

        $this->showExpenseModal = false;
        $this->resetExpenseForm();
        $this->mount();
    }

    public function deleteExpense($id)
    {
        $this->currentExpenseId = $id;
        $this->showDeleteConfirmation = true;
    }

    public function confirmExpenseDelete()
    {
        Expenses::findOrFail($this->currentExpenseId)->delete();
        session()->flash('message', 'Expense deleted successfully.');
        $this->showDeleteConfirmation = false;
        $this->mount();
    }

    public function resetExpenseForm()
    {
        $this->reset([
            'type', 'amount', 'expense_for', 'expense_by',
            'date_released', 'date_settled', 'status', 'remarks',
            'currentExpenseId'
        ]);
    }

    // Personnel CRUD operations
    public function toggleAddPersonnel($projectId)
    {
        $this->operation = 'create';
        $this->project_id = $projectId;
        $this->resetPersonnelForm();
        $this->showPersonnelModal = true;
    }

    public function editPersonnel($id)
    {
        $this->operation = 'edit';
        $this->currentPersonnelId = $id;
        $expense = ProjectPersonel::findOrFail($id);
        
        $this->project_id = $expense->project_id;
        $this->personnelId = $expense->user_id;

        $this->showPersonnelModal = true;
    }

    public function savePersonnel()
    {
        $this->validate([
            'project_id' => 'required|exists:projects,id',
            'personnelId' => 'required',
        ]);

        $data = [
            'project_id' => $this->project_id ?? null,
            'user_id' => $this->personnelId ?? null,
        ];

        if ($this->operation === 'create') {
            ProjectPersonel::create($data);
            session()->flash('message', 'Expense created successfully.');
        } else {
            ProjectPersonel::findOrFail($this->currentExpenseId)->update($data);
            session()->flash('message', 'Expense updated successfully.');
        }

        $this->showPersonnelModal = false;
        $this->resetPersonnelForm();
        $this->mount();
    }

    public function deletePersonnel($id)
    {
        $this->currentPersonnelId = $id;
        $this->showDeleteConfirmation = true;
    }

    public function confirmPersonnelDelete()
    {
        ProjectPersonel::findOrFail($this->currentPersonnelId)->delete();
        session()->flash('message', 'Expense deleted successfully.');
        $this->showDeleteConfirmation = false;
        $this->mount();
    }

    public function resetPersonnelForm()
    {
        $this->reset([
            'personnelId'
        ]);
    }


    // Helpers ------------------------- //
    public function getUsersName($id){
        $user = User::findOrFail($id);
        if($user){
            return $user->name;
        }

        return '';
    }
}
