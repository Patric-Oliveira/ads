<?php

namespace App\Services;

use App\Entities\Plan;
use App\Models\PlanModel;
use CodeIgniter\Config\Factories;

class PlanService
{
    private $planModel;
    private $gerencianetService;


    public function __construct()
    {
        $this->planModel = Factories::models(PlanModel::class);
        $this->gerencianetService = Factories::class(GerencianetService::class);
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

    public function getAllArchived() : array
    {
        $plans = $this->planModel->onlyDeleted()->findAll();

        $data = [];

        foreach ($plans as $plan) {

            $btnRecover = form_button(
                [
                    'data-id' => $plan->id,
                    'id'      => 'recoverPlanBtn', // ID do html element
                    'class'   => 'btn btn-primary btn-sm'
                ],
                lang('App.btn_recover')
            );

            $btnDelete = form_button(
                [
                    'data-id' => $plan->id,
                    'id'      => 'deletePlanBtn', // ID do html element
                    'class'   => 'btn btn-danger btn-sm'
                ],
                lang('App.btn_delete')
            );

            $data[] = [
                'code'           => $plan->plan_id,
                'name'           => $plan->name,
                'is_highlighted' => $plan->isHighlighted(),
                'details'        => $plan->details(),
                'actions'        => $btnRecover . ' ' . $btnDelete,
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

        // criando
        if (is_null($recorrence)) {
            return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
        }

        // Editando
        $selected[] = match ($recorrence) {

            Plan::OPTION_MONTHLY    => Plan::OPTION_MONTHLY,
            Plan::OPTION_QUARTERLY  => Plan::OPTION_QUARTERLY,
            Plan::OPTION_SEMESTER   =>  Plan::OPTION_SEMESTER,
            Plan::OPTION_YEARLY     => Plan::OPTION_YEARLY,
            default                 => throw new \InvalidArgumentException("Unsupported recorrence {$recorrence}")
        };

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

    public function tryArchivePlan(int $id)
    {
        try {

            $plan = $this->getPlanByID($id);

            $this->planModel->delete($plan->id);

        } catch (\Exception $e) {
           
            die($e->getMessage());
        }
    }

    public function tryRecoverPlan(int $id)
    {
        try {

            $plan = $this->getPlanByID($id, withDeleted:true);

            $plan->recover();

            $this->planModel->protect(false)->save($plan);

        } catch (\Exception $e) {
           
            die($e->getMessage());
        }
    }

    public function tryDeletePlan(int $id)
    {
        try {

            $plan = $this->getPlanByID($id, withDeleted: true);

            /**
             * @todo deletar plano na gerencianet
             */

            $this->planModel->delete($plan->id, purge: true);

        } catch (\Exception $e) {
           
            die($e->getMessage());
        }
    }

    private function createOrUpdatePlanOnGerencianet(Plan $plan)
    {
        // Esta criando um plano ?
        if (empty($plan->id)) {
            
            // Sim... 
            return $this->gerencianetService->createPlan($plan);
        }

        // Atualizando...
        // Contudo, precisa verificar se o nome do plano foi alterado
        // A Gerencianet permite atualizar apenas o nome do plano
        if ($plan->hasChanged('name')) {

            return $this->gerencianetService->updatePlan($plan);
        }
    }
}