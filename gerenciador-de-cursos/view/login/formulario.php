<?php include __DIR__ . '/../inicio-html.php'; ?>

<form action="/realiza-login" method="POST">
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" />
    </div>
    <div class="form-group">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" class="form-control" />
    </div>
    <input type="submit" value="Entrar" class="btn btn-info btn-sm" />
</form>

<?php include __DIR__ . '/../fim-html.php'; ?>