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

    public static function buildDashboardTable($items,$class) {
             $data = "";
             foreach($items as $item) {
                 $data .= "<tr><td  id='$item->id' class='$class'>". $item->name . "</td></tr>";
             }
             $id = 'cities-'.rand(1000,9999);
             $returnValue = "<table class='datatable table stripe dataTable no-footer dtr-column' id='".$id."'>".
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

         public static function buildOperateurs($items) {
                      $data = "";
                      foreach($items as $item) {
                          $data .= "<tr><td  id='$item->id'>".$item->first_name. ' '.$item->last_name."</td></tr>";
                      }
                      $id = 'cities-'.rand(1000,9999);
                      $returnValue = "<table class='datatable table stripe dataTable no-footer dtr-column' id='".$id."'>".
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
