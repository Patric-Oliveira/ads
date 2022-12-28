<?php

namespace App\Services;

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
}