<?php
// dados para conectar no banco
$host = "localhost";
$porta = "5432";
$banco = "projeto_crud";
$usuario = "postgres";
$senha = "SUA_SENHA_AQUI";

$erro = "";
$tarefas = array();

try {
    // conecta no PostgreSQL
    $pdo = new PDO("pgsql:host=$host;port=$porta;dbname=$banco", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // busca todas as tarefas
    $sql = "SELECT id, titulo, descricao, status FROM tarefas ORDER BY id";
    $resultado = $pdo->query($sql);
    $tarefas = $resultado->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // se der erro, mostra uma mensagem simples
    $erro = "Não foi possível conectar ao banco de dados.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de tarefas</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
        }
        .erro {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Tarefas</h1>

    <?php
    if ($erro != "") {
        // mostra o erro
        echo "<p class='erro'>" . $erro . "</p>";
    } else {
        // mostra a tabela
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Título</th>";
        echo "<th>Descrição</th>";
        echo "<th>Status</th>";
        echo "</tr>";

        // uma linha para cada tarefa
        foreach ($tarefas as $t) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($t['id']) . "</td>";
            echo "<td>" . htmlspecialchars($t['titulo']) . "</td>";
            echo "<td>" . htmlspecialchars($t['descricao']) . "</td>";
            echo "<td>" . htmlspecialchars($t['status']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>

