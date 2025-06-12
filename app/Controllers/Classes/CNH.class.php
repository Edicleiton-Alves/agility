<?php

namespace Classes;

class CNH
{
    public function validar($cnh)
    {
        $cnh = preg_replace('/[^0-9]/', '', $cnh); // SOMENTE NÚMEROS

        if (strlen($cnh) != 11) { // DEVE TER 11 CARACTERES
            return [
                'status' => 'error',
                'msg' => 'A CNH precisa ter 11 dígitos'
            ];
        }

        if (preg_match('/(\d)\1{10}/', $cnh)) { // SE TODOS OS CARACTERES SÃO IGUAIS
            return [
                'status' => 'error',
                'msg' => 'CNH inválida, todos os dígitos são iguais'
            ];
        }

        // // Calcular o primeiro dígito verificador
        // $multiplicador = 9;
        // $soma = 0;
        // for ($i = 0; $i < 9; $i++) {
        //     $soma += $cnh[$i] * $multiplicador;
        //     $multiplicador--;
        // }
        // $resto = $soma % 11;
        // $digito1 = ($resto >= 10) ? 0 : $resto;

        // // Calcular o segundo dígito verificador
        // $multiplicador = 1;
        // $soma = 0;
        // for ($i = 0; $i < 9; $i++) {
        //     $soma += $cnh[$i] * $multiplicador;
        //     $multiplicador++;
        // }
        // $soma += $digito1 * 2;
        // $resto = $soma % 11;
        // $digito2 = ($resto >= 10) ? 0 : $resto;

        // // Verificar se os dígitos verificadores estão corretos
        // if (($cnh[9] != $digito1) || ($cnh[10] != $digito2)) {
        //     return [
        //         'status' => 'error',
        //         'msg' => 'CNH inválida'
        //     ];
        // }

        return [
            'status' => 'success',
            'msg' => 'Dados validados',
            'cnh' => $cnh
        ];
    }
}
