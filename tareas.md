# Tareas

1. en views/partidos/jugador cuando se selecciona la pregunta correcta en el forms wrapper, No se está estableciendo los 2 puntos en pts_pregunta en la tabla apuestas de la DB, arreglar eso, nota, en vez de comparar strings de respuesta correcta por que mejor no usar el value o lo que sea que indique que se seleccionó la correcta, un id o algo así, revisar eso.

2. cuando se establecen los 2 puntos tal como se vió en la tarea 1, sumarlos también al atributo "pts_preguntas" de la tabla usuarios en DB.

3. generar un método o script o como se llame, que haga un barrido en actualización (update) de todos los puntos de todos los usuarios en el momento en que el administrador, hace un update de "partidos" atributos: goles_a, goles_b. así:

a. para un partido que se hallan actualizado sus goles, buscar todos los registros de "apuestas" asociados a ese partido, si goles_a partido coinciden con goles_a apuesta, suma un punto, de igual forma para b podría sumar otro punto. y si el atributo de apuesta "ganador" coincide siendo: 0 (goles_a > goles_b en partido), 1 (goles_b > goles_a en partido), 2 (igualdad) entonces sumar 2 puntos... en otras palabras, adivinar el marcador de A es un punto, el de B otro punto, adivinar el ganador según el atributo "ganador" son 2 puntos. este resultado se guarda en "pts_apuesta" de la tabla "apuestas".

b. finalmente para todos los usuarios, hacer la sumatoria de sus pts_apuesta en la tabla apuestas, y colocar el resultado en la tabla usuarios: pts_apuestas.
