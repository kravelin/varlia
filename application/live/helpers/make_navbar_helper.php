<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('make_navbar_gods'))
{
    function make_navbar_gods()
    {
        $CI =& get_instance();

        $CI->load->model('gods_model');
        $CI->load->model('factions_model');

        $factions = $CI->factions_model->get_factions();
        $gods = $CI->gods_model->get_gods();

        $menu = '<li class="dropdown">';
        $menu .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gods and Other Entities<span class="caret"></span></a>';
        $menu .= '<ul class="dropdown-menu">';

        foreach ($factions as $faction)
        {
            $menu .= '<li class="dropdown-header navbar-header-' . $faction['cssID'] . '"><b><a href="/factions/' . $faction['slug'] . '">' . $faction['name'] . '</a></b></li>';
            foreach ($gods as $god)
            {
                if ($god['faction'] === $faction['name'])
                {
                    if ( strpos($god['altnames'], ',') !== false )
                    {
                        $altname = strstr($god['altnames'], ',', TRUE);
                    }
                    else
                    {
                        $altname = $god['altnames'];
                    }
                    $menu .= '<li><a href="/gods/view/' . $god['slug'] . '">' . $god['name'] . ' - ' . $altname . '</a></li>';
                }
            }
        }
        $menu .= '</ul>';
        $menu .= '</li>';

        return $menu;
    }
}

if (!function_exists('make_navbar_locations'))
{
    function make_navbar_locations()
    {
        $CI =& get_instance();

        $CI->load->model('locations_model');
        $CI->load->model('realms_model');
        $CI->load->model('regions_model');

        $regions = $CI->regions_model->get_regions();
        $realms = $CI->realms_model->get_realms();
        $locations = $CI->locations_model->get_locations();

        $menu = '<li class="dropdown">';
        $menu .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">The World <span class="caret"></span></a>';
        $menu .= '<ul class="dropdown-menu">';
        $menu .= '<li><a href="/maps/view">Maps</a></li>';

        foreach ($regions as $region)
        {
            $menu .= '<li class="dropdown-header navbar-header-' . $region['cssID'] . '"><b><a href="/regions/view/' . $region['slug'] . '">' . $region['name'] . '</a></b></li>';
            foreach ($realms as $realm)
            {
                if ($realm['region'] === $region['name'])
                {
                    if ( strpos($realm['altnames'], ',') !== false )
                    {
                        $altname = strstr($realm['altnames'], ',', TRUE);
                    }
                    else
                    {
                        $altname = $realm['altnames'];
                    }
                    $menu .= '<li><a href="/realms/view/' . $realm['slug'] . '">' . $realm['name'] . ' - ' . $altname . '</a></li>';
                    if ($locations != []) {
                        foreach ($locations as $location)
                        {
                            if ($location['realm'] === $realm['name'])
                            {
                                if (strpos($location['altnames'], ',') !== false )
                                {
                                    $altname = strstr($location['altnames'], ',', TRUE );
                                }
                                else
                                {
                                    $altname = $location['altnames'];
                                }
                                $menu .= '<li class="t2-menu"><a href="/locations/view/' . $location['slug'] . '">' . $location['name'] . ' - ' . $altname . '</a></li>';
                            }
                        }
                    }
                }
            }
        }
        $menu .= '</ul>';
        $menu .= '</li>';

        return $menu;
    }

    function make_navbar_monsters()
    {
        $CI =& get_instance();

        $CI->load->model('monsters_model');
        $CI->load->helper('rules_helper');

        $monsters = $CI->monsters_model->get_monsters();
        $types = get_monsterTypes();

        $menu = '<li class="dropdown">';
        $menu .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Monsters <span class="caret"></span></a>';
        $menu .= '<ul class="dropdown-menu">';

        foreach ($types as $type)
        {
            $menu .= '<li class="dropdown-header navbar-header-monsterType"><b><a href="/monsters/types/' . $type['name'] . '">' . ucfirst($type['name']) . '</a></b></li>';
            foreach ($monsters as $monster)
            {
                if ($monster['monsterType'] === $type['name'])
                {
                    $menu .= '<li><a href="/monsters/view/' . $monster['slug'] . '">' . $monster['name'] . '</a></li>';
                }
            }
        }
        $menu .= '</ul>';
        $menu .= '</li>';

        return $menu;
    }
}
