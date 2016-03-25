##O sistema deverá possuir 4 módulos:
  - Depósito
  - Materiais
  - Etiquetas
  - Inventário
  
##Depósito
Base para inclusão de todos os centros e seus dados

####Campos
  1. Empresa
  2. Centro
  3. Região
  4. Tipo Logradouro
  5. Logradouro
  6. Número
  7. Bairro
  8. Complemento
  9. Cidade
  10. CEP
  11. Status (ComboBox)
  12. Livre 1
  13. Livre 2
  14. Livre 3
  15. Observação


![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/1.png "Depósito")



##Materiais
Base para a inclusão de todos os materiais e seus dados, como Unidade de Medida e Valor Unitário

####Campos
  1. Código
  2. Texto Breve do Material
  3. Unidade de Medida
  4. Valor Unitário
  5. Livre 1
  6. Livre 2
  7. Livre 3
  8. Observação
  

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/2.png "Materiais")


##Etiquetas
De fato uma das bases de maior importância em nosso sistema, já que conterá os códigos gerais, códigos de leituras, materiais vinculados aos centros, enfim, tudo o necessário para a realização do inventário.

**Etiquetas são campos de vínculos entre Materiais e Depósitos**

####Campos
  1. Centro (Combo Box)
  2. Material (Combo Box)
  3. Qtd
  4. Observação
  
  
![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/3.png "Etiquetas")

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/P%C3%A1gina%20Etiquetas%20-%2017-02(Completo.png "Etiquetas Completo")

1 – Quando eu importar a lista, vou indicar quantas etiquetas especificas vou imprimir de cada...
Devemos colocar o campo no final. A quantidade informada será a quantidade de vezes que a mesma etiqueta deverá ser gerada e impressa.
Está circulado de roxo.

###Impressao

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/image009.jpg "Impressão")


##Inventario
De fato o resultado das leituras realizadas, serve como base geral para o relatório por centro e o final, contem todos os dados necessários para avaliação dos inventários realizados.

A parte sistêmica que apresenta o resultado bruto de todo o trabalho realizado, tem como intuito fornecer as informações finais para a finalização do processo e montagem dos relatórios.



![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/4.png "Etiquetas")


###Considerações para Impressão
O Gabarito está em WORD e em PDF como devem sair para impressão. Lembrando que a quantidades de etiquetas por produto serão definidas pelo campo de quantidade.
Os dados são:

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/tabela.png "Tabela")


1 – Quando eu importar a lista, vou indicar quantas etiquetas especificas vou imprimir de cada...
Devemos colocar o campo no final. A quantidade informada será a quantidade de vezes que a mesma etiqueta deverá ser gerada e impressa.
Está circulado de roxo.

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/P%C3%A1gina%20Etiquetas%20-%2017-02(Completo.png "Etiquetas Completo")

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/image008.jpg "Etiquetas Completo")


#Orientações e Questionamentos
#####Abaixo retorno de suas orientações e questionamentos:

###Base Depósito: 
Campo Livre – podemos utilizar um ou mais campos livres para definir a localização do material: Rua XX /Prateleira XX/Posição XX no Porta Palet/Mezanino/Corredor XX /Área Interna/Área Externa/Outros;
**Resp.:** Estes Campos estarão disponíveis no momento da pistolagem da etiqueta, sendo exibidos(quando inseridos) na Aba “INVETÁRIO” do sistema, conforme ilustrações acima.

###Base Materiais: 
Incluir as colunas de QTDE DE MATERIAIS E VALOR TOTAL. Essas informações serão fornecidas na base congelada do inventário para cada linha de material;
**Resp.:** Ok, incluí na Base de Materiais. Esta informação será utilizada pelo sistema para a montagem da Base Final de Inventário. Na verdade a quantidade é inserida e fica oculta nesta parte(Materiais), sendo exibida em “INVENTÁRIO”.

###Base etiquetas: 
Não é necessário incluir o nome do segmento, o número do Centro é a segunda chave mais importante. Para deixar as informações nas etiquetas mais “clean”, excluir o código do material que identifica a 1ª, 2ª. Ou 3ª. Leitura (devendo ser mantida na base sistêmica para identificação e controle das leituras). O nome da EPS na etiqueta é irrelevante. Se houver necessidade de reduzir linhas na etiqueta, pode-se excluir essa linha. Unidade de Medida: manter (importante para imput das quantidades lançadas no sistema).
**Resp.:** Alterações realizadas. Etiqueta mais clean e assertiva, conforme acima.

###Base Inventário: 
Incluir duas colunas para cálculo da acuracidade (física e financeira), indicador que mede a eficiência de armazenagem ou índice de desempenho da EPS com relação ao estoque.
**Resp.:** Incluídos na base final “INVENTÁRIO”

**Identificação Visual das leituras nas etiquetas**: após a contagem de cada item é importante colocar um adesivo colorido identificando que o material já foi inventariado (por exemplo: 1ª. Leitura, cor verde; segunda leitura, cor vermelha; 3ª. Leitura cor preta). Dessa forma facilita a varredura no depósito para identificar se foi realizada 100% das contagens.

###Leituras

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/view.png "Visualização leitura")

![alt text](https://raw.githubusercontent.com/matheushf/Vivo-Inventario/master/Projeto/leit1.png "Mobile")

***1ª CONTAGEM:***
·         Quantidade Aferida: é a quantidade aferida e deverá ser inclusa – Deverá ser mostrada em leitura 1
·         Confirmar quantidade: é o mesmo valor acima, por isso devem estar iguais para permitir a inclusão da informação, se estiver diferente deve-se corrigir para permitir a finalização. É um trava de segurança
·         ID MATERIAL: é informado manualmente. Deverá ser carregado em “ID material” na aba Inventário da web
·         LOC MATERIAL: Informação manual(endereço dentro do depósito). Deverá ser mostrado em Localização interna na web
·         Livre 1: Livre para o futuro
·         Livre 2: Livre para o futuro

***2ª CONTAGEM:***
·         Quantidade Aferida: é a quantidade aferida e deverá ser inclusa – Deverá ser mostrada em leitura 2
·         Confirmar quantidade: é o mesmo valor acima, por isso devem estar iguais para permitir a inclusão da informação, se estiver diferente deve-se corrigir para permitir a finalização. É um trava de segurança
·         ID MATERIAL: é informado manualmente. Deverá ser carregado em “LIVRE 1” na aba Inventário da web
·         LOC MATERIAL: Informação manual(endereço dentro do depósito). Deverá ser mostrado em Localização interna na web
·         Livre 1: Livre para o futuro
·         Livre 2: Livre para o futuro
 

3ª CONTAGEM:***
·         Quantidade Aferida: é a quantidade aferida e deverá ser inclusa – Deverá ser mostrada em leitura 3
·         Confirmar quantidade: é o mesmo valor acima, por isso devem estar iguais para permitir a inclusão da informação, se estiver diferente deve-se corrigir para permitir a finalização. É um trava de segurança
·         ID MATERIAL: é informado manualmente. Deverá ser carregado em “LIVRE 2” na aba Inventário da web
·         LOC MATERIAL: Informação manual(endereço dentro do depósito). Deverá ser mostrado em Localização interna na web
·         Livre 1: Livre para o futuro
·         Livre 2: Livre para o futuro
