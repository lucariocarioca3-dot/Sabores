<?php

    class controladoraFeed{

        private function fallbackReceitas(){
            return [
                ['titulo_receita' => 'Bolo de Chocolate',    'tipo_receita' => 'Sobremesa',       'custo_total' => 25.00, 'tempo_preparo_minutos' => 40, 'rendimento_porcoes' => 8,  'criado_em' => '2025-06-11 10:30:00'],
                ['titulo_receita' => 'Pão de Queijo',        'tipo_receita' => 'Entrada',         'custo_total' => 15.00, 'tempo_preparo_minutos' => 30, 'rendimento_porcoes' => 6,  'criado_em' => '2025-06-10 14:00:00'],
                ['titulo_receita' => 'Lasanha',              'tipo_receita' => 'Prato Principal', 'custo_total' => 35.00, 'tempo_preparo_minutos' => 60, 'rendimento_porcoes' => 10, 'criado_em' => '2025-06-09 18:20:00'],
                ['titulo_receita' => 'Salada Caesar',        'tipo_receita' => 'Entrada',         'custo_total' => 20.00, 'tempo_preparo_minutos' => 15, 'rendimento_porcoes' => 4,  'criado_em' => '2025-06-08 12:00:00'],
                ['titulo_receita' => 'Torta de Limão',       'tipo_receita' => 'Sobremesa',       'custo_total' => 28.00, 'tempo_preparo_minutos' => 50, 'rendimento_porcoes' => 8,  'criado_em' => '2025-06-07 16:45:00'],
                ['titulo_receita' => 'Strogonoff de Frango', 'tipo_receita' => 'Prato Principal', 'custo_total' => 30.00, 'tempo_preparo_minutos' => 35, 'rendimento_porcoes' => 4,  'criado_em' => '2025-06-06 20:00:00'],
                ['titulo_receita' => 'Panqueca de Carne',    'tipo_receita' => 'Prato Principal', 'custo_total' => 22.00, 'tempo_preparo_minutos' => 45, 'rendimento_porcoes' => 6,  'criado_em' => '2025-06-05 19:30:00'],
                ['titulo_receita' => 'Sopa de Legumes',      'tipo_receita' => 'Entrada',         'custo_total' => 18.00, 'tempo_preparo_minutos' => 25, 'rendimento_porcoes' => 4,  'criado_em' => '2025-06-04 12:15:00'],
                ['titulo_receita' => 'Pizza Caseira',        'tipo_receita' => 'Prato Principal', 'custo_total' => 32.00, 'tempo_preparo_minutos' => 55, 'rendimento_porcoes' => 8,  'criado_em' => '2025-06-03 19:00:00'],
            ];
        }

        public function exibirFeed(){
            $limitepagina = 3;

            $paginaAtual = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
            if ($paginaAtual < 1)
                $paginaAtual = 1;

            $offset = ($paginaAtual - 1) * $limitepagina;

            require_once __DIR__ . '/../models/model_r.php';

            $totalReceitas = recipe::getTotal_nf();
            $receitas = recipe::getReceitas($limitepagina, $offset);

            if (empty($receitas)){
                $todas = $this->fallbackReceitas();
                $totalReceitas = count($todas);
                $receitas = array_slice($todas, $offset, $limitepagina);
            }

            $totalPaginas = ceil($totalReceitas / $limitepagina);

            return [
                'totalReceitas' => $totalReceitas,
                'totalPaginas' => $totalPaginas,
                'receitas' => $receitas,
                'paginaAtual' => $paginaAtual
            ];
        }
    }
