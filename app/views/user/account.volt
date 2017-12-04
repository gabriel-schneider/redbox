{% extends "base.volt" %}
{% block main %}
<div class="row center-lg center-md center-xs">
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
     <form name="account-form" method="post" autocomplete="off"
            <p>Atualize suas informações preenchendo os campos abaixo:</p>
            <label class="control label" for="display-name">Nome:</label>
            <input class="control text" name="display-name" type="text" value="{{ user.displayName }}"/>

            <label class="control label" for="email">E-mail:</label>
            <input class="control text" name="email" type="email" value="{{ user.email }}"/>

            <label class="control label" for="password">Senha:</label>
            <input class="control text" name="password" type="password" value="" autocomplete="off"/>

            <label class="control label" for="password-confirm">Confirmação da senha:</label>
            <input class="control text" name="password-confirm" type="password" value=""/>
            
            <input class="btn btn-red" type="submit" value="Salvar"/>    
        </form>
    </div>
</div>

{% endblock %}