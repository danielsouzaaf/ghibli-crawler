<!doctype html>
<html lang="pt-BR">
    <head>
        <style>
            .zui-table {
                border: solid 1px #DDEEEE;
                border-collapse: collapse;
                border-spacing: 0;
                font: normal 13px Arial, sans-serif;
            }
            .zui-table thead th {
                background-color: #DDEFEF;
                border: solid 1px #DDEEEE;
                color: #336B6B;
                padding: 10px;
                text-align: left;
                text-shadow: 1px 1px 1px #fff;
            }
            .zui-table tbody td {
                border: solid 1px #DDEEEE;
                color: #333;
                padding: 10px;
                text-shadow: 1px 1px 1px #fff;
            }
            /*credits to Dimitar Ivanov on https://jsfiddle.net/zinoui/dB93J/*/
        </style>
    </head>
    <table class="zui-table">
        <thead>
        <tr>
            <th>Nome do Personagem</th>
            <th>Idade do Personagem</th>
            <th>Filme(s)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($mapped as $personagem)
            <tr>
                <th>{{$personagem['nome']}}</th>
                <th>{{$personagem['idade']}}</th>
                <th>
                    <ul>
                        @foreach($personagem['filmes'] as $filme)
                        <li>
                            {{"Título: {$filme['titulo']} ({$filme['ano_lancamento']}). Pontuação Rotten Tomatoes: {$filme['pontuacao_rotten_tomatoes']}"}}
                        </li>
                        @endforeach
                    </ul>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
</html>