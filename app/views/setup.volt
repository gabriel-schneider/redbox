<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>RedBox</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('static/img/favicon/favicon-16x16.png') }}">
    {{ assets.outputCss() }}
  </head>
  <body>
  <div class="message-wrapper">
    {{ flashSession.output() }}
  </div>
  <div class="container-fluid">
    <div role="main" style="margin-top: 1rem;">
      {% block main %} {% endblock %}
    </div>
    <div class="row footer">
          <span>Desenvolvido com muito <i class="fa fa-coffee" aria-hidden="true"></i> por Gabriel Schneider</span>
    </div>
  </div>
  <footer>
      {{ assets.outputJs() }}
  </footer>
  </body>
</html>