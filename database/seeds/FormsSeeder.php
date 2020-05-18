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
        $this->faker = $faker = Faker\Factory::create();
        $tests = array(
            [
                'title' => $this->faker->name,
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
                    ]
                ])
            ]
        );

        foreach ($tests as $key) {
            DB::table('forms')->insert($key);
        }
    }
}
