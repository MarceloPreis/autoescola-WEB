<!DOCTYPE html>

<html>

<head>

  <?php
  include_once "conf/default.inc.php";
  require_once "conf/Conexao.php";

  $sql = "SELECT idaula, horarioIncio, horarioFIm FROM autoescola.aula";
  $pdo = Conexao::getInstance();
  $consulta = $pdo->query($sql);
  while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $id = $linha['idaula'];
    $color = "#0000ff";
    $start = $linha['horarioIncio'];
    $end = $linha['horarioFIm'];
    $url = "aula_show.php?acao=editar&id=$id";

    $eventos[] = [
      'id' => $id,
      'title' => "Aula - $id",
      'color' => $color,
      'start' => $start,
      'end' => $end,
      'url' => $url
    ];
  }
  ?>

  <meta charset='utf-8' />
  <link href='css/estilo.css' rel='stylesheet' />
  <link href='lib/main.css' rel='stylesheet' />
  <script src='lib/main.js'></script>
  <script src='lib/locales/pt-br.js'></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prevYear,prev,next,nextYear today',
          center: 'title',
          right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        initialDate: '2021-11-12',
        navLinks: true,
        editable: true,
        dayMaxEvents: true,
        locale: 'pt-br',
        events: <?php echo json_encode($eventos) ?>
      });

      calendar.render();
    });
  </script>

</head>

<body>

  <div class="header">
    <h1> Calendário </h1>
  </div>

  <div class="topnav">
    <a href="home.php">Home</a>
    <a href="aula_cadastro.php">Cadastrar Aula</a></br></br></br>
  </div>


  <div id='calendar'></div>

</body>

</html>