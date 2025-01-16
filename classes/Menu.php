<?php

namespace classes;

class Menu
{
    private $menu;

      public function getMenuFromFile($type = "header"): string
      {
          $menuDataFromFile = file_get_contents("data/menu.json");
          $this->menu = json_decode($menuDataFromFile, true);

          $serverUrl = $_SERVER['REQUEST_URI'];
          $html = "";

          if ($type === "header") {
              foreach ($this->menu as $menu) {
                  //$menu->items;
                  if (isset($menu['items'])) {
                      $html .= '<div class="'.$menu['class-div']. '">'.
                                '<a href="' . $menu['href'] . '"
                                class="' . $menu['class'] . '" 
                                data-toggle="' . $menu['data-toggle'] . '">' . $menu['content'] . '</a><div'.'"
                                class='.$menu['class-div2'].'">';

                      foreach ($menu['items'] as $item) {
                          $html .= '<a href="' . $item['href'] . '" 
                                    class="' . $item['class'] . '">' . $item['content'] . '
                                    </a>';
                      }
                      $html .= '</div></div>';

                  } else {
                            $html .= '<a href="' . $menu['href'] . '" 
                            class="' . $menu['class'] . '">' . $menu['content'] . '
                                    </a>';
                          }
              }

          }
              return $html;
          }


}