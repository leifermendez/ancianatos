<?php

namespace leifermendez\Reports;

use App\FormsValues;
use App\User;
use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Reports
{
    protected $pdf;
    protected $model;
    protected $instance;

    public function __construct()
    {
        $this->pdf = App::make('dompdf.wrapper');
    }

    public function reportSingle($data, $name = '')
    {

        $forms = FormsValues::where('forms_values.target_id', $data->id)
            ->join('forms', 'forms.id', '=', 'forms_values.forms_id')
            ->join('institutions', 'institutions.id', '=', 'forms_values.target_id')
            ->join('users', 'users.id', '=', 'institutions.user_id')
            ->select('forms_values.*', 'forms.title as form_title', 'forms.scheme as form_scheme',
                'users.name as user_name'
            )
            ->get();

        $forms->map(function ($data) {
            $val = json_decode($data->values, 1);
            $scheme = json_decode($data->form_scheme, 1);
            foreach ($val as $key => $v) {
                $math = array_search($key, array_column($scheme, 'key'));

                $val['label_' . $key] = $scheme[$math]['templateOptions']['label'];
            }
            $data->values = $val;
            return $data;
        });

        $raw = [
            'single' => $data,
            'forms' => $forms
        ];

        $content = \PDF::loadView('reports.single', $raw)->output();
        Storage::disk('public')->put($name, $content);
        return Storage::disk('public')->url($name);

    }

    /**
     * Reporte de lista
     */
    public function listReport($name = '', $model = null, $key = [], $title = '', $with = [])
    {
        try {
            if (!$model) {
                throw new Exception(trans("not.model"));
            }
//            dd(array_keys($key));
//            dd(implode(',',$key));
            $model = 'App\\' . $model;
            $data = $model::select(array_keys($key))
                ->with($with)
                ->get()->toArray();
//            dd($data);
            $data = [
                'keys' => $key,
                'data' => $data,
                'title' => $title,
            ];
            $content = \PDF::loadView('reports.list', ['data' => $data])
                ->setPaper('a4', 'landscape')
                ->output();
            Storage::disk('public')->put($name, $content);
            return Storage::disk('public')->url($name);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return null;
        }
    }

}
