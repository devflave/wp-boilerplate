jQuery(function ($) {
    if ($('#custom-article-content').length > 0 && $('#article-content').length > 0) {
        $('#article-content').html($('#custom-article-content').html());
        $('#custom-article-content').remove();
        $('body').addClass('single-post elemext-detail-template');
    }

    $(document).ready(function () {
        if ($('.map-city-box #overview-map').length > 0) {
            let mymap = L.map('overview-map').setView([48.127874, 8.056585], 11);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                //attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                zIndex: 30,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiZzNvcGVuc3RyZWV0bWFwIiwiYSI6ImNrdGU1MThiNzJsdTMyd245ejIyZnV2d2gifQ.wnoLFAtNDH49-cge93djnw'
            }).addTo(mymap);

            var pin = L.icon({
                iconUrl: '/wp-content/uploads/2021/09/karte-pin-gross.svg',
                iconSize: [60, 60],
                iconAnchor: [15, 45],
                popupAnchor: [0, -50],
                shadowAnchor: [22, 94]
            });

            $('.map-city').each(function (index, elem) {
                let e = $(elem).find('.data');
                let title = e.data('title');
                let link = e.data('link');
                let image = e.data('image');
                let lat = e.data('latitude');
                let long = e.data('longitude');

                let popup = '<a href="' + link + '" class="pin-title" title="' + title + '"> <div class="pin-content"> <img src="' + image + '" alt="' + title + '" class="pin-img"> <div class="pin-text"><p class="headline">' + title + '</p> <p class="small-underline">mehr erfahren</p> </div></div> </a>';
                let marker = L.marker([lat, long], { icon: pin }).addTo(mymap).bindPopup(popup);

                if (index == 0) {
                    marker.openPopup();
                }

                $(this).mouseover(function () {
                    marker.bindPopup(popup).openPopup();
                });
            });
        }

        if ($('.location-detail-map #detail-map').length > 0) {
            let long = $('.location-detail-map #detail-map').data('long');
            let lat = $('.location-detail-map #detail-map').data('lat');

            let mymap_detail = L.map('detail-map', {
                scrollWheelZoom: false
            }).setView([lat, long], 8);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                //attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiZzNvcGVuc3RyZWV0bWFwIiwiYSI6ImNrdGU1MThiNzJsdTMyd245ejIyZnV2d2gifQ.wnoLFAtNDH49-cge93djnw'
            }).addTo(mymap_detail);

            let pin = L.icon({
                iconUrl: '/wp-content/uploads/2021/09/karte-pin-klein.svg',
                iconSize: [30, 40],
                iconAnchor: [15, 38],
                popupAnchor: [-3, -76],
                shadowAnchor: [22, 94]
            });

            let marker = L.marker([lat, long], { icon: pin }).addTo(mymap_detail);
        }
    });


    $('a.lightbox-element').fancybox();
});