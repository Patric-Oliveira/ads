<?php

return [
    
    'title_index'                   => 'Listando os Planos',
    'title_archived'                => 'Planos Arquivados',
    'title_new'                     => 'Criando novo Plano',
    'title_new2'                    => 'Criar Plano',
    'title_edit'                    => 'Editando o Plano',
    'text_monthly'                  => 'Mensal',
    'text_quarterly'                => 'Trimestral',
    'text_semester'                 => 'Semestral',
    'text_yearly'                   => 'Anual',
    'text_info_adverts'             => 'Nº de Anúncios que o usuário poderá cadastrar. Deixe em branco para ilimitado',
    'text_is_highlighted'           => 'Destacado para compra',
    'text_no_highlighted'           => 'Não destacado para compra',
    'text_unlimited_adverts'        => 'Ilimitado',


    // btn
    'btn_choice'                => 'Eu quero esse',
    'btn_actions'               => 'Ações',
    'btn_cancel'                => 'Cancelar',
    'btn_save'                  => 'Salvar',
    'btn_back'                  => 'Voltar',
    'btn_new'                   => 'Criar Plano de Assinatura ',
    'btn_edit'                  => 'Editar',
    'btn_archived'              => 'Arquivar',
    'btn_all_archived'          => 'Arquivados',
    'btn_recover'               => 'Recuperar',
    'btn_delete'                => 'Excluir',
    'btn_actions'               => 'Ações',
    'btn_archived_plans'        => 'Planos Arquivados',
    'btn_confirmed_delete'      => 'Sim, Exclua!',
    'btn_logout'                => 'Encerrar Sessão',


    // Table view
    'table_header_code'     => 'Código',
    'table_header_plan'     => 'Plano',
    'table_header_details'  => 'Detalhes',

    // Labels
    'label_name'            => 'Nome do Plano',
    'label_code'            => 'Códido do Plano',
    'label_recorrence'      => 'Tipo de recorrência',
    'label_adverts'         => 'Nº de Anúncios permitidos',
    'label_value'           => 'Valor do plano',
    'label_description'     => 'Descrição do plano',
    'label_view'            => 'Visualizar',
    'label_details'         => 'Detalhes',
    'label_is_highlighted'  => 'Plano Destacado para Compra',
    'label_archived'        => 'Arquivado',

    // Validation messages
    'recorrence'        => [
        'in_list' => 'Por favor escolha uma das opções: Mensal, Trimestral, Semestral ou Anual',
    ],
    'name' => [
        'required'   => 'Campo obrigatório, preencha o nome para prosseguir',
        'min_length' => 'Informe pelo menos 3 caractéres',
        'max_length' => 'Informe no máximo 90 caractéres',
        'is_unique'  => 'Essa categoria já existe',
    ],
];
