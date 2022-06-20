//animation list: flip, slice, box3D, pixel, fade, glide, card

$(document).ready(function () {

    $('#slideWiz').slideWiz({
        auto: true,
        speed: 5000,
        row: 12,
        col: 35,
        animation: [
            'flip',
            'slice',
            'box3D',
           
            'fade',
            'glide',
            'card'
        ],
        file: [
            {
                src: {
                    main: "assets/image/silder/slider-2.jpg",
                    cover: "assets/image/silder/slider-1.jpg"
                },
                title: 'Decouvrez les nouveaux produits',
                desc: "Faites des bonnes affaires à CATEMONORD ! Profitez des meilleurs prix toute l'année avec nos ventes flash, nos petits prix, nos bons plans et nos déstockages dans tous nos rayons, téléphone, ordinateur, montre, caméra.",
                descLength: 220,
                button: {
                    text: 'Acheter maintenant',
                    url: 'index.php?ctrl=Product&act=allProduct',
                    class: 'btn btn-medium btn-primary'
                }
            },
            {
                src: {
                    main: "assets/image/silder/slider-6.jpg",
                    cover: "assets/image/silder/slider-2.jpg"
                },
                title: 'Meilleur marque',
                desc: "Faites des bonnes affaires à CATEMONORD ! Profitez des meilleurs prix toute l'année avec nos ventes flash, nos petits prix, nos bons plans et nos déstockages dans tous nos rayons, téléphone, ordinateur, montre, caméra.",
                button: {
                    text: 'Acheter maintenant',
                    url: 'index.php?ctrl=Product&act=allProduct',
                    class: 'btn btn-medium btn-primary'
                }
            },
            {
                src: {
                    main: "assets/image/silder/slider-1.jpg",
                    cover: "assets/image/silder/slider-3.jpg"
                },
                title: 'Qualité - Prix',
                desc: "Faites des bonnes affaires à CATEMONORD ! Profitez des meilleurs prix toute l'année avec nos ventes flash, nos petits prix, nos bons plans et nos déstockages dans tous nos rayons, téléphone, ordinateur, montre, caméra.",
                descLength: 190,
                button: {
                    text: 'Acheter maintenant',
                    url: 'index.php?ctrl=Product&act=allProduct',
                    class: 'btn btn-medium btn-primary'
                }
            },
            {
                src: {
                    main: "assets/image/silder/slider-2.jpg",
                    cover: "assets/image/silder/slider-6.jpg"
                },
                title: 'Changez d\'idée',
                desc: "Faites des bonnes affaires à CATEMONORD ! Profitez des meilleurs prix toute l'année avec nos ventes flash, nos petits prix, nos bons plans et nos déstockages dans tous nos rayons, téléphone, ordinateur, montre, caméra.",
                button: {
                    text: 'Acheter maintenant',
                    url: 'index.php?ctrl=Product&act=allProduct',
                    class: 'btn btn-medium btn-primary'
                }
            }
        ]

    });

});
