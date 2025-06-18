<!DOCTYPE html>
<html>
<head>
    <title>Personajes en Base de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/personajes.css') }}">

</head>

<body>
    <div class="container">
    
        <header class="header text-center">
            
            <h1 class="ml-3">Personajes Almacenados</h1>
            <form method="get" action="{{ route('home') }}">
                @csrf
                <button type="submit" class="btn btn-success save-btn">
                    <i class="fas fa-save"></i> Inicio
                </button>
            </form>
        </header>

        @if (session('success'))
            <p id="success-alert" class="alert alert-success text-center" role="alert">{{ session('success') }}</p>
        @endif

        <div class="table-container">
            <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Spaecie</th>
                    <th>Imagen</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Personajes as $char)

                    <!-- <h1> {{$char}} </h1> -->
                    <tr>
                        <td>{{ $char->id }}</td>
                        <td>{{ $char->name }}</td>
                        <td>
                            <span class="badge 
                                {{ $char['status'] == 'Alive' ? 'bg-success' : 
                                    ($char['status'] == 'Dead' ? 'bg-danger' : 'bg-warning') }}">
                                {{ $char['status'] }}
                            </span>
                        </td>
                        <td>{{ $char->species }}</td>
                        <td><img class="personaje-img" src="{{ $char->image }}" width="50"/></td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $char['id'] }}">
                                <i class="fas fa-eye"></i> Editar
                            </button>


                            <div class="modal fade" id="modal{{ $char['id'] }}" tabindex="-1" aria-labelledby="modalLabel{{ $char['id'] }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('personajes.update', $char->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title" id="modalLabel{{ $char['id'] }}">Editar: {{ $char['name'] }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>

                                            <div class="modal-body row">
                                                <div class="col-md-4 text-center">
                                                    <img src="{{ $char['image'] }}" width="100%" class="img-thumbnail mb-3" />
                                                    <div class="mb-2">
                                                        <label for="image{{ $char->id }}" class="form-label">URL Imagen</label>
                                                        <input type="text" class="form-control" name="image" id="image{{ $char->id }}" value="{{ $char->image }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="mb-2">
                                                        <label for="name{{ $char->id }}" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" name="name" id="name{{ $char->id }}" value="{{ $char->name }}">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="status{{ $char->id }}" class="form-label">Estado</label>
                                                        <input type="text" class="form-control" name="status" id="status{{ $char->id }}" value="{{ $char->status }}">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="species{{ $char->id }}" class="form-label">Especie</label>
                                                        <input type="text" class="form-control" name="species" id="species{{ $char->id }}" value="{{ $char->species }}">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="type{{ $char->id }}" class="form-label">Tipo</label>
                                                        <input type="text" class="form-control" name="type" id="type{{ $char->id }}" value="{{ $char->type }}">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="sex{{ $char->id }}" class="form-label">Sexo</label>
                                                        <input type="text" class="form-control" name="sex" id="sex{{ $char->id }}" value="{{ $char->sex }}">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="origin_name{{ $char->id }}" class="form-label">Origen</label>
                                                        <input type="text" class="form-control" name="origin_name" id="origin_name{{ $char->id }}" value="{{ $char->origin_name }}">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="origin_url{{ $char->id }}" class="form-label">URL Origen</label>
                                                        <input type="text" class="form-control" name="origin_url" id="origin_url{{ $char->id }}" value="{{ $char->origin_url }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function () {
            const alert = document.getElementById('success-alert');
            console.log(alert)
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = 0;
                setTimeout(() => alert.remove(), 500); // Remover del DOM después de desvanecer
            }
        }, 3000);
    </script>
</body>
</html>
