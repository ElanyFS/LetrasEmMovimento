<main class="main">
    <div class="credit">
        <h1> <a href="#formulario">INSCREVA-SE</a></h1>
        <h4>Preencha o formulário de cadastro e participe!</h4>
    </div>
</main> <br>

<div class="container" id="formulario">

    <h1 class="display-4">Formulário de Inscrição</h1>
    <br>

    <?php echo getMessage('message'); ?>

    <form class="formulario" action="/user/create" method="post" enctype="multipart/form-data" id="form-create">

        <h3>Tipo de Inscrição</h3>

        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="tipoinscricao" style="background-color:#EEE9E9;">
            <option value="" selected>SELECIONE</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <?php echo getFlash('tipoinscricao'); ?>

        <h3>Informações Pessoais</h3>

        <div class="row">
            <div class="col">
                <label for="nome" class="form_label">Nome <span>*</span></label>
                <input name="nome" type="text" class="form-control border" placeholder="Nome" style="background-color:#EEE9E9;" value="<?php echo getOld('nome'); ?>">
                <?php echo getFlash('nome'); ?>
            </div>
            <div class="col">
                <label for="datanascimento" class="form_label">Data de nascimento <span>*</span></label>
                <input max="9999-12-31" name="datanascimento" type="date" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('datanascimento'); ?>">
                <?php echo getFlash('datanascimento'); ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col">
                <label for="registro" class="form_label">RG <span>*</span></label>
                <input minlength="13" maxlength="13" name="registro" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('registro'); ?>">
                <?php echo getFlash('registro'); ?>
            </div>
            <div class="col">
                <label for="cpf" class="form_label">CPF <span>*</span></label>
                <input minlength="14" maxlength="14" name="cpf" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('cpf'); ?>" OnKeyPress="formatar('###.###.###-##',this)">
                <?php echo getFlash('cpf'); ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col">
                <label for="telefone" class="form_label">Telefone (Whatsapp) <span>*</span></label>
                <input minlength="16" maxlength="16" name="telefone" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('telefone'); ?>" OnKeyPress="formatar('(##) # ####-####',this)">
                <?php echo getFlash('telefone'); ?>
            </div>

            <div class="col">
                <label for="endereco" class="form_label">Endereço <span>*</span></label>
                <input name="endereco" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('endereco'); ?>">
                <?php echo getFlash('endereco'); ?>
            </div>

            <div class="col">
                <label for="numero" class="form_label">Número <span>*</span></label>
                <input name="numero" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('numero'); ?>">
                <?php echo getFlash('numero'); ?>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col">
                <label for="bairro" class="form_label">Bairro <span>*</span></label>
                <input name="bairro" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('bairro'); ?>">
                <?php echo getFlash('bairro'); ?>
            </div>

            <div class="col">
                <label for="cidade" class="form_label">Cidade <span>*</span></label>
                <select name="cidade" class="form-select" name="cidade" style="background-color:#EEE9E9;">
                    <option value="" selected>SELECIONE</option>
                    <?php foreach ($municipios as $key => $municipio) { ?>
                        <option value="<?php echo $municipios[$key]->id; ?>"><?php echo $municipios[$key]->nome_municipio; ?></option>
                    <?php } ?>
                </select>
                <?php echo getFlash('cidade'); ?>
            </div>

            <div class="col">
                <label for="cep" class="form_label">CEP <span>*</span></label>
                <input minlength="9" maxlength="9" name="cep" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('cep'); ?>" OnKeyPress="formatar('#####-###',this)">
                <?php echo getFlash('cep'); ?>
            </div>
        </div>

        <hr> <br>

        <h3>Nível de Escolaridade</h3>

        <div class="row">
            <div class="col">
                <label class="legenda">Concluiu Ensino Médio em Escola Pública? <span>*</span></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="escolapublica" id="sim" value="sim">
                    <label name="escolapublica" class="form-check-label" for="sim">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="escolapublica" id="nao" value="nao">
                    <label name="escolapublica" class="form-check-label" for="nao">Não</label>
                </div>
                <?php echo getFlash('escolapublica'); ?>
            </div>

            <div class="col">
                <label for="formFileLg" class="form-label" name="comprovanteescolapublica">Anexar comprovante de conclusão do ensino médio em escola pública (PFD/PNG/JPG)</label>
                <input class="form-control form-control-lg" id="formFileLg" type="file" name="comprovanteescolapublica" style="background-color:#EEE9E9;" value="<?php echo getOld('comprovanteescolapublica'); ?>">
                <?php echo getFlash('comprovanteescolapublica'); ?>
            </div>
        </div>

        <br>
        <hr>

        <div class="row">
            <div class="col">
                <label class="legenda" for="">Está trabalhando atualmente? <span>*</span></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="trabalhando" id="sim" value="sim">
                    <label name="trabalhando" class="form-check-label" for="sim">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="trabalhando" id="nao" value="nao">
                    <label name="trabalhando" class="form-check-label" for="nao">Não</label>
                </div>
                <?php echo getFlash('trabalhando'); ?>
            </div>

            <div class="col">
                <label for="localtrabalho" class="form_label">Local de trabalho</label>
                <input type="text" name="localtrabalho" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('localtrabalho'); ?>">
                <?php echo getFlash('localtrabalho'); ?>
            </div>

            <div class="col">
                <label for="funcao" class="form_label">Sua funçao no trabalho?</label>
                <input type="text" name="funcao" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('funcao'); ?>">
                <?php echo getFlash('funcao'); ?>
            </div>
        </div>

        <hr> <br>

        <!-- <h3>Descreva sua experiência na área de Educação</h3>

        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="trabalhouescolas" class="form-label">Já trabalhou em escolas? <span>*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="trabalhouescolas" style="background-color:#EEE9E9;"></textarea>
                    <?php echo getFlash('trabalhouescolas'); ?>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="autonomo" class="form-label">Sua expreriência é como autônomo? <span>*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="autonomo" style="background-color:#EEE9E9;"></textarea>
                    <?php echo getFlash('autonomo'); ?>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="comercio" class="form-label">Comércio informal de alimentos? <span>*</span></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comercio" style="background-color:#EEE9E9;"></textarea>
                    <?php echo getFlash('comercio'); ?>
                </div>
            </div>
        </div> -->

        <!-- <br> -->

        <h3>Comprovantes</h3>

        <div class="row">
            <div class="col">
                <label for="comprovanteescolaridade" class="form-label">Anexar comprovante de escolaridade <span>*</span></label>
                <input class="form-control form-control-lg" id="formFileLg" type="file" name="comprovanteescolaridade" style="background-color:#EEE9E9;">
                <?php echo getFlash('comprovanteescolaridade'); ?>
            </div>

            <!-- <div class="col">
                <label for="comprovanteexperiencia" class="form-label">Anexar comprovante de experiência de trabalho com cozinha 2 anos <span>*</span></label>
                <input class="form-control form-control-lg" id="formFileLg" type="file" name="comprovanteexperiencia" style="background-color:#EEE9E9;">
                <?php echo getFlash('comprovanteexperiencia'); ?>
            </div> -->
        </div>

        <br>

        <div class="row">
            <div class="col">
                <label for="email" class="form_label">E-mail <span>*</span></label>
                <input name="email" type="text" class="form-control" style="background-color:#EEE9E9;" value="<?php echo getOld('email'); ?>">
                <?php echo getFlash('email'); ?>
            </div>
            <div class="col">
                <label for="emailconfirm" class="form_label">Repita seu E-mail <span>*</span></label>
                <input type="text" class="form-control" name="emailconfirm" style="background-color:#EEE9E9;" value="<?php echo getOld('emailconfirm'); ?>">
                <?php echo getFlash('emailconfirm'); ?>
            </div>
        </div>

        <br>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button id="buttonEnviar" class="btn btn text-light" type="submit">Clique aqui e faça sua inscrição</button>
            <div class="loader" hidden id="loader"></div>
        </div>
    </form>
</div>