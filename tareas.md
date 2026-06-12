# Tareas

Frontend:

- agregar información general, acerca de del sistema, guia de reglas, en un desplegable para todos los usuarios.
- verificar que cargue en el servidor el fondo y el icono.

Backend:

- debajo de buscar jugador debe aparecer el listado de cédulas y nombres, jugadores activos y luego inactivos.

- agregar en filtros, un filtro de adivinaciónes pendientes o en admin sería marcador por poner.
- agregar en filtros, un filtro de partidos de hoy.

- el administrador no coloca contraseña nueva, solo da ok a reestablecer, se pone una por defecto, el login si detecta que está por defecto entonces guarda la nueva ingresada.
- escribir instrucciónes de reestablecimiento de contraseña en editor de usuario del admin.

- al enviar la respuesta a la pregunta, verificar que se envía el texto que aparece en el frontend y no el texto tomado a partir del id que se pasa al contestar, pues esto último es información redundante, si hay un fallo eligiendo el id correcto, mostrará la pregunta de ese id y no la que leyó y eligió el usuario.
