{% extends "setup.volt" %}
{% block main %}
<div class="row center-lg center-md center-sm center-xs">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
        <h1>Administrador</h1>
        <p>É hora de criar um usuário para administrar o sistema:</p>
        <form method="post">
            <div class="control-group">
                <label class="control label" for="name">Nome:</label>
                <input type="text" class="control text" id="name" name="name" value="{{ user.displayName }}"/>
            </div>
            <div class="control-group">
                <label class="control label" for="email">E-mail:</label>
                <input type="text" class="control text" id="email" name="email" value="{{ user.email }}"/>
            </div>
            <div class="control-group">
                <label class="control label" for="password">Senha:</label>
                <input type="password" class="control text" id="password" name="password" />
            </div>
            <div class="control-group">
                <input type="submit" class="btn btn-red" value="Continuar"/>
            </div>
        </form>
        
    </div>
</div>
{% endblock %}