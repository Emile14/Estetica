@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-xl border-t-[8px] border-rosa-fuerte">
    <h2 class="text-3xl font-playfair font-bold text-oscuro mb-6">
        {{ auth()->user()->rol == 'Cliente' ? 'Nueva Solicitud de Cita' : 'Agendar Cita Oficial' }}
    </h2>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl mb-6 font-bold shadow-sm">
            <i class="bi bi-exclamation-circle-fill mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('citas.store') }}" method="POST" id="citaForm">
        @csrf

        @if(auth()->user()->rol != 'Cliente')
        <div class="bg-gray-50 p-6 rounded-2xl mb-6 border border-gray-200">
            <h3 class="font-bold text-oscuro mb-4"><i class="bi bi-person-badge"></i> Datos del Cliente</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block font-bold text-gray-700 mb-2">Seleccionar Cliente</label>
                    <select name="cliente_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl outline-none focus:ring-2 focus:ring-rosa-glow" required>
                        <option value="">Selecciona a quién le vas a agendar...</option>
                        @foreach(\App\Models\Cliente::all() as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block font-bold text-gray-700 mb-2">Servicio Principal</label>
                <select name="servicio" id="servicio" class="w-full px-4 py-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-rosa-glow" required>
                    <option value="" data-precio="0">Selecciona un servicio...</option>
                    @foreach($servicios as $s)
                        <option value="{{ $s->nombre }}" data-precio="{{ $s->precio }}">{{ $s->nombre }} (${{ $s->precio }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-bold text-gray-700 mb-2">Fecha y Hora</label>
                <div class="flex gap-2">
                    <input type="date" name="fecha" required class="flex-1 px-4 py-3 border border-gray-200 rounded-xl outline-none">
                    <input type="time" name="hora" required class="w-32 px-4 py-3 border border-gray-200 rounded-xl outline-none">
                </div>
            </div>
        </div>

        <div class="bg-rosa-glow/10 p-6 rounded-2xl mb-8 border border-rosa-glow/30">
            <h3 class="font-bold text-rosa-fuerte mb-4"><i class="bi bi-bag-plus"></i> ¿Deseas apartar un producto? (Opcional)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <select name="producto_id" id="producto_id" class="px-4 py-3 border border-gray-200 rounded-xl outline-none bg-white transition">
                    <option value="" data-precio="0">Ninguno</option>
                    @foreach($productos as $p)
                        <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">{{ $p->nombre }} (${{ $p->precio }})</option>
                    @endforeach
                </select>
                <input type="number" name="cantidad_producto" id="cantidad" value="1" min="1" class="px-4 py-3 border border-gray-200 rounded-xl outline-none transition duration-200" placeholder="Cantidad">
            </div>
        </div>

        <div class="flex justify-between items-center bg-oscuro text-white p-6 rounded-2xl mb-8">
            <div>
                <p class="text-sm text-gray-400">Total Estimado (Cotización):</p>
                <h4 class="text-3xl font-bold" id="totalLabel">$0.00</h4>
            </div>
            <button type="submit" class="bg-rosa-fuerte text-white px-8 py-3 rounded-xl font-bold hover:scale-105 transition shadow-lg">
                {{ auth()->user()->rol == 'Cliente' ? 'Enviar Solicitud' : 'Guardar en Agenda' }}
            </button>
        </div>
    </form>
</div>

<script>
    const servicio = document.getElementById('servicio');
    const producto = document.getElementById('producto_id');
    const cantidad = document.getElementById('cantidad');
    const totalLabel = document.getElementById('totalLabel');

    function actualizarEstadoProducto() {
        if (!producto.value || producto.value === "") {
            // Bloquea el campo, lo regresa a 1 y lo oscurece si es "Ninguno"
            cantidad.disabled = true;
            cantidad.value = 1;
            cantidad.classList.add('bg-gray-100', 'opacity-60', 'cursor-not-allowed');
        } else {
            // Habilita el campo si elige un producto
            cantidad.disabled = false;
            cantidad.classList.remove('bg-gray-100', 'opacity-60', 'cursor-not-allowed');
        }
        calcularTotal();
    }

    function calcularTotal() {
        let precioServicio = parseFloat(servicio.options[servicio.selectedIndex]?.getAttribute('data-precio') || 0);
        let precioProducto = parseFloat(producto.options[producto.selectedIndex]?.getAttribute('data-precio') || 0);
        
        // Si el campo de cantidad está deshabilitado, forzamos que matemáticamente sea 0 para el cálculo
        let cant = cantidad.disabled ? 0 : parseInt(cantidad.value || 0);

        let total = precioServicio + (precioProducto * cant);
        totalLabel.innerText = `$${total.toFixed(2)}`;
    }

    // Escuchamos los cambios en tiempo real
    servicio.addEventListener('change', calcularTotal);
    producto.addEventListener('change', actualizarEstadoProducto);
    cantidad.addEventListener('input', calcularTotal);

    // Lo ejecutamos al cargar la página por si "Ninguno" es la opción por defecto
    document.addEventListener("DOMContentLoaded", actualizarEstadoProducto);
</script>
@endsection