<?php

namespace App\Services;

use App\Entities\Plan;
use App\Models\PlanModel;
use CodeIgniter\Config\Factories;

class PlanService
{
    private $planModel;

    public function __construct()
    {
        $this->planModel = Factories::models(PlanModel::class);
    }

    public function getAllPlans() : array
    {
        $plans = $this->planModel->findAll();

        $data = [];

        foreach ($plans as $plan) {

            $btnEdit = form_button(
                [
                    'data-id' => $plan->id,
                    'id'      => 'updatePlanBtn', // ID do html element
                    'class'   => 'btn btn-primary btn-sm'
                ],
                lang('Plans.btn_edit')
            );

            $btnArchive = form_button(
                [
                    'data-id' => $plan->id,
                    'id'      => 'archivePlanBtn', // ID do html element
                    'class'   => 'btn btn-info btn-sm'
                ],
                lang('Plans.btn_archived')
            );

            $data[] = [
                'code'           => $plan->plan_id,
                'name'           => $plan->name,
                'is_highlighted' => $plan->isHighlighted(),
                'details'        => $plan->details(),
                'actions'        => $btnEdit . ' ' . $btnArchive,
            ];
        }

        return $data;
    }

    public function getRecorrences(string $recorrence = null): string
    {
        $options = [];
        $selected = [];

        $options = [
            ''                      => lang('Plans.label_recorrence'),
            Plan::OPTION_MONTHLY    => lang('Plans.text_monthly'),
            Plan::OPTION_QUARTERLY  => lang('Plans.text_quarterly'),
            Plan::OPTION_SEMESTER   => lang('Plans.text_semester'),
            Plan::OPTION_YEARLY     => lang('Plans.text_yearly'),
        ];

        if (is_null($recorrence)) {
            return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
        }

        return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
    }

    public function trySavePlan(Plan $plan, bool $protect = true)
    {
        try {
            /**
             * @todo gerenciar a criação/atualuzação na gerencianet
             */
            if ($plan->hasChanged()) {
                $this->planModel->protect($protect)->save($plan);
            }
        } catch (\Exception $e) {
            //die($e->getMessage());
            die(lang('App.info_data_error'));
        }
    }

    public function getPlanByID(int $id, bool $withDeleted = false)
    {
        $plan = $this->planModel->withDeleted($withDeleted)->find($id);

        if (is_null($plan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(lang('Plan Not Found'));
        }

        return $plan;
    }
}