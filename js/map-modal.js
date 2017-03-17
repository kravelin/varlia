$('#mapModal').on('show.bs.modal', function (event) {
    var link = $(event.relatedTarget)       // link that triggered the modal
    var mapname = link.data('map')          // the name of the map
    var mapfile = link.data('mapfile')      // the filename of the map
    var mapdesc = link.data('desc')         // the description of the map
    var modal = $(this)
    modal.find('.modal-title').text('Map for ' + mapname)                   // replace the modal title text with 'Map of <map name>'
    modal.find('.modal-body img').attr('src', '/images/maps/' + mapfile)    // replace the modal body's img tag src with the path/filename of the map
    modal.find('.modal-body img').attr('alt', 'map of ' + mapname)          // replace the modal body's imag tag alt with 'Map of <map name>'
    modal.find('.modal-body figcaption').text(mapdesc)                      // replace the figcaption text with the description of the map
})
