
//paginacion y filtros de la tabla usuarios clientes


class Paginacion {
    constructor(id) {
        this.anterior = document.querySelector("#paginacion-" + id + " .pagina-anterior-" + id);
        this.siguiente = document.querySelector("#paginacion-" + id + " .pagina-siguiente-" + id);
        this.tbody = document.getElementById(id);
        this.usuariosPorPagina = 5;
        this.paginaActual = 1;
        this.actualizarPaginacion();
    }

    mostrarTabla() {
        this.tbody.style.display = "table-row-group";
        this.actualizarPaginacion();
    }

    ocultarTabla() {
        this.tbody.style.display = "none";
    }

    actualizarPaginacion() {
        const filas = this.tbody.querySelectorAll("tr");
        const totalUsuarios = filas.length;
        const totalPaginas = Math.ceil(totalUsuarios / this.usuariosPorPagina);

        const inicio = (this.paginaActual - 1) * this.usuariosPorPagina;
        const fin = inicio + this.usuariosPorPagina;

        filas.forEach(function(fila) {
            fila.style.display = "none";
        });

        for (let i = inicio; i < fin && i < totalUsuarios; i++) {
            filas[i].style.display = "table-row";
        }

        const numeroPagina = this.paginaActual + " de " + totalPaginas;
        document.getElementById("pagina-actual-" + this.tbody.id).textContent = "Página " + numeroPagina;


        if (this.paginaActual >= totalPaginas) {
            this.siguiente.style.display = "none";
        } else {
            this.siguiente.style.display = "inline"; // O muestra la etiqueta si no estás en el límite
        }
    }

    cambiarPagina(cambio) {
        this.paginaActual += cambio;
        if (this.paginaActual < 1) {
            this.paginaActual = 1;
        }
        this.actualizarPaginacion();
    }
}



document.addEventListener("DOMContentLoaded", function() {
    var filtroUsuarios = document.getElementById("filtro-estado");
    var tablas = {
        "todos": new Paginacion("todos"),
        "activos": new Paginacion("activos"),
        "inactivos": new Paginacion("inactivos")
    };

    // Ocultar todas las paginaciones
    ocultarTodasLasPaginaciones();

    // Mostrar la paginación "todos" por defecto
    mostrarPaginacion("todos");

    filtroUsuarios.addEventListener("change", function() {
        var filtro = filtroUsuarios.value;

        Object.keys(tablas).forEach(function(key) {
            tablas[key].ocultarTabla();
        });

        tablas[filtro].mostrarTabla();

        ocultarTodasLasPaginaciones();
        mostrarPaginacion(filtro);
    });

    // Manejo de la paginación "todos"
    document.querySelector("#paginacion-todos .pagina-anterior-todos").addEventListener("click", function(event) {
        event.preventDefault();
        tablas["todos"].cambiarPagina(-1);
        tablas["todos"].actualizarPaginacion();
    });

    document.querySelector("#paginacion-todos .pagina-siguiente-todos").addEventListener("click", function(event) {
        event.preventDefault();
        tablas["todos"].cambiarPagina(1);
        tablas["todos"].actualizarPaginacion();
    });

    

    // Manejo de la paginación "activos"
    document.querySelector("#paginacion-activos .pagina-anterior-activos").addEventListener("click", function(event) {
        event.preventDefault();
        tablas["activos"].cambiarPagina(-1);
        tablas["activos"].actualizarPaginacion();
    });

    document.querySelector("#paginacion-activos .pagina-siguiente-activos").addEventListener("click", function(event) {
        event.preventDefault();
        tablas["activos"].cambiarPagina(1);
        tablas["activos"].actualizarPaginacion();
    });

    //Manejo de la paginacion "inactivos"
    document.querySelector("#paginacion-inactivos .pagina-anterior-inactivos").addEventListener("click", function(event){
        event.preventDefault();
        tablas["inactivos"].cambiarPagina(-1);
        tablas["inactivos"].actualizarPaginacion();
    });

    document.querySelector("#paginacion-inactivos .pagina-siguiente-inactivos").addEventListener("click", function(event){
        event.preventDefault();
        tablas["inactivos"].cambiarPagina(1);
        tablas["inactivos"].actualizarPaginacion();
    });


    var inputBusqueda = document.querySelector(".record-search-todos");
    inputBusqueda.addEventListener("input", function() {
        var filtro = inputBusqueda.value.trim().toLowerCase();
        filtrarUsuarios("todos", filtro);
        if (filtro === "") {
            // Si el filtro está vacío, muestra la página actual en lugar de la primera página
            var paginaActual = tablas["todos"].paginaActual;
            mostrarPaginacion("todos", paginaActual);
        }
    })

    

    function ocultarTodasLasPaginaciones() {
        document.querySelectorAll(".pagination").forEach(function(paginacion) {
            paginacion.style.display = "none";
        });
    }

    function mostrarPaginacion(paginacionId) {
        var paginacionElement = document.getElementById("paginacion-" + paginacionId);
        if (paginacionElement) {
            paginacionElement.style.display = "block";
        }
        tablas[paginacionId].cambiarPagina;
        tablas[paginacionId].actualizarPaginacion();
    }

    function filtrarUsuarios(id, filtro) {
        var filas = document.getElementById(id).querySelectorAll("tr");

        filas.forEach(function(fila) {
            var correo = fila.querySelector("td div.client-info small").textContent.trim().toLowerCase();
            if (correo.startsWith(filtro)) {
                fila.style.display = "table-row";
            } else {
                fila.style.display = "none";
            }
        });
    }
});