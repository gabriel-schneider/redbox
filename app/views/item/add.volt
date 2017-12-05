{% extends "base.volt" %}
{% block main %}
<div class="row center-lg center-md center-sm center-xs">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
        <form method="post" enctype="multipart/form-data">
            <div class="control-group">
                <label class="control label" for="title">Titulo:</label>
                {{ form.render('title', ['class': 'control text']) }}
            </div>

            <div class="control-group">
                <label class="control label" for="title">Descrição:</label>
                {{ form.render('description', ['class': 'control text']) }}
            </div>

            <div class="control-group">
                <label class="control label" for="title">Limite de reservas ativas:</label>
                <div>
                    {{ form.render('maxBookTotal', ['class': 'control text']) }}
                    <span class="small">0 = Ilimitado</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control label" for="title">Limite de reservas por usuário:</label>
                <div>
                    {{ form.render('maxBookPerUser', ['class': 'control text']) }}
                    <span class="small">0 = Ilimitado</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control label" for="title">Visibilidade:</label>         
                {{ form.render('visibility', ['class': 'control text']) }}
            </div>

            <div class="control-group">
                <label class="control label" for="title">Imagem:</label>         
                {{ form.render('image', ['class': 'control text']) }}
            </div>

            <input type="submit" value="{{ submitValue }}" class="btn btn-red"/>
        </form>
    </div>
</div>

{% endblock %}