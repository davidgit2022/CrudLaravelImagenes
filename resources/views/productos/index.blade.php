<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ route('productos.create') }}"
                    class="bg-indigo-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-indigo-800 transition duration-200 each-in-out">Crear</a>
                    <br>
                <table class="table-fixed w-full">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th>ID</th>
                            <th class="border px-4 py-2">NOMBRE</th>
                            <th class="border px-4 py-2">DESCRIPCION</th>
                            <th class="border px-4 py-1">IMAGEN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->name }}</td>
                                <td>{{ $producto->description }}</td>
                                <td> <img src="/image/{{ $producto->image }}" width="60%"></td>
                                <td class="border px-4 py-2">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                        {{-- Boton editar --}}
                                        <a href="{{ route('productos.edit', $producto->id) }}"
                                            class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>
                                        {{-- Boton borrar --}}
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="post"
                                            class="formEliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4">Borrar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">
                    {!! $productos->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        let forms = document.querySelectorAll('.formEliminar')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault()
                    event.stopPropagation()

                    Swal.fire({
                        title: '¿Confirma la eliminación del registro?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#20c997',
                        cancelButtonColor: '#6c757d',
                        cancelButtonText: 'Confirmar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire('¡Eliminado!',
                                'El registro a sido eliminado exitosamente.', 'success');
                        }
                    })
                }, false)
            })

    })()
</script>
