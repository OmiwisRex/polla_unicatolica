<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pregunta;

class preguntasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preguntas = [
            [
                'enunciado' => 'Mencione el patrono de Unicatólica:',
                'correcta' => 'San José',
                'falsa1' => 'San Francisco de Asís',
                'falsa2' => 'San Francisco Javier',
                'falsa3' => 'San Antonio',
            ],
            [
                'enunciado' => 'La cruz de oro en la bandera de Unicatólica Representa:',
                'correcta' => 'Jesucristo como la luz de las naciones',
                'falsa1' => 'El oro sacado de sur América',
                'falsa2' => 'Símbolo de las cruzadas ',
                'falsa3' => 'La cruz de cristo',
            ],
            [
                'enunciado' => 'Las cuatro estrellas fulgentes en la bandera, emblema de Unicatólica, representan:',
                'correcta' => 'Los cuatro puntos cardinales',
                'falsa1' => 'El cuatro como número par',
                'falsa2' => 'Los cuatro jinetes del apocalipsis',
                'falsa3' => 'Los cuatro valores Institucionales',
            ],
            [
                'enunciado' => 'Señale cual es la misión correcta de la Unicatólica:',
                'correcta' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA, comprometida con los valores cristianos, forma personas de manera integral, reafirmando su dignidad humana en la relación con Dios, consigo mismo, con los demás y con el medio ambiente, a través de la generación y difusión del conocimiento, para contribuir al desarrollo de los pueblos.',
                'falsa1' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA, comprometida con los valores, forma personas de manera integral, reafirmando su dignidad humana en la relación con Dios, consigo mismo, con los demás y con el medio ambiente, a través de la generación y difusión del conocimiento, para contribuir al desarrollo de los pueblos.',
                'falsa2' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA, comprometida con los valores ignacianos, forma personas de manera integral, reafirmando su dignidad humana en la relación con Dios, consigo mismo, con los demás y con el medio ambiente, a través de la generación y difusión del conocimiento, para contribuir al desarrollo de los pueblos.',
                'falsa3' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA, comprometida con los valores cristianos, forma personas de manera integral, confirmando su dignidad humana en la relación con Dios, consigo mismo, con los demás y con el medio ambiente, a través de la generación y difusión del conocimiento, para contribuir al desarrollo de los pueblos.',
            ],
            [
                'enunciado' => 'Señale cual es la visión correcta de Unicatólica:',
                'correcta' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA – Institución de la Arquidiócesis de Cali, será reconocida por su carácter socialmente incluyente, por la pertinencia y calidad de sus programas y proyectos institucionales, la vocación hacia el servicio social de sus egresados y por la defensa de la dignidad humana y de la paz.',
                'falsa1' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA – Institución de la Arquidiócesis de Colombia, será reconocida por su carácter socialmente incluyente, por la pertinencia y calidad de sus programas y proyectos institucionales, la vocación hacia el servicio social de sus egresados y por la defensa de la dignidad humana y de la paz.',
                'falsa2' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA – Institución de la Arquidiócesis de Colombia, será reconocida por su carácter, por la pertinencia y calidad de sus programas y proyectos institucionales, la vocación hacia el servicio social de sus egresados y por la defensa de la dignidad humana y de la paz.',
                'falsa3' => 'La Fundación Universitaria Católica Lumen Gentium – UNICATÓLICA – Institución de la Arquidiócesis de Cali, será reconocida por su carácter socialmente incluyente, por la pertinencia y calidad de sus programas sus instalaciones, la vocación hacia el servicio social de sus egresados y por la defensa de la dignidad humana y de la paz.',
            ],
            [
                'enunciado' => 'Cuál es el principio de Unicatólica que No coincide con la definición: ',
                'correcta' => 'Libertad de Pensamiento y Actitud Crítica: se respetan las distintas ideas, opiniones, creencias y posturas, sin importar de donde vengan o el sentido que tengan, incluso si no tienen sentido ni coherencia.',
                'falsa1' => 'Respeto por la Dignidad Humana: se reconoce a la persona como sujeto con valor en sí mismo y con derechos intrínsecos e inalienables derivados de su condición humana.',
                'falsa2' => 'Vivencia de la Identidad Cristiana-Eclesial: se reconoce la identidad centrada en la formación de seres humanos capaces de realizarse plena e integralmente en su dimensión relacional: consigo mismo, con los demás, con el entorno y con el trascendente.',
                'falsa3' => 'Cuidado de la Casa Común: se reconoce el compromiso de actuar y responder con integridad y respeto en la totalidad de las relaciones e interacciones con los sistemas naturales y sociales, en función de la promoción de la calidad de vida y la solidaridad intergeneracional. La creación, entendida como hábitat en cual vivimos, será también cuidada con esmero.',
            ],
            [
                'enunciado' => 'Cuál es el principio de Unicatólica que infiere el cuidado del medio ambiente: ',
                'correcta' => 'Cuidado de la Casa Común: se reconoce el compromiso de actuar y responder con integridad y respeto en la totalidad de las relaciones e interacciones con los sistemas naturales y sociales, en función de la promoción de la calidad de vida y la solidaridad intergeneracional. La creación, entendida como hábitat en cual vivimos, será también cuidada con esmero.',
                'falsa1' => 'Respeto por la Dignidad Humana: se reconoce a la persona como sujeto con valor en sí mismo y con derechos intrínsecos e inalienables derivados de su condición humana.',
                'falsa2' => 'Vivencia de la Identidad Cristiana-Eclesial: se reconoce la identidad centrada en la formación de seres humanos capaces de realizarse plena e integralmente en su dimensión relacional: consigo mismo, con los demás, con el entorno y con el trascendente.',
                'falsa3' => 'Libertad de Pensamiento y Actitud Crítica: se respetan las distintas ideas, opiniones, creencias y posturas, en el marco no negociable de la dignidad humana; en un ejercicio consciente de actitud crítica, entendida como la capacidad de cuestionarse permanentemente, de expresarse abierta, directa y honestamente, pero respetuosamente frente a las distintas posturas y de valoración de los cuestionamientos del otro.',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Respeto por la dignidad humana” refiere a:',
                'correcta' => 'se reconoce a la persona como sujeto con valor en sí mismo y con derechos intrínsecos e inalienables derivados de su condición humana.',
                'falsa1' => 'se reconoce a la persona como sujeto con poco valor en sí mismo y con derechos intrínsecos e inalienables derivados de su condición humana.',
                'falsa2' => 'se reconoce a la persona como sujeto con valor en sí mismo y con derechos intrínsecos alienables derivados de su condición humana.',
                'falsa3' => 'se reconoce a la persona como sujeto con valor en sociedad, con derechos intrínsecos e inalienables derivados de su condición humana.',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Vivencia de la Identidad Cristiana-Eclesial” refiere a:',
                'correcta' => 'se reconoce la identidad centrada en la formación de seres humanos capaces de realizarse plena e integralmente en su dimensión relacional: consigo mismo, con los demás, con el entorno y con el trascendente.',
                'falsa1' => 'se reconoce la identidad centrada en los seres humanos capaces de realizarse plena e integralmente en su dimensión relacional: consigo mismo, con los demás y con el entorno y con el trascendente.',
                'falsa2' => 'se reconoce la identidad centrada en los seres humanos capaces de realizarse plena en su dimensión relacional: consigo mismo, con los demás y con el entorno y con el trascendente.',
                'falsa3' => 'No se reconoce la identidad centrada en la formación de seres humanos capaces de realizarse plena e integralmente en su dimensión relacional: consigo mismo, con los demás y con el entorno y con el trascendente.',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Libertad de Pensamiento y Actitud Crítica” refiere a:',
                'correcta' => 'se respetan las distintas ideas, opiniones, creencias y posturas, en el marco no negociable de la dignidad humana ',
                'falsa1' => 'se irrespetan las distintas ideas, opiniones, creencias y posturas, en el marco no negociable de la dignidad humana ',
                'falsa2' => 'se respetan las ideas semejantes, opiniones, creencias y posturas, en el marco no negociable de la dignidad humana ',
                'falsa3' => 'se respetan las distintas ideas, opiniones, creencias y posturas, en el marco negociable de la dignidad humana ',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Cuidado de la Casa Común” refiere a:',
                'correcta' => 'se reconoce el compromiso de actuar y responder con integridad y respeto en la totalidad de las relaciones e interacciones con los sistemas naturales y sociales, en función de la promoción de la calidad de vida y la solidaridad intergeneracional. ',
                'falsa1' => 'No se reconoce el compromiso de actuar y responder con integridad y respeto en la totalidad de las relaciones e interacciones con los sistemas naturales y sociales, en función de la promoción de la calidad de vida y la solidaridad intergeneracional. ',
                'falsa2' => 'se reconoce el compromiso de responder en la totalidad de las relaciones e interacciones con los sistemas naturales y sociales, en función de la promoción de la calidad de vida y la solidaridad intergeneracional. ',
                'falsa3' => 'se reconoce el compromiso de actuar y responder con integridad y respeto en la totalidad de las relaciones e interacciones con los sistemas naturales y sociales, en función de la promoción del día y la solidaridad intergeneracional. ',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Responsabilidad Social” refiere a:',
                'correcta' => 'se compromete en la construcción de relaciones responsables y éticas que contribuyan a la transformación de las condiciones sociales, económicas, políticas y culturales, para una sociedad más justa, incluyente, participativa y democrática. ',
                'falsa1' => 'se compromete en la construcción de relaciones sociales y divertidas que contribuyan a la transformación de las condiciones sociales, económicas, políticas y culturales, para una sociedad más justa, incluyente, participativa y democrática. ',
                'falsa2' => 'se compromete en la construcción de relaciones institucionales y sociales que contribuyan a la transformación de las condiciones sociales, económicas, políticas y culturales, para una sociedad más justa, incluyente, participativa y democrática. ',
                'falsa3' => 'se compromete en la deconstrucción de relaciones responsables y éticas que contribuyan a la transformación de las condiciones sociales, económicas, políticas y culturales, para una sociedad más justa, incluyente, participativa y democrática. ',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Búsqueda Permanente de la Calidad” refiere a:',
                'correcta' => 'se reconoce la calidad como el conjunto de condiciones que permiten evaluar, en un tiempo determinado, a la luz de los propósitos institucionalales, la coherencia entre la misión y los propósitos institucionalales, con sus procesos internos de gestión y los requerimientos sociales de su entorno. ',
                'falsa1' => 'No reconoce la calidad como el conjunto de condiciones que permiten evaluar, en un tiempo determinado, a la luz de los propósitos institucionalales, la coherencia entre la misión y los propósitos institucionalales, con sus procesos internos de gestión y los requerimientos sociales de su entorno. ',
                'falsa2' => 'se reconoce la calidad como el conjunto de condiciones que permiten evaluar, sin importar el tiempo, a la luz de los propósitos institucionalales, la coherencia entre la misión y los propósitos institucionalales, con sus procesos internos de gestión y los requerimientos sociales de su entorno. ',
                'falsa3' => 'se reconoce la calidad como el conjunto de condiciones que permiten evaluar, en un tiempo determinado, a la luz de los propósitos institucionalales, la incoherencia entre la misión y los propósitos institucionalales, con sus procesos internos de gestión y los requerimientos sociales de su entorno. ',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Sensibilidad y Solidaridad Social” refiere a:',
                'correcta' => 'fomentar procesos de organización y participación social, ciudadana y política en la exigibilidad de los derechos humanos y el rechazo a toda forma de vulneración de los mismos.',
                'falsa1' => 'fomentar procesos de desorganización y participación social, ciudadana y política en la exigibilidad de los derechos humanos y el rechazo a toda forma de vulneración de los mismos.',
                'falsa2' => 'fomentar procesos de organización y división social, ciudadana y política en la exigibilidad de los derechos humanos y el rechazo a toda forma de vulneración de los mismos.',
                'falsa3' => 'fomentar procesos de organización y participación social, ciudadana y política en la exigibilidad de los derechos humanos y a toda forma de vulneración de los mismos.',
            ],
            [
                'enunciado' => 'En los principios de Unicatólica “Compromiso con la Paz y la Reconciliación” refiere a:',
                'correcta' => 'entendida como un conjunto de acciones para la construcción de consensos, que posibiliten acuerdos fundados en el respeto a la vida y la dignidad humana, como derecho fundamental de toda sociedad.',
                'falsa1' => 'entendida como un conjunto de acciones para la deconstrucción de consensos, que posibiliten acuerdos fundados en el respeto a la vida y la dignidad humana, como derecho fundamental de toda sociedad.',
                'falsa2' => 'entendida como un conjunto de acciones para la construcción de disensos, que posibiliten acuerdos fundados en el respeto a la vida y la dignidad humana, como derecho fundamental de toda sociedad.',
                'falsa3' => 'entendida como un conjunto de acciones para la construcción de consensos, que posibiliten desacuerdos fundados en el respeto a la vida y la dignidad humana, como derecho fundamental de toda sociedad.',
            ],
            [
                'enunciado' => 'Los cuatro valores de Unicatólica son:',
                'correcta' => 'Honestidad, igualdad, equidad y justicia, respeto ',
                'falsa1' => 'Honestidad, desigualdad, equidad y justicia, respeto ',
                'falsa2' => 'Honestidad, igualdad, equidad y justicia, disciplina ',
                'falsa3' => 'Honestidad, igualdad, tranquilidad y justicia, respeto ',
            ],
            [
                'enunciado' => 'En los valores de Unicatólica “Honestidad” refiere a:',
                'correcta' => 'se reconoce como la actitud, el comportamiento y la expresión sincera y coherente sobre la base de la justicia y la verdad.',
                'falsa1' => 'se reconoce como la aptitud, el comportamiento y la expresión sincera y coherente sobre la base de la justicia y la verdad.',
                'falsa2' => 'se reconoce como la aptitud, el comportamiento y la expresión sincera e incoherente sobre la base de la justicia y la verdad.',
                'falsa3' => 'se reconoce como la actitud, el comportamiento y la expresión sincera y coherente sobre la base de las minorías.',
            ],
            [
                'enunciado' => 'En los valores de Unicatólica “Igualdad” refiere a:',
                'correcta' => 'se reconoce que todas las personas gozan de los mismos derechos humanos y fundamentales, sin discriminación alguna por razones de sexo, religión, ideas políticas, diferencias culturales, nacionalidad o cualquier otra situación social.',
                'falsa1' => 'se reconoce que todas las personas gozan de diferentes derechos humanos y fundamentales, sin discriminación alguna por razones de sexo, religión, ideas políticas, diferencias culturales, nacionalidad o cualquier otra situación social.',
                'falsa2' => 'se reconoce que todas las personas gozan de los mismos derechos humanos y fundamentales, con discriminación por razones de sexo, religión, ideas políticas, diferencias culturales, nacionalidad o cualquier otra situación social.',
                'falsa3' => 'se reconoce que todas las personas gozan de los mismos derechos humanos y fundamentales, sin discriminación alguna por razones de sexo, religión, ideas políticas, diferencias culturales, nacionalidad excepto por equipo de futbol.',
            ],
            [
                'enunciado' => 'En los valores de Unicatólica “Equidad y Justicia” refiere a:',
                'correcta' => 'se reconoce como la voluntad de brindar oportunidades con base en criterios objetivos que acojan las necesidades, realidades e intereses de las personas, reconociendo y respetando su contexto social, cultural, político, económico e ideológico.',
                'falsa1' => 'se reconoce como la voluntad de negar oportunidades con base en criterios objetivos que acojan las necesidades, realidades e intereses de las personas, reconociendo y respetando su contexto social, cultural, político, económico e ideológico.',
                'falsa2' => 'se reconoce como la voluntad de brindar oportunidades con base en criterios subjetivos que acojan las necesidades, realidades e intereses de las personas, reconociendo y respetando su contexto social, cultural, político, económico e ideológico.',
                'falsa3' => 'se reconoce como la voluntad de brindar oportunidades con base en criterios objetivos que se desvinculen de las necesidades, realidades e intereses de las personas, reconociendo y respetando su contexto social, cultural, político, económico e ideológico.',
            ],
            [
                'enunciado' => 'En los valores de Unicatólica “Respeto” refiere a:',
                'correcta' => 'se concibe como el reconocimiento de la autonomía del ser humano y la diferencia, de sus virtudes, derechos y limitaciones, en busca de su desarrollo social e individual.',
                'falsa1' => 'se concibe como el reconocimiento de la dependencia del ser humano y la diferencia, de sus virtudes, derechos y limitaciones, en busca de su desarrollo social e individual.',
                'falsa2' => 'se concibe como el reconocimiento de la dependencia del ser humano y la igualdad, de sus virtudes, derechos y limitaciones, en busca de su desarrollo social e individual.',
                'falsa3' => 'se concibe como el desconocimiento de la autonomía del ser humano y la diferencia, de sus virtudes, derechos y limitaciones, en busca de su desarrollo social e individual.',
            ],
            [
                'enunciado' => 'Los colores que luce la bandera de Unicatólica son:',
                'correcta' => 'Dorado, azul y blanco',
                'falsa1' => 'Amarillo, azul y blanco',
                'falsa2' => 'Verde, azul y blanco',
                'falsa3' => 'Amarillo y blanco',
            ],
        ];

        foreach ($preguntas as $pregunta) {
            Pregunta::create($pregunta);
        }
    }
}
