<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Characters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/personajes.css') }}">

</head>
<body>
    <div class="container">
        <div class="header text-center">
            <h1>Personajes desde la API</h1>
        </div>
        
        <form method="POST" action="{{ route('personajes.save') }}">
            @csrf
            <button type="submit" class="btn btn-success save-btn mb-3">
                <i class="fas fa-save"></i> Guardar en Base de Datos
            </button>
        </form>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Specie</th>
                            <th>Imagen</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Personajes as $char)
                            <tr>
                                <td>{{ $char['id'] }}</td>
                                <td><strong>{{ $char['name'] }}</strong></td>
                                <td>
                                    <span class="badge 
                                        {{ $char['status'] == 'Alive' ? 'bg-success' : 
                                           ($char['status'] == 'Dead' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ $char['status'] }}
                                    </span>
                                </td>
                                <td>{{ $char['species'] }}</td>
                                <td><img src="{{ $char['image'] }}" width="50" class="personaje-img "/></td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $char['id'] }}">
                                        <i class="fas fa-eye"></i>Detalle
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{ $char['id'] }}" tabindex="-1" aria-labelledby="modalLabel{{ $char['id'] }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark text-white">
                                                    <h5 class="modal-title" id="modalLabel{{ $char['id'] }}">{{ $char['name'] }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ $char['image'] }}" width="200" class="persoanje-img mb-4" />
                                                    <div class="text-start">
                                                        <p><strong>Estado:</strong> 
                                                            <span class="badge 
                                                                {{ $char['status'] == 'Alive' ? 'bg-success' : 
                                                                   ($char['status'] == 'Dead' ? 'bg-danger' : 'bg-warning') }}">
                                                                {{ $char['status'] }}
                                                            </span>
                                                        </p>
                                                        <p><strong>Especie:</strong> {{ $char['species'] }}</p>
                                                        <p><strong>Tipo:</strong> {{ $char['type'] ?: 'No especificado' }}</p>
                                                        <p><strong>Sexo:</strong> {{ $char['gender'] }}</p>
                                                        <p><strong>Origen:</strong> {{ $char['origin']['name'] }}</p>
                                                        <p><strong>URL Origen:</strong> 
                                                            @if($char['origin']['url'])
                                                            <a href="{{ $char['origin']['url'] }}" target="_blank">Ver ubicación</a>
                                                            @else
                                                            N/A
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
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
    </div>

    <!-- Font Awesome para iconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>