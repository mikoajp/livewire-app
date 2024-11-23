<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $filterCategory = '';
    public $isOpen = false;
    public $name, $email, $phone, $client_id;

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['filter-updated' => 'loadClients'];
    public function updated($property)
    {
        if (in_array($property, ['search', 'filterStatus', 'filterCategory'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.clients', [
            'clients' => $this->loadClients(),
        ]);
    }

    public function loadClients()
    {
        $this->resetPage();
        return Client::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->filterCategory, function ($query) {
                $query->where('category', $this->filterCategory);
            })
            ->select(['id', 'name', 'email', 'phone'])
            ->paginate(10);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        Client::updateOrCreate(['id' => $this->client_id], [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', $this->client_id ? 'Client Updated Successfully.' : 'Client Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->client_id = null;
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        $this->client_id = $client->id;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone = $client->phone;

        $this->isOpen = true;
    }

    public function delete($id)
    {
        Client::findOrFail($id)->delete();

        session()->flash('message', 'Client Deleted Successfully.');
        $this->resetPage();
    }
}
