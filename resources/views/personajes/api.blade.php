<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Personajes</title>
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqKxklgndQlnW8k9toFzwJyoNwWW0Lpo8g6RrRylvNHHC84ZiHovFRo_gsiGFuWCEZo2E&usqp=CAU" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/personajes.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="header text-center">
            <h1>Personajes - Rick and Morty API</h1>
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Datos Api</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('personajes.db') }}">Almacenados BD</a>
            </li>
        </ul>

        <section>
            <div class="table-container">
                <div class="table-responsive">
                    <table id="personajes" class="table table-striped table-hover">
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
                            @foreach($personajes as $char)
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
                                        <button class="btn btn-primary btn-sm d-flex gap-2 align-items-center" data-bs-toggle="modal" data-bs-target="#modal{{ $char['id'] }}">
                                            <i class="fas fa-eye"></i>Detalle
                                        </button>

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
                                                            <p><strong>Especie:</strong>
                                                                {{ $char['species'] }}
                                                            </p>
                                                            <p><strong>Tipo:</strong> 
                                                                {{ $char['type'] ?: 'No especificado' }}
                                                            </p>
                                                            <p><strong>Sexo:</strong> 
                                                                {{ $char['gender'] }}
                                                            </p>
                                                            <p><strong>Origen:</strong> 
                                                                {{ $char['origin']['name'] }}
                                                            </p>
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
                                                    <button type="button" class="btn btn-secondary" id="btnCerrar" data-bs-dismiss="modal">
                                                        <span id="spinnerCerrar" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                        <span id="textCerrar">Cerrar</span>
                                                    </button>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between align-items-center my-3">
                        <div class="d-flex justify-content-center mt-4 custom-pagination">
                            {{ $personajes->links() }}
                        </div>

                        <form method="POST" action="{{ route('personajes.save') }}" id="saveForm">
                            @csrf
                            <button type="submit" class="btn btn-success save-btn mb-3" id="saveButton">
                                <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" id="spinner"></span>
                                <i class="fas fa-save"></i> Guardar en Base de Datos
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </section>

    </div>

    <div id="spinner-overlay" style="display: none;">
        <div class="spinner-container">
            <div class="spinner-border text-light spinner-lg" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p class="text-light mt-3">Cargando...</p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function () {
                    document.getElementById('spinner-overlay').style.display = 'flex';
                });
            });

            const spinerBtn = document.querySelectorAll('.nav-link');
            spinerBtn.forEach(link => {
                link.addEventListener('click', function (e) {
                    // Mostrar spinner
                    document.getElementById('spinner').style.display = 'block';
                });
            });

        });

        document.getElementById('saveForm').addEventListener('submit', function () {
            const button = document.getElementById('saveButton');
            const spinner = document.getElementById('spinner');
            spinner.classList.remove('d-none');
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Guardando...';
            button.disabled = true;
        });

    </script>
    
</body>
</html>