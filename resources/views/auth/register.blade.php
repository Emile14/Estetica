@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <label for="pais" class="col-md-4 col-form-label text-md-end">País de Origen</label>
                            <div class="col-md-6">
                                <select id="pais" class="form-control" name="pais" required>
                                    <option value="">Cargando países...</option>
                                </select>
                            </div>
                        </div>

                        <div id="country-details" class="row mb-3" style="display: none;">
                            <div class="col-md-6 offset-md-4">
                                <div class="card p-3 shadow-sm bg-light">
                                    <div class="d-flex align-items-center mb-3">
                                        <img id="flag-img" src="" alt="Bandera" width="60" class="me-3 border rounded">
                                        <h5 id="country-name" class="mb-0 fw-bold"></h5>
                                    </div>
                                    <ul class="list-unstyled mb-0 small">
                                        <li><strong>Capital:</strong> <span id="capital-text"></span></li>
                                        <li><strong>Moneda:</strong> <span id="currency-text"></span></li>
                                        <li><strong>Idiomas:</strong> <span id="language-text"></span></li>
                                        <li><strong>Zona Horaria:</strong> <span id="timezone-text"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function() {
    const paisSelect = document.getElementById('pais');
    const detailsDiv = document.getElementById('country-details');
    let countriesData = [];

    // URL CORREGIDA CON LOS CAMPOS OBLIGATORIOS
    const apiUrl = 'https://restcountries.com/v3.1/all?fields=name,capital,currencies,languages,timezones,flags';

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la petición: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            countriesData = data;
            
            // Ordenar alfabéticamente
            data.sort((a, b) => a.name.common.localeCompare(b.name.common));

            // Limpiar y llenar el select
            paisSelect.innerHTML = '<option value="">Selecciona tu país...</option>';
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common;
                option.textContent = country.name.common;
                paisSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al conectar con la API:', error);
            paisSelect.innerHTML = '<option value="">Error al cargar países</option>';
        });

    // Escuchar el cambio de país
    paisSelect.addEventListener('change', function() {
        const selectedCountry = countriesData.find(c => c.name.common === this.value);

        if (selectedCountry) {
            document.getElementById('country-name').innerText = selectedCountry.name.common;
            document.getElementById('flag-img').src = selectedCountry.flags.svg;
            
            document.getElementById('capital-text').innerText = (selectedCountry.capital && selectedCountry.capital.length > 0) ? selectedCountry.capital[0] : 'N/A';
            
            let currencyInfo = 'N/A';
            if (selectedCountry.currencies && Object.keys(selectedCountry.currencies).length > 0) {
                const firstCurrencyKey = Object.keys(selectedCountry.currencies)[0];
                const currency = selectedCountry.currencies[firstCurrencyKey];
                currencyInfo = `${currency.name} (${currency.symbol || ''})`;
            }
            document.getElementById('currency-text').innerText = currencyInfo;

            const languages = selectedCountry.languages ? Object.values(selectedCountry.languages).join(', ') : 'N/A';
            document.getElementById('language-text').innerText = languages;

            document.getElementById('timezone-text').innerText = (selectedCountry.timezones && selectedCountry.timezones.length > 0) ? selectedCountry.timezones[0] : 'N/A';

            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
    });
};
</script>
@endsection