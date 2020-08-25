<?php
namespace App\Helpers;
use Illuminate\Support\Str;
class Helper
{
     /**
     * Avoir le nom du role de l'user
     *
     * $return string */
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
             $returnValue = "<table style='width=100%' class='datatable table stripe dataTable no-footer dtr-column' id='".$id."'>".
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

    public static function buildUsersList($items) {
     $data = "";
        foreach($items as $item) {

              $data .= "<ul class='users'>".
                                    "<li class='user' id=$item->id>".
                                   "<div class='media'>".
                                   "<div class='media-left'>".
                                   "<img src=$item->avatar alt='' class='media-object'>".
                                   "</div>".
                                   "<div class='media-body'>".
                                   "<p class='name'>".substr($item->first_name, 0, 50)." ".substr($item->last_name, 0, 50)."</p>".
                                   "<p class='email'>".substr($item->email, 0, 24)."</p>".
                                   "</div>".
                                   "</div>".
                                   "</li>".
                                    "</ul>";

            }
            $returnValue =$data;
            return ["name"=>$returnValue];
    }

    public static function buildOperateurs($items) {
        $data = "";
        foreach($items as $item) {
            $data .= "<tr><td  id='$item->id'>".$item->first_name. ' '.$item->last_name."</td></tr>";
        }
        $id = 'cities-'.rand(1000,9999);
        $returnValue = "<table style='width=100%' class='datatable table stripe dataTable no-footer dtr-column' id='".$id."'>".
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

    public static function buildUsersTable($items) {
          $data = "";
          foreach($items as $item) {
          $data .= "<tr><td id='$item->id'><input type='checkbox' name='lecteurs[]' value='$item->id' $item->status> ".
          "$item->first_name $item->last_name".
          "</td></tr>";
          }
          $id = 'cities-'.rand(1000,9999);
          $returnValue = "<table style='width=100%' class='table' id='".$id."'>".
          "<thead>"."<tr>".
          "<th></th>".
          "</tr>".
          "</thead>".
          "<tbody>".
          $data.
          "</tbody>".
          "</table>";
    return ["name"=>$returnValue, "id" => $id ];
    }


    public static function buildUsersNotification($items,$count) {
     $data = "";
     foreach($items as $item)
     {
      $data .="<div><h4><small><i class='fa fa-clock-o'>$item->created_at</i></small></h4>".
         "<div class='row'><div class='col-sm-10'> $item->data['message'] </div> <div class='col-sm-2'><input type='submit' class='btn btn-success btn-xs btn-block'> </div></div></div>";
      }

      $returnValue = "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".
                     "<i class='fa fa-bell'></i>".
                     "<span class='label label-warning'>$count</span>".
                     "</a>".
                     "<ul class='dropdown-menu'>".
                     "<li class='header'>You have $count messages</li>".
                     "<li>".
                     "<ul class='menu'>".
                     "<li>".
                     "<a href='#'>".
                     "<div class='pull-left'>".
                     $data.
                     "</div>".
                     "</a>".
                     "</li>".
                     "</ul>".
                     "</li>".
                     "<li class='footer'><a href='#'>View all</a></li>".
                     "</ul>";

      return ["name"=>$returnValue ];
      }

}
