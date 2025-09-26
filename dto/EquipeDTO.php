<?php
require_once(__DIR__."/../model/Equipe.php");

class EquipeDTO
{
    public function linha(Equipe $equipe)
    {
        return 
        "<tr class=\"group text-white text-center\">".
            "<td class=\"border-4 bg-gray-700 group-hover:bg-gray-900\">".
                $equipe->getId().
            "</td>".
            "<td class=\"border-4 bg-gray-600 group-hover:bg-gray-900\">".
                $equipe->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-700 group-hover:bg-gray-900\">".
                "<form action=\"editar.php\" method=\"post\">
                    <input type=\"hidden\" value=\"".$equipe->getId()."\" name=\"id\">
                    <button type=\"submit\" class=\"w-full h-full flex items-center justify-center\">
                        <img src=\"../../img/btn_editar.png\">
                    </button>
                </form>".
            "</td>".
            "<td class=\"border-4 bg-gray-600 group-hover:bg-gray-900\">".
                "<form action=\"../../controller/EquipeController.php\" method=\"post\">
                    <input type=\"hidden\" value=\"".$equipe->getId()."\" name=\"id\">
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