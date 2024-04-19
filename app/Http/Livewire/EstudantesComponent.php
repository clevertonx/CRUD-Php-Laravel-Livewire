<?php

namespace App\Http\Livewire;

use App\Models\Estudantes;
use Livewire\Component;


class EstudantesComponent extends Component
{
    public $estudante_id, $nome, $email, $telefone, $estudante_delete_id;

    public $view_estudante_id, $view_estudante_nome, $view_estudante_email, $view_estudante_telefone;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'estudante_id' => 'required|unique:estudantes',
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|numeric']);
    }

    public function store()
    {

        $this->validate([
            'estudante_id' => 'required|unique:estudantes',
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|numeric']);

        $estudante = new Estudantes();
        $estudante->estudante_id = $this->estudante_id;
        $estudante->nome = $this->nome;
        $estudante->email = $this->email;
        $estudante->telefone = $this->telefone;

        $estudante->save();

        session()->flash('message', 'Estudante Cadastrado com sucesso!');

        $this->resetInputs();
        $this->isModalOpen = false;

        $this->estudante_id = '';
        $this->nome = '';
        $this->email = '';
        $this->telefone = '';

        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {
        $this->estudante_id = '';
        $this->nome = '';
        $this->email = '';
        $this->telefone = '';
        $this->estudante_edit_id = '';
    }

    public function edit($id)
    {
        $estudante = Estudantes::where('id', $id)->first();

        $this->estudante_edit_id = $estudante->id;
        $this->estudante_id = $estudante->estudante_id;
        $this->nome = $estudante->nome;
        $this->email = $estudante->email;
        $this->telefone = $estudante->telefone;


        $this->dispatchBrowserEvent('show-edit-estudante-modal');
    }

    public function editEstudantedata()
    {
        $this->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required|numeric',
        ]);

        $estudante = Estudantes::where('id', $this->estudante_edit_id)->first();

        $estudante->estudante_id = $this->estudante_id;
        $estudante->nome = $this->nome;
        $estudante->email = $this->email;
        $estudante->telefone = $this->telefone;

        $estudante->update();

        session()->flash('message', 'Estudante Alterado com sucesso!');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteConfirmation($id)
    {


        $this->estudante_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-estudante-modal');

    }

    public function deleteEstudante()
    {
        $estudante = Estudantes::where('id', $this->estudante_delete_id)->first();
        $estudante->delete();

        session()->flash('message', 'Estudante Excluído com sucesso!');

        $this->dispatchBrowserEvent('close-modal');

        $this->estudante_delete_id = '';
    }

    public function viewEstudanteInfo($id)
    {
        $estudante = Estudantes::where('id', $id)->first();

        $this->view_estudante_id = $estudante->id;
        $this->view_estudante_nome = $estudante->nome;
        $this->view_estudante_email = $estudante->email;
        $this->view_estudante_telefone = $estudante->telefone;

        $this->dispatchBrowserEvent('show-view-estudante-modal');
    }

    function closeViewEstudanteModal()
    {
        $this->view_etudante_id = '';
        $this->view_estudante_nome = '';
        $this->view_estudante_email = '';
        $this->view_estudante_telefone = '';
    }

    public function cancel()
    {
        $this->estudante_delete_id = '';
    }

    public function render()
    {
        $estudantes = Estudantes::all();

        return view('livewire.estudantes-component', ['estudantes'=>$estudantes])->layout('livewire.layouts.base');
    }
}
