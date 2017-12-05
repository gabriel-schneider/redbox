{% extends "setup.volt" %}
{% block main %}
<div class="row center-lg center-md center-sm center-xs">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
        <h1>Em suas marcas...</h1>
        <p>A conexão com o banco de dados foi estabelecida! A próxima etapa irá criar as estruturas necessárias para o funcionamento do sistema.</p>
        <form method="post">
            <div class="control-group">
                <input type="submit" class="btn btn-red" value="Continuar"/>
            </div>
        </form>
    </div>
</div>
{% endblock %}