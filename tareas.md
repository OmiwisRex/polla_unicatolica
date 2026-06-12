# Tareas

Frontend:

- nada

Backend:

2. en views/partidos/admin agregar un filtro al selector de filtro-etapa, este mostrará los registros que están pendientes por poner marcador, ver la condición:
@elseif($partido->equipo_a_id && $partido->equipo_b_id && $partido->fecha_hora && $partido->fecha_hora->isPast())
en la columna Resultado, la cuál agrega un botón.

3. en views/partidos/jugador agregar un filtro al selector de filtro-etapa,este mostrará los registros que están pendientes por predecir, ver la condición:
@elseif($apuesta || $puedeApostar)
en la columna Predicciónes, la cuál agrega un botón.

4. agregar a todos los filtros de views/partidos/ (3 views), al selector filtro-etapa, una opción que diga "Hoy", y muestre los registros solo de los partidos que tienen el atributo fecha_hora en la tabla partidos, seteado y que coincida en datetime con el día de hoy.

6. al enviar la respuesta a la pregunta, verificar que se envía el texto que aparece en el frontend y no el texto tomado a partir del id que se pasa al contestar, pues esto último es información redundante, si hay un fallo eligiendo el id correcto, mostrará la pregunta de ese id y no la que leyó y eligió el usuario.

Notas:

- todos los estilso deben ir en los correspondientes archivos css y los colores deben respetar la paleta de color en css/app.css
