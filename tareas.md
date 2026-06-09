# Tareas

1. en views/partidos/jugador el wrapper dentro de prepareApuestaModal() está pintando los radio button de las preguntas muy grandes, quedan los textos debajo del radio button, debería este aparecer pequeño a la izquierda, además las respuestas aparecen en amarillo como títulos, deberían ser igual que el enunciado. no olvidar que los estilos deben ir en los css.

2. por qué en partidocontroller aparece "'respuesta' => 'required|string|max:1024'", en apostar(), acaso la respuesta según el modelo DB pts_pregunta en la tabla apuestas, es tinyint, es decir asociar por decir algo 0 puntos (mal contestada) o 1 punto (verdadera), no hay que entregar strings que pueden a futuro cambiar si se edita la pregunta, deben usarse los id de la opción seleccionada. además en el update de apostar() no veo la pregunta respondida, solo los goles, por qué? corregir eso, siempre se entregan goles y pregunta.

3. en views/partidos/jugador en el forms emergente al adivinar, deben mostrarse los nombres de los países, no "Goles Equipo A", sino "Goles nombre_equipo".
