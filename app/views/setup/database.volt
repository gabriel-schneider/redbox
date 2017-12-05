{% extends "setup.volt" %}
{% block main %}
<div class="row center-lg center-md center-sm center-xs">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
        <h1>Banco de dados</h1>
        <p>Forneça as informações necessárias para a aplicação conectar com um banco de dados para persistir os dados dos usuários:</p>
        <form method="post">
            <div class="control-group">
                <label class="control label" for="host">Host:</label>
                <input type="text" class="control text" id="host" name="host" value="{{ host }}"/>
            </div>
            <div class="control-group">
                <label class="control label" for="dbname">Banco de dados:</label>
                <input type="text" class="control text" id="dbname" name="dbname" value="{{ dbname }}"/>
            </div>
            <div class="control-group">
                <label class="control label" for="username">Usuário:</label>
                <input type="text" class="control text" id="username" name="username" value="{{ username }}"/>
            </div>
            <div class="control-group">
                <label class="control label" for="password">Senha:</label>
                <input type="password" class="control text" id="password" name="password" value="{{ password }}"/>
            </div>
            <div class="control-group">
                <label class="control label" for="port">Porta:</label>
                <input type="text" class="control text" id="port" name="port" value="{{ port }}"/>
            </div>
            <div class="control-group">
                <input type="submit" class="btn btn-red" value="Continuar"/>
            </div>
        </form>
        
    </div>
</div>
{% endblock %}