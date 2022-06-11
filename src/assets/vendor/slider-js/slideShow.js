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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
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
                desc: "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. or randomised words which don't look even slightly believable.",
                button: {
                    text: 'Acheter maintenant',
                    url: 'index.php?ctrl=Product&act=allProduct',
                    class: 'btn btn-medium btn-primary'
                }
            }
        ]

    });

});
