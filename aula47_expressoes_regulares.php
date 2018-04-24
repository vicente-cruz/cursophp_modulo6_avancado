<?php

/**  Expressões regulares.
 * 
 * Seja '$expressao' a string a ser analisada.
 * 
 * Regras:
 */

//  1) Delimitador de um intervalo de valores: colchetes '[]'.
//   [0-9] - Testa se ''$expressao' possui algum dígito no intervalo de '0' a '9'.
echo "Expressao = a0bc / Padrao = [0-9]<br/>";
$expressao = "a0bc";
$pattern = "#[0-9]#";
if ( preg_match($pattern, $expressao, $matches) === 1 ) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//   [a-z] - Testa se ''$expressao' possui algum caractere no intervalo de 'a' a 'z'
echo "<br/><br/>Expressao = a0bc / Padrao = [a-z]<br/>";
$expressao = "a0bc";
$pattern = "#[a-z]#";
if ( preg_match($pattern, $expressao, $matches) === 1 ) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//   [A-Z] - Idem, mas no intervalo de 'A' a 'Z'
echo "<br/><br/>Expressao = a0Cc / Padrao = [A-Z]<br/>";
$expressao = "a0Cc";
$pattern = "#[A-Z]#";
if ( preg_match($pattern, $expressao, $matches) === 1 ) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  2) Quantificadores (+,*,?,{},^,$): quantas vezes um valor deve aparecer.
//   Ex: seja 'w' o valor procurado
//   w+: Se o valor 'w' aparece pelo menos 1 ou mais vezes na string '$expressao'.
//       Caso de sucesso / fracasso: word, rewwrite, draw, www / paint, rock.
echo "<br/><br/>Expressao = rewrite / Padrao = w+<br/>";
$expressao = "rewrite";
$pattern = '#w+#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//   w*: Se 'w' aparece zero ou mais vezes na string '$expressao'.
//       Sucesso / fracasso: word, rewwrite, draw, www, paint, rock
echo "<br/><br/>Expressao = rewrite / Padrao = w*<br/>";
$expressao = "To build";
$pattern = '#w*#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//   w?: Se 'w' aparece zero ou no máximo 1 vez na string '$expressao'.
//       S / F: word, rock, rewrite, draw, paint / rewwrite, www
echo "<br/><br/>Expressao = rewrite / Padrao = w?<br/>";
$expressao = "rewrite";
$pattern = '#w?#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//   w{2}: Se 'w' aparece N vezes em sequencia na string $expressao.
//       S/F: Feitoww, wwrite, rewwrite / ball, write, willow, wwwar
echo "<br/><br/>Expressao = rewwrite / Padrao = w{2}<br/>";
$expressao = "rewwrite";
$pattern = '#w{2}#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//   w{2,3}: Se 'w' aparece 2 ou 3 vezes em sequência na string $expressao.
//       S/F: rewwrite, www, feitowwww, wwrite / rock, write, willow.
echo "<br/><br/>Expressao = rewwwrite / Padrao = w{2,3}<br/>";
$expressao = "rewwwrite";
$pattern = '#w{2,3}#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//   w{2,}: Se 'w' aparece no mínimo 2 vezes em sequência.
//      S/F: wwrite, rewwrite, feitowww / willow, google, write
echo "<br/><br/>Expressao = rewwwwwrite / Padrao = w{2,}<br/>";
$expressao = "rewwwwwrite";
$pattern = '#w{2,}#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//  w$: Se w aparecer exatamente no fim da string $expressao
//      S/F: arrow, willow, windoww / write, rewrite, ball
echo "<br/><br/>Expressao = window / Padrao = w$<br/>";
$expressao = "windoww";
$pattern = '#w$#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//  ^w: Se w aparecer exatamente no começo da string $expressao
//      S/F: word, willow, write / row, rewrite
echo "<br/><br/>Expressao = window / Padrao = ^w<br/>";
$expressao = "word";
$pattern = '#^w#';
if (preg_match($pattern,$expressao,$matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";    
}

//  3) Combinando intervalos com quantificadores: [] com +,*,?,{},^,$
//      Obs: '^' dentro de '[]' é negação
//  [^a-zA-Z]: Se $expressão NÃO COMEÇA com nenhuma letra do alfabeto (min, masc)
//      S/F: '2ml', ' google', '&ref' / 'amanha', 'Bola', 'Xavasca'
echo "<br/><br/>Expressao = 2ml / Padrao = [^a-zA-Z]<br/>";
$expressao = "2ml";
$pattern = "#[^a-zA-Z]#i";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  w.w: Se $expressao possui um caractere de qualquer tipo entre dois 'w'
//  Obs: '.' representa "qualquer caractere"
//      S/F: wow, awew, rewiwl / willow, write, ball
echo "<br/><br/>Expressao = awew / Padrao = w.w<br/>";
$expressao = "Rock and wow";
$pattern = "#w.w#i";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  \bweb\b: Se $expressao possui a palavra 'web' dentro da string
//  Obs: '\b' representa a palavra distinta dentro da string
//      S/F: 'Linguagens web dao dinheiro', 'php eh linguagem web' / Farei um webinar
echo "<br/><br/>Expressao = Linguagens web dao dinheiro / Padrao = \bweb\b<br/>";
$expressao = "Linguagens web dao dinheiro";
$pattern = "#\bweb\b#i";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  ^.{2}$: Se $expressao possui exatamente 2 caracteres de qualquer tipo
//      S/F: ab, 4e, &*, u$ / not, write, hello
echo "<br/><br/>Expressao = Yo / Padrao = ^.{2}$<br/>";
$expressao = "Yo";
$pattern = "#^.{2}$#i";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  <c>(.*)</c>: Se $expressao possui qualquer expressao entre <c> e </c>
//      S/F: 'Minha <c>mae</c> ganhou', 'Vou me <c>casar</c>', 'senha <c>$%_ #</c>',
//          'Sem nada dentro <c></c>'
echo "<br/><br/>Expressao = Vou me ".htmlspecialchars("<c>casar</c>")." / Padrao = ".htmlspecialchars("<c>(.*)</c>")."<br/>";
$expressao = "Vou me <c>casar</c>";
$pattern = "#<c>(.*)</c>#i";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  w(.*)w: Se $expressao possui qualquer expressao entre dois 'w'
//      S/F: 'Minha wmaew ganhou', 'Vou me wcasarw', 'senha w$%_ #w',
//          'Sem nada dentro ww' / 'parametro wser', 'qualquer coisaw', 'nada mesmo'
echo "<br/><br/>Expressao = Vou me wcasarw / Padrao = w(.*)w<br/>";
$expressao = "Vou me wcasarw";
$pattern = "#w(.*)w#i";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  p(ph)*: Se $expressao possui expressão começando com p seguido por 0 ou + 'hp'
//      S/F: 'Vou programar em p', 'programacao php', 'linguagem phphph'
echo "<br/><br/>Expressao = Programação phphp / Padrao = p(hp)*<br/>";
$expressao = "Programação phphp";
$pattern = "#p(hp)*#";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  ^(.*)$: Se $expressao possui qualquer palavra com quaisquer caracteres
//      S/F: 'vou', 'programacao php', 'lin gu agem ph php$ _4 h '
echo "<br/><br/>Expressao = 'md f089u-j´p fe%¨ `r9 @u -9qu ' / Padrao = ^(.*)$<br/>";
$expressao = "md f089u-j´p fe%¨ `r9 @u -9qu ";
$pattern = "#^(.*)$#";
if (preg_match($pattern, $expressao, $matches)) {
    echo "Padrão encontrado.<br/>";
    print_r($matches);
}
else {
    echo "Padrão não encontrado.<br/>";
}

//  4) Atalhos para padrões predefinidos
//  [[:alpha:]] = [a-zA-Z],
//  [[:digit:]] = [0-9],
//  [[:alnum:]] = [a-zA-Z0-9]
//  [[:space:]] = Qualquer expressão contendo espaço