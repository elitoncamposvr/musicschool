<div class="content">
    <div class="breadcrumb">
        <h2>Alunos<i class="fas fa-angle-right fa-xs"></i>Avaliação</h2>
    </div>
    <?php if ($students_info['evaluation_stage'] == 0 || $students_info['evaluation_stage'] == '') { ?>
        <div class="mb-el">
            <h2>Campo de experiência 1</h2>
            <h3>
                O eu, o outro e nós.
            </h3>
        </div>
        <form method="post">
            <input type="hidden" name="stage" value="1" required>
            <input type="hidden" name="student_class" value="<?php echo $students_info['student_class_id']; ?>" required>
            <input type="hidden" name="series_id" value="<?php echo $students_info['series_id']; ?>" required>
            <div class="question">
                <div class="question-title">
                    1 - Age de maneira independente, com confiança em suas capacidades, reconhecendo suas conquistas e limites?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer1" id="answer1" value="1" required> C - começando <br>
                    <input type="radio" name="answer1" id="answer1" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer1" id="answer1" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    2 - Respeita as regras nas interaçõe e brincadeiras?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer2" id="answer2" value="1" required> C - começando <br>
                    <input type="radio" name="answer2" id="answer2" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer2" id="answer2" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    3 - Consegue comunicar suas ideias e sentimentos aos colegas e professores com respeito?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer3" id="answer3" value="1" required> C - começando <br>
                    <input type="radio" name="answer3" id="answer3" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer3" id="answer3" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    4 - Reconhece os sentimentos dos outros e os seus próprios, respeitando as diferenças?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer4" id="answer4" value="1" required> C - começando <br>
                    <input type="radio" name="answer4" id="answer4" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer4" id="answer4" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    5 - Compartilha objetos e espaços com outras crianças e com adultos?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer5" id="answer5" value="1" required> C - começando <br>
                    <input type="radio" name="answer5" id="answer5" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer5" id="answer5" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    6 - Tem atitudes de empatia, auxiliando as outras crianças em diversas situações do turno de aula?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer6" id="answer6" value="1" required> C - começando <br>
                    <input type="radio" name="answer6" id="answer6" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer6" id="answer6" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    7 - Tem atitudes de participação e colaboração em momentos coletivos, ampliando as relações com os colegas?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer7" id="answer7" value="1" required> C - começando <br>
                    <input type="radio" name="answer7" id="answer7" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer7" id="answer7" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    8 - Reconhece as características de seu corpo, percebendo as diferenças das demais crianças de forma respeitosa, vendo-se de forma positiva?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer8" id="answer8" value="1" required> C - começando <br>
                    <input type="radio" name="answer8" id="answer8" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer8" id="answer8" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    9 - Em situações de conflitos nas interações com crianças e adultos, consegue utilizar estratégias pautadas no respeito mútuo para buscar soluções?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer9" id="answer9" value="1" required> C - começando <br>
                    <input type="radio" name="answer9" id="answer9" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer9" id="answer9" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="w-100">
                <button type="submit">Enviar Respostas</button>
            </div>
        </form>
    <?php } ?>

    <?php if ($students_info['evaluation_stage'] == 1) { ?>
        <div class="mb-el">
            <h2>Campo de experiência 2</h2>
            <h3>
                Corpo, gesto e movimento
            </h3>
        </div>
        <form method="post">
            <input type="hidden" name="stage" value="2" required>
            <input type="hidden" name="student_class" value="<?php echo $students_info['student_class_id']; ?>" required>
            <input type="hidden" name="series_id" value="<?php echo $students_info['series_id']; ?>" required>
            <div class="question">
                <div class="question-title">
                    1 - Demonstra controle e adequação do uso de seu corpo em brincadeiras e jogos?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer1" id="answer1" value="1" required> C - começando <br>
                    <input type="radio" name="answer1" id="answer1" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer1" id="answer1" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    2 - Tem independência ao cuidar do próprio corpo, nos aspectos relacionados à higiene?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer3" id="answer3" value="1" required> C - começando <br>
                    <input type="radio" name="answer3" id="answer3" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer3" id="answer3" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    3 - Nos momentos de alimentação, tem autonomia para comer?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer4" id="answer4" value="1" required> C - começando <br>
                    <input type="radio" name="answer4" id="answer4" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer4" id="answer4" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    4 - Tem consciência corporal, sendo capaz de representar o corpo humano por meio de desenho, distinguindo as
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer5" id="answer5" value="1" required> C - começando <br>
                    <input type="radio" name="answer5" id="answer5" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer5" id="answer5" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    5 - Cria com o corpo formas diversificadas de expressão de sentimentos, sensações e emoções, tanto nas situações
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer6" id="answer6" value="1" required> C - começando <br>
                    <input type="radio" name="answer6" id="answer6" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer6" id="answer6" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    6 - Coordena suas habilidades manuais no atendimento adequado aos seus interesses e necessidades em situações
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer7" id="answer7" value="1" required> C - começando <br>
                    <input type="radio" name="answer7" id="answer7" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer7" id="answer7" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="w-100">
                <button type="submit">Enviar Respostas</button>
            </div>
        </form>
    <?php } ?>

    <?php if ($students_info['evaluation_stage'] == 2) { ?>
        <div class="mb-el">
            <h2>Campo de experiência 3</h2>
            <h3>
                Traços, sons, cores e formas
            </h3>
        </div>
        <form method="post">
            <input type="hidden" name="stage" value="3" required>
            <input type="hidden" name="student_class" value="<?php echo $students_info['student_class_id']; ?>" required>
            <input type="hidden" name="series_id" value="<?php echo $students_info['series_id']; ?>" required>
            <div class="question">
                <div class="question-title">
                    1 - Consegue usar adequadamente tinta, tesoura, lápis de cor, cola e outros materiais para expressar-se por meio das artes?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer1" id="answer1" value="1" required> C - começando <br>
                    <input type="radio" name="answer1" id="answer1" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer1" id="answer1" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    2 - Sabe diferenciar os sons e os ritmos de acordo com sua intensidade, duração, altura e timbre?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer3" id="answer3" value="1" required> C - começando <br>
                    <input type="radio" name="answer3" id="answer3" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer3" id="answer3" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    3 - Utiliza a musicalidade em brincadeiras e outras atividades?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer4" id="answer4" value="1" required> C - começando <br>
                    <input type="radio" name="answer4" id="answer4" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer4" id="answer4" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    4 - Consegue produzir sons com materiais diversos em momentos dirigidos ou em brincadeiras?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer5" id="answer5" value="1" required> C - começando <br>
                    <input type="radio" name="answer5" id="answer5" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer5" id="answer5" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="w-100">
                <button type="submit">Enviar Respostas</button>
            </div>
        </form>
    <?php } ?>

    <?php if ($students_info['evaluation_stage'] == 3) { ?>
        <div class="mb-el">
            <h2>Campo de experiência 4</h2>
            <h3>
                Espaços, tempos, quantidades, relações e transformações
            </h3>
            <h3>
                Ao ter contato com livros, consegue ter interesse por meio das ilustrações, compreendendo seu conteúdo?
            </h3>
        </div>
        <form method="post">
            <input type="hidden" name="stage" value="4">
            <input type="hidden" name="student_class" value="<?php echo $students_info['student_class_id']; ?>" required>
            <input type="hidden" name="series_id" value="<?php echo $students_info['series_id']; ?>" required>
            <div class="question">
                <div class="question-title">
                    1 - Consegue comparar objetos, deferenciando suas propriedades, tais como: tamanho, peso, textura, formato?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer1" id="answer1" value="1" required> C - começando <br>
                    <input type="radio" name="answer1" id="answer1" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer1" id="answer1" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    2 - Consegue representar por meio de desenhos distinções de medidas como altura e peso?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer2" id="answer2" value="1" required> C - começando <br>
                    <input type="radio" name="answer2" id="answer2" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer2" id="answer2" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    3 - Relata fatos importantes sobre seu nascimento e desenvolvimento, a história dos seus familiares ou de pessoas com quem convive?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer3" id="answer3" value="1" required> C - começando <br>
                    <input type="radio" name="answer3" id="answer3" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer3" id="answer3" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    4 - Ao contar acontecimentos, consegue indicar corretamente os marcadores de tempo, tais como: ontem, hoje, amanhã, manhã, tarde e noite?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer4" id="answer4" value="1" required> C - começando <br>
                    <input type="radio" name="answer4" id="answer4" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer4" id="answer4" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    5 - Consegue relacionar os números às suas respectivas quantidades?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer5" id="answer5" value="1" required> C - começando <br>
                    <input type="radio" name="answer5" id="answer5" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer5" id="answer5" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    6 - Identifica o antes, o depois e o entre em uma sequência de números?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer6" id="answer6" value="1" required> C - começando <br>
                    <input type="radio" name="answer6" id="answer6" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer6" id="answer6" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    7 - Ao receber indicações de sentido como para frente, para trás, para cima ou para baixo, coordena-se corretamente?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer7" id="answer7" value="1" required> C - começando <br>
                    <input type="radio" name="answer7" id="answer7" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer7" id="answer7" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="w-100">
                <button type="submit">Enviar Respostas</button>
            </div>
        </form>
    <?php } ?>

    <?php if ($students_info['evaluation_stage'] == 4) { ?>
        <div class="mb-el">
            <h2>Campo de experiência 5</h2>
            <h3>
                Escuta, fala, pensamento e imaginação
            </h3>
        </div>
        <form method="post">
            <input type="hidden" name="stage" value="5">
            <input type="hidden" name="student_class" value="<?php echo $students_info['student_class_id']; ?>" required>
            <input type="hidden" name="series_id" value="<?php echo $students_info['series_id']; ?>" required>
            <div class="question">
                <div class="question-title">
                    1 - Ao ter contato com livros, consegue ter interesse por meio das ilustrações, compreendendo seu conteúdo? </div>
                <div class="question-answer">
                    <input type="radio" name="answer1" id="answer1" value="1" required> C - começando <br>
                    <input type="radio" name="answer1" id="answer1" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer1" id="answer1" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    2 - Consegue recontar uma história, ou pelo menos, as principais partes?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer2" id="answer2" value="1" required> C - começando <br>
                    <input type="radio" name="answer2" id="answer2" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer2" id="answer2" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    3 - Levanta hipóteses em relação à linguagem escrita, realizando registros de palavras e textos, por meio de escrita espontânea?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer3" id="answer3" value="1" required> C - começando <br>
                    <input type="radio" name="answer3" id="answer3" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer3" id="answer3" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    4 - Ao ouvir contações de histórias ou outras leituras, demonstra atenção e interesse e consegue interagir com o professor?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer4" id="answer4" value="1" required> C - começando <br>
                    <input type="radio" name="answer4" id="answer4" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer4" id="answer4" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    5 - Consegue identificar e criar rimas em brincadeiras ou músicas?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer5" id="answer5" value="1" required> C - começando <br>
                    <input type="radio" name="answer5" id="answer5" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer5" id="answer5" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="question">
                <div class="question-title">
                    6 - Consegue criar suas próprias histórias a partir do fornecimento de alguns elementos, como: personagens, espaços, dentre outros?
                </div>
                <div class="question-answer">
                    <input type="radio" name="answer6" id="answer6" value="1" required> C - começando <br>
                    <input type="radio" name="answer6" id="answer6" value="2" required> D - desenvolvendo <br>
                    <input type="radio" name="answer6" id="answer6" value="3" required> A - alcançado <br>
                </div>
            </div>
            <div class="w-100">
                <button type="submit">Enviar Respostas</button>
            </div>
        </form>
    <?php } ?>
    <?php if ($students_info['evaluation_stage'] == 5) { ?>
        <div class="w-100 py-3">
            Avaliação Concluída!
        </div>
    <?php } ?>
</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>