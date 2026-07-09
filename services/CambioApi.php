<?php
namespace Services;

class CambioApi {

    // Consome a API pública ExchangeRate (open.er-api.com) para converter AOA -> USD
    public static function obterTaxaUsd() {
        $url = "https://open.er-api.com/v6/latest/AOA";

        $contexto = stream_context_create(['http' => ['timeout' => 4]]);
        $resposta = @file_get_contents($url, false, $contexto);

        if ($resposta === false) {
            return null;
        }

        $dados = json_decode($resposta, true);

        if (isset($dados['rates']['USD'])) {
            return (float) $dados['rates']['USD'];
        }

        return null;
    }

    public static function converterParaUsd($valorAoa, $taxa) {
        if (!$taxa) return null;
        return $valorAoa * $taxa;
    }
}
