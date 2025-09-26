<?php
require_once(__DIR__."/../model/Estudante.php");

class EstudanteDTO
{
    public function linha(Estudante $estudante)
    {
        return 
        "<tr class=\"group text-white text-center\">".
            "<td class=\"border-4 bg-gray-700 text-white text-center group-hover:bg-gray-900\">".
                $estudante->getId().
            "</td>".
            "<td class=\"border-4 bg-gray-600 text-white text-center group-hover:bg-gray-900\">".
                $estudante->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-700 text-white text-center group-hover:bg-gray-900\">".
                date("d/m/Y", strtotime($estudante->getDataNascimento())).
            "</td>".
            "<td class=\"border-4 bg-gray-600 text-white text-center group-hover:bg-gray-900\">".
                $estudante->getTurma()->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-700 text-white text-center group-hover:bg-gray-900\">".
                $estudante->getRobo()->getNome()."(".$estudante->getRobo()->getCategoria()->getNome().")".
            "</td>".
            "<td class=\"border-4 bg-gray-600 text-white text-center group-hover:bg-gray-900\">".
                $estudante->getEquipe()->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-700 group-hover:bg-gray-900\">".
                "<form action=\"editar.php\" method=\"post\">
                    <input type=\"hidden\" value=\"".$estudante->getId()."\" name=\"id\">
                    <button type=\"submit\" class=\"w-full h-full flex items-center justify-center\">
                        <img src=\"../../img/btn_editar.png\">
                    </button>
                </form>".
            "</td>".
            "<td class=\"border-4 bg-gray-600 group-hover:bg-gray-900\">".
                "<form action=\"../../controller/EstudanteController.php\" method=\"post\">
                    <input type=\"hidden\" value=\"".$estudante->getId()."\" name=\"id\">
                    <input type=\"hidden\" value=\"delete\" name=\"acao\">
                    <button type=\"submit\" class=\"w-full h-full flex items-center justify-center\">
                        <img src=\"../../img/btn_excluir.png\">
                    </button>
                </form>".
            "</td>".
        "</tr>";
    }
}
?>