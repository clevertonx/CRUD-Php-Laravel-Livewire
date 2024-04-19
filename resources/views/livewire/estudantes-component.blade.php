<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h5 style="float: left;"><strong>Todos estudantes</strong></h5>
                        <button class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal"
                                data-bs-target="#addEstudanteModal">Add novo estudante
                        </button>

                    </div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if( $estudantes->count() > 0 )
                                @foreach( $estudantes as $estudante )
                                    <tr>
                                        <td>{{ $estudante->estudante_id }}</td>
                                        <td>{{ $estudante->nome }}</td>
                                        <td>{{ $estudante->email }}</td>
                                        <td>{{ $estudante->telefone }}</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-secondary" wire:click="viewEstudanteInfo({{ $estudante->id }})">Ver</button>
                                            <button class="btn btn-sm btn-primary"
                                                    wire:click="edit({{ $estudante->id }})">Editar
                                            </button>
                                            <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $estudante->id }})">Excluir
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" style="text-align: center;"><small>Nenhum estudante
                                            encontrado</small></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="addEstudanteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Novo Estudante</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group row">
                            <label for="estudante_id" class="col-3">Estudante ID</label>
                            <div class="col-9">
                                <input type="number" id="estudante_id" class="form-control" wire:model="estudante_id">
                                @error('estudante_id')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-3">Nome</label>
                            <div class="col-9">
                                <input type="text" id="nome" class="form-control" wire:model="nome">
                                @error('nome')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-3">Telefone</label>
                            <div class="col-9">
                                <input type="number" id="telefone" class="form-control" wire:model="telefone">
                                @error('telefone')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Add Estudante</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editEstudanteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Estudante</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editEstudantedata">
                        <div class="form-group row">
                            <label for="estudante_id" class="col-3">Estudante ID</label>
                            <div class="col-9">
                                <input type="number" id="estudante_id" class="form-control" wire:model="estudante_id">
                                @error('estudante_id')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nome" class="col-3">Nome</label>
                            <div class="col-9">
                                <input type="text" id="nome" class="form-control" wire:model="nome">
                                @error('nome')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model="email">
                                @error('email')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telefone" class="col-3">Telefone</label>
                            <div class="col-9">
                                <input type="number" id="telefone" class="form-control" wire:model="telefone">
                                @error('telefone')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Editar Estudante</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deleteEstudanteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Estudante</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Deseja excluir esse estudante?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-bs-dismiss="modal" aria-label="close">Cancelar</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteEstudante()">Sim, excluir!</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="viewEstudanteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Informação Estudante</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeViewEstudanteModal"></button>
                </div>
                <div class="modal-body">
                   <table class="table table bordered">
                       <tbody>
                       <tr>
                           <th>ID: </th>
                           <td>{{ $view_estudante_id }}</td>
                       </tr>
                       <tr>
                           <th>Nome: </th>
                           <td>{{ $view_estudante_nome }}</td>
                       </tr>
                       <tr>
                           <th>Email: </th>
                           <td>{{ $view_estudante_email }}</td>
                       </tr>
                       <tr>
                           <th>Telefone: </th>
                           <td>{{ $view_estudante_telefone }}</td>
                       </tr>
                       </tbody>
                   </table>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var addEstudanteModal = new bootstrap.Modal(document.getElementById('addEstudanteModal'));
        var editEstudanteModal = new bootstrap.Modal(document.getElementById('editEstudanteModal'));
        var deleteEstudanteModal = new bootstrap.Modal(document.getElementById('deleteEstudanteModal'));
        var viewEstudanteModal = new bootstrap.Modal(document.getElementById('viewEstudanteModal'));


        var closeModalEvent = new Event('close-modal');
        var showEditEstudanteModalEvent = new Event('show-edit-estudante-modal');
        var showDeleteEstudanteModalEvent = new Event('show-delete-estudante-modal');
        var showViewEstudanteModalEvent = new Event('show-view-estudante-modal')

        window.addEventListener('close-modal', function () {
            addEstudanteModal.hide();
        });

        window.addEventListener('close-modal', function () {
            editEstudanteModal.hide();
        });

        window.addEventListener('close-modal', function () {
            deleteEstudanteModal.hide();
        });

        window.addEventListener('close-modal', function () {
            viewEstudanteModal.hide();
        });

        window.addEventListener('show-edit-estudante-modal', function () {
            editEstudanteModal.show();
        });

        window.addEventListener('show-delete-estudante-modal', function () {
            deleteEstudanteModal.show();
        });

        window.addEventListener('show-view-estudante-modal', function () {
            viewEstudanteModal.show();
        });
    </script>
@endpush
