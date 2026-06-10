# Reto Mundialista

es una página web para que los trabajadores de la universidad Unicatólica en Cali - Colombia jueguen a la polla mundialista, del mundial de fútbol 2026, pero además de adivinar los marcadores, también habrá trivias de preguntas sobre la institución.

## Requerimientos

### Todos

- cualquier persona sin login puede ingresar a la página home y observar el estado del mundial, filtrando por etapas puede ver en la tabla los equipos enfrentados, fechas y resultados en goles.

- cualquier persona sin login puede ver la tabla de jugadores en la clasificación por puntos, viendo puntos totales de cada uno para adivinación de resultados, trivia y su sumatoria.

### Jugador

- en inicio cualquier persona puede crear un registro, usando su cédula como ID único, pero aún no tendrá permisos para nada ni se verá en la tabla de jugadores, al logearse así verá solo la información que le dice, por favor diríjase a X lugar para que el administrador reciba su dinero y le de ingreso.

- podrá hacer login y logout, además una vez el administrador le ha dado ingreso, podrá interactuar con el sistema.

- cuando un partido tenga los dos equipos enfrentados ya definidos y la fecha y hora de inicio del juego aún no ha pasado, el jugador puede ingresar su adivinación de cuántos goles hará cada equipo, y qué equipo ganará (dos tipos diferentes de adivinación).

- cuando elija la adivinación, podrá también responder una pregunta de trivia, esta se elige al azar de un banco, sin poder repetirse para el jugador, además la pregunta queda guardada en apuestas, por si se cierra el forms antes de contestar, la pregunta elegida queda a la espera.

- cuando se cargue la información de los partidos, podrá ver para cada uno cuántos puntos ha ganado tanto por adivinar ganador + marcador, como puntos de trivia.

- cuando se cargue la información de clasificación de jugadores, podrá ver resaltado su nombre en la tabla.

### Administrador

- acceder a su cuenta vía login, se supone el primer usuario registrado será automáticamente administrador, para otros toca modificar la DB manualmente, también podrá hacer logout.

- dado que los partidos ya están quemados en la DB mediante seeds, el admin solo puede hacer update, nada de crear o eliminar, puede entonces actualizar a los dos equipos encontrados (excepto en la fase inicial de grupos), la fecha_hora de juego y los goles hechos una vez el partido acabe.

- podrá hacer el CRUD de preguntas, para llenar el banco de preguntas (tabla),pero no pueden ser eliminadas si ya un usuario las respondió, además la eliminación es por cambio de estado, nada de delete.

- puede buscar jugadores por número de cédula y ver sus permisos, desde ahí puede ejecutar updates de sus nombres, claves (contraseña) y cambiar el permiso entre ninguno y jugador, este cambio a permiso de jugador lo haría cuando reciba el dinero en mano.

## Layout

todas las vistas incluyen un header, con el título de la página a la izquierda, información de login a la derecha (botón de login, o nombre de usuario y botón de logout), y en el centro botónes contextuales para ir a diferentes vistas disponibles.

## Vistas

- clasificación de jugadores, una tabla con el listado de jugadores ordenados por total de puntos, tiene 5 columnas: puesto (siendo relevantes arriba el 1, 2, 3), nombre del jugador, puntos por adivinaciónes, puntos por preguntas, puntos totales (suma, lo que da el ranking). además si esta vista se ve con un usuario logeado, resaltará la fila asociada a dicho usuario según el ID primario interno.

- partidos, una tabla que muestra los partidos como registros, consta de 5 columnas: la etapa, equipo A, equipo B (los dos muestran un ícono de bandera grande y abajo de este el nombre del equipo), la fecha y hora de juego, los goles hechos "g_a - g_b". en caso de no haber equipos, fechas, goles, se especifica con un texto acorde. se ordena la tabla según la fecha y hora, siendo arriba la más reciente. esta vista posee un selector arriba a la izquierda para filtrar por etapa y también posee un texto iformativo arriba a la derecha, que dice el porcentaje de avance del mundial (partidos con goles definidos / total).

- partidos admin, cuando se loguea el administrador, ve la misma tabla de partidos pero, equipo A, equipo B, fecha_hora, resultado, son botónes para edición update, al pulsarlos sale ventana emergente con un forms que permite hacer el update al campo correspondiente y luego se refleja en la tabla. además en lugar de mostrar el porcentaje de avance, muestra es el número de partidos que deben ser editados para poner sus marcadores, aquellos que no tienen goles definidos pero la fecha_hora ya pasó.

- partidos jugador, cuando se loguea el jugador, ve la misma tabla de partidos pero, se agregan dos columnas: adivinación de marcador "g_a - g_b", y puntos del partido donde muestra (a + b = c) siendo a los puntos de adivinación y b los de responder la pregunta. los puntos dependerán de si en efecto hay o no adivinación y pregunta resuelta. en caso de no haberse hecho la adivinación, si esta puede hacerse (los dos equipos están definidos y la fecha_hora no ha pasado) aparecerá un botón que dice Adivinar, al pulsarlo una ventana emergente con un forms permite ingresar los dos marcadores (goles de cada equipo) y responder la pregunta seleccionada al azar del bando y que no se ha hecho antes al jugador. esta elección se puede hacer una sola vez, no tiene update la adivinación.

- login, para iniciar sesión con cédula y clave (password).

- registro, para crear un nuevo usuario, aunque al inicio queda sin permisos.

- pagar, ventana que indica que se de ir a donde el administrador a X lugar físico y pagar para ser activada la cuenta.

- preguntas, son varias vistas del CRUD para el banco de preguntas de la trivia, solo el adminitrador ingresa a esta vista.

- jugadores, en este apartado el administrador puede editar (update) a los usuarios no administradores, puede cambiar su nombre, clave (password), y permisos entre ninguno y jugar, no se verá una tabla con listado de jugadores, sino un campo para ingresar la cédula y con ello hallar al que será editado, si es que existe.

## Navegación

- clasificación de jugadores, va a partidos, partidos admin o partidos jugador (según si hay login y su nivel de permiso), también puede ir a login si no está logeado aún.

- partidos, va a login o clasificación de jugadores.

- partidos admin, va a preguntas, jugadores o clasificación de jugadores.

- partidos jugador, va a clasificación de jugadores.

- login, va a partidos y a registro, al hacer login va a partidos admin, partidos jugador o pagar, según el permiso que tenga el logeado.

- registro, va a login, partidos o si hubo un registro, va a pagar.

- pagar, va a partidos (se sale del login si lo hubo).

- preguntas, regresa a partidos admin.

- jugadores, regresa a partidos admin.

- nota: siempre que este logeado, puede hacer logout, e ir a partidos.

## Páginas web

- https://flagicons.lipis.dev/ banderas del mundo en SVG con su CSS

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Instalación

para armar el proyecto luego de clonarlo del repositorio:

1. composer install
2. copy .env.example .env
3. php artisan key:generate
4. (configurar DB en .env)
5. php artisan migrate:fresh --seed
6. npm install
7. npm install flag-icons
8. npm run build
9. php artisan config:clear
10. php artisan route:clear
11. php artisan view:clear
12. php artisan cache:clear

para activar el servidor local y auto carga de recursos:

1. php artisan serve
2. (en vite.config.js colocar la IP del PC en host o 127.0.0.1)
3. npm run dev
