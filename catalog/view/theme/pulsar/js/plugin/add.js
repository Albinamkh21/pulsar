ymaps.ready(function () {
    var map = new ymaps.Map("map", {
        center: [55.777708, 37.649308],
        zoom: 15,
        controls: []
    });
    map.behaviors.disable('scrollZoom');
    // Создаём макет содержимого.
    MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
    ),


        myPlacemark = new ymaps.Placemark([55.777708, 37.649308], {
            hintContent: 'ООО Пульсар',
            balloonContent: 'ООО Пульсар'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: 'assets/img/icons/pointer.svg',
            // Размеры метки.
            iconImageSize: [30, 42],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-5, -38]
        });


    map.geoObjects.add(myPlacemark);


});
