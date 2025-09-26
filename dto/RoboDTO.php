<?php
require_once(__DIR__."/../model/Robo.php");

class RoboDTO
{
    public function linha(Robo $robo)
    {
        return 
        "<tr class=\"group text-white text-center\">".
            "<td class=\"border-4 bg-gray-700 text-white text-center group-hover:bg-gray-900\">".
                $robo->getId().
            "</td>".
            "<td class=\"border-4 bg-gray-600 text-white text-center group-hover:bg-gray-900\">".
                $robo->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-700 text-white text-center group-hover:bg-gray-900\">".
                $robo->getCategoria()->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-600 text-white text-center group-hover:bg-gray-900\">".
                $robo->getEquipe()->getNome().
            "</td>".
            "<td class=\"border-4 bg-gray-700 group-hover:bg-gray-900\">".
                "<form action=\"editar.php\" method=\"post\">
                    <input type=\"hidden\" value=\"".$robo->getId()."\" name=\"id\">
                    <button type=\"submit\" class=\"w-full h-full flex items-center justify-center\">
                        <img src=\"../../img/btn_editar.png\">
                    </button>
                </form>".
            "</td>".
            "<td class=\"border-4 bg-gray-600 group-hover:bg-gray-900\">".
                "<form action=\"../../controller/RoboController.php\" method=\"post\">
                    <input type=\"hidden\" value=\"".$robo->getId()."\" name=\"id\">
                    <input type=\"hidden\" value=\"delete\" name=\"acao\">
                    <button type=\"submit\" class=\"w-full h-full flex items-center justify-center\">
                        <img src=\"../../img/btn_excluir.png\">
                    </button>
                </form>".
            "</td>".
        "</tr>"
        ;

    }
}
?>