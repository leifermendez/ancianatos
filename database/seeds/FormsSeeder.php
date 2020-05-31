<?php

use Illuminate\Database\Seeder;

class FormsSeeder extends Seeder
{
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $form_1 =   [
            'title' => 'PROTECCIÓN CONTRA INCENDIOS',
            'scheme' => json_encode([
                [
                    'key' => 'question_1',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿La cantidad de matafuegos es acorde a la superficie? Al menos 1 de 5 kg. PQ ABC cada 200 m2 o fracción de 200 m2 . No pudiendo haber mas de 15 mts. de recorrido a un matafuego.',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_1',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_2',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Los matafuegos están ubicados a 1,60 mts. del nivel del suelo a su parte más alta?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_2',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_3',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Disponen de estudio de carga de fuego?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_3',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_4',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿ La cantidad de matafuegos es acorde a la carga de fuego?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_4',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_5',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se encuentran señalizados los matafuegos? – Utilización de chapa baliza?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_5',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_6',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Dispone de registro del control de las recargas y prueba hidráulica de los matafuegos?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_6',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_7',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Disponen de sistemas de detección de incendios? Detectores de humo y/o gases, según corresponda, en los diferentes ambientes.',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_7',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_8',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Existen medios o vías de escape adecuadas en caso de incendio?.',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_8',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_9',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿ Se acredita la realización periódica de simulacros de evacuación ?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_9',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_10',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Alarma (campana o alarma mecánica) y estaciones manuales cada 15 mts.',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_10',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_11',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'La puerta de ingreso principal: abre hacia el exterior, se encuentra señalizada como salida, dispone de luz de emergencia y ancho mínimo de 1,10 metros?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_11',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_12',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Puertas existentes: tienen un ancho mínimo de 0,96 mts.?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_12',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_13',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿El cielo raso y decorados en las paredes son de características combustible?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_13',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ]
            ])
        ];
        $form_2 =   [
            'title' => 'PROTECCIÓN ELÉCTRICA',
            'scheme' => json_encode([
                [
                    'key' => 'question_1',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se dispone de interruptor diferencial que proteja toda la instalación?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_1',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_2',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se dispone de interruptor termomagnético que proteja toda la instalación?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_2',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_3',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se dispone de puesta a tierra en toda la instalación domiciliaria?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_3',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_4',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se dispone de informe (en vigencia) confeccionado por electricista con los requisitos que establece la Dirección de Inspección General y Convivencia?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_4',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_5',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Están todos los cableados eléctricos adecuadamente contenidos?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_5',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_6',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Los conectores eléctricos se encuentran en buen estado?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_6',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_7',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Las puestas a tierra se verifican periódicamente mediante mediciones?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_7',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_8',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Existen conductores eléctricos (cables) sueltos, al aire libre o expuestos?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_8',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_9',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Los tableros eléctricos son estancos de plástico o chapa?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_9',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_10',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Si dispone tableros de chapa: ¿su frente es de color azul y la contratapa de color naranja?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_10',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_11',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se encuentra indicado la llave de corte general?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_11',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_12',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Toda la instalación eléctrica se encuentra embutida o si es de tipo aérea en cañería de hierro o galvanizado?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_12',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ]
            ])
        ];
        $form_3 =   [
            'title' => 'SEÑALIZACIÓN',
            'scheme' => json_encode([
                [
                    'key' => 'question_1',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Plan de emergencia y evacuación – Al menos colocado en dos sectores bien diferenciados',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_1',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_2',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Se dispone de señalización de seguridad',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_2',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_3',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Salidas y/o salidas de emergencias – fondo verde con letras blancas',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_3',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_4',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Hacia la salida (indica recorrido hacia las salidas de emergencia)',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_4',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_5',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Salida (indica las puertas que conduzcan hacia la salida de emergencia)',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_5',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_6',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'No es salida (indica las puertas, pasillos y escaleras que no constituyan vías de escape)',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_6',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_7',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Prohibición de fumar',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_7',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_8',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => 'Números de los teléfonos de emergencias en cercanía del teléfono principal',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_8',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_9',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Los tableros eléctricos disponen de cartelería que indique el riesgo de choque eléctrico o electrocución?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_9',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ]
            ])
        ];
        $form_4 =   [
            'title' => 'ILUMINACIÓN DE EMERGENCIAS',
            'scheme' => json_encode([
                [
                    'key' => 'question_1',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se dispone de luces de emergencias en cantidad adecuada que asegure una intensidad luminosa de 30 lux?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_1',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ]
            ])
        ];
        $form_5 =   [
            'title' => 'OTRAS CONSIDERACIONES',
            'scheme' => json_encode([
                [
                    'key' => 'question_1',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿La calefacción es de tipo tiro balanceado? (no puede ser pantalla o calefactores)',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_1',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ],
                [
                    'key' => 'question_2',
                    'type' => 'select',
                    'templateOptions' => [
                        'label' => '¿Se utiliza en la conexión de gas más de 0,50 mts. de caño de cobre?',
                        'placeholder' => '',
                        'options' => [
                            [
                                'value' => 'null',
                                'label' => 'Seleccione',
                                'select' => 'true'
                            ],
                            [
                                'value' => '0',
                                'label' => 'NO',
                                'select' => 'false'
                            ],
                            [
                                'value' => '1',
                                'label' => 'SI',
                                'select' => 'false'
                            ]
                        ]
                    ]
                ],
                [
                    'key' => 'observation_2',
                    'type' => 'textarea',
                    'templateOptions' => [
                        'label' => 'null',
                        'placeholder' => 'Observaciones'
                    ]
                ]
            ])
        ];

        $this->faker = $faker = Faker\Factory::create();
        $tests = array(
          $form_1,
          $form_2,
          $form_3,
          $form_4,
          $form_5,
        );

        foreach ($tests as $key) {
            DB::table('forms')->insert($key);
        }
    }
}
