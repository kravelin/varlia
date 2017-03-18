<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_maps_list'))
{
    function get_maps_list($area = NULL, $id = NULL)
    {
        $CI =& get_instance();
        $CI->load->model('maps_model');

        $imageDir = '/www/images/maps';

        $maps = $CI->maps_model->get_maps($area, $id);

        $list = [];

        foreach ($maps as $map)
        {
            if (file_exists($imageDir . '/' . $map['filename']))
            {
                $list[] = $map;
            }
        }

        return $list;
    }
}

if (!function_exists('get_formatted_maps_list'))
{
    function get_formatted_maps_list($area = NULL, $id = NULL)
    {
        $mapList = get_maps_list($area, $id);

        if (empty($mapList))
        {
            return NULL;
        }

        $output = '';

        switch ($area)
        {
            case 'realm':
            case 'region':
            case 'location':
                $output .= '<h3>Maps for this ' . $area . '</h3>';
        }

        $output .= '<ul class="buttonless-list">';

        # create the list of maps showing name - width x height - description in a buttonless list
        foreach ($mapList as $map)
        {
            $output .= '<li><a href="#" data-toggle="modal" data-target="#mapModal" data-map="' . $map['name'] . '" data-mapfile="' . $map['filename'] . '" data-desc="' . $map['description'] . '">' . $map['name'] . '</a> - ' . $map['width'] . 'x' . $map['height'] . ' - ' . $map['description'] . '</li>';
        }

        $output .= '</ul>';

        # generate the modal header
        $output .= '<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true"><div class="modal-dialog map-modal" role="document">';
        $output .= '<div class="modal-content"><div class="modal-header"><h4 class="modal-title map-modal" id="mapModalLabel">Map</h4></div>';

        # generate the body of the modal that will draw on data-map and data-file to get the image and caption and description
        $output .= '<div class="modal-body"><figure><img src="/images/maps/map.png" alt="map-name"><figcaption class="map-modal">Description of map</figcaption></figure></div>';

        # generate the footer of the modal
        $output .= '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div></div></div></div>';

        return $output;
    }
}
