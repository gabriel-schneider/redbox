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
    <div class="row">
      <div class="col-xs col-sm col-md col-lg">
        {{ partial("navbar") }}
      </div>
    </div>
    <div role="main" style="margin-top: 1rem;">
      {% block main %} {% endblock %}
    </div>
    <div class="row footer">
          <span>Desenvolvido com <i class="fa fa-heart" aria-hidden="true"></i> por Gabriel Schneider</span>
    </div>
  </div>
  <footer>
      {{ assets.outputJs() }}
  </footer>
  </body>
</html>