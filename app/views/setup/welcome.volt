{% extends "setup.volt" %}
{% block main %}
<div class="row center-lg center-md center-sm center-xs">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>Configuração Redbox</h1>
        <p>Bem-vindo ao assistente de configuração da aplicação, as próximas etapas irão configurar o sistema para que funcione corretamente.</p>
        <a class="btn btn-red" href="{{ url('setup/database') }}">Continuar</a>
    </div>
</div>
{% endblock %}