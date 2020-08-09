<?php
namespace App\Helpers;

class Helper
{
/**
     * Avoir le nom du role de l'user
     *
     * $return string
     */
    public static function getRolename($roleid)
    {
        return config('variables.role')[$roleid];
    }

    public static function buildCities($cities) {
        $data = "";

        foreach($cities as $item) {
            $data .= "<tr><td>". $item->name . "</td></tr>";
        }

        $id = 'cities-'.rand(1000,9999);

        $returnValue = "<table class='table' id='".$id."'>".
                            "<thead>".
                                "<tr>".
                                    "<th></th>".
                                "</tr>".
                                "</thead>".
                                "<tbody id='showall'>".
                                    $data.
                                "</tbody>".
                        "</table>";

        return ["name"=>$returnValue, "id" => $id ];

    }


}
