# Polla

este proyecto trata sobre un sistema de apuestas para el mundial de fútbol 2026, aquí los jugadores se registran y logean, luego pueden elegir el marcador que creen habrá para cada partido, esto solo es posible hasta la fecha y hora del partido, luego queda bloqueado y un administrador colocará el resultado real, con ello se contarán los puntos ganados y se establecerá el siguiente partido a adivinar.

## vistas

en este momento el proyecto es solo un demo de frontend, todavía no cuenta con base de datos, login, administración ni información veráz, a continuación se listan las diferentes páinas web.

### juego.php

esta interfaz muestra una tabla de partidos, donde se ve:

- equipo 1 vs equipo 2 (nombres e íconos de sus banderas).
- tipo de juego según etiqueta: grupos, dieciseisavos, octavos, cuartos, semifinal, tercer lugar, final.
- se observa fecha y hora del juego.
- resultado que el usuario actual ha apostado, goles 1 vs goles 2.
- resultado según goles 1 vs goles 2.
- hay un botón para hacer la apuesta, pero este estará desactivado si ya se hizo una apuesta previamente (existen los goles apostados), o estará desactivado si ya pasó la fecha y hora respecto a la actual, o está desactivado si el partido actual no se sabe quiénes juegan, pues depende de un partido anterior aún no efectuado.

la interfaz incluye un selector para escoger etiqueta y así filtrar la tabla.

los datos serán generados aleatoriamente, quemados en el frontend, pero siguiendo la lógica de el mundial 2026, algunas apuestas estarán hechas como si el usuario las hiciese, otras están pendientes, algunas fechas ya pasaron, otras no, y las etiquetas diferentes a grupos, pueden mostrar partidos aún no definidos, pues faltan deshenlaces previos.

los botónes de hacer apuesta aún no hacen nada.

de esta interfaz se puede navegar a la de puntos.php con un botón.

### puntos.php

esta interfaz muestra una tabla de jugadores, con sus puntajes, donde se ve:

- puesto que ocupa, están ordenados, de 1 (más puntos) hacia mayor (menos puntos).
- nombre del jugador.
- puntos que tiene acumulados.
- se sombreará o seleccionará el jugador actualmente logueado (elegir uno al azar para este demo, ya que no hay login funcional).

de esta interfaz se puede navegar a la de juego.php con un botón.

## Estética

se utilizará el archivo estilo.css para que todo el código CSS esté ahí.

debe usar colores dorado, maroon rojizo, grises oscuros, como colores de institución religiosa y del dorado de la copa, que muestre una estética seria y señorial, solemne.
