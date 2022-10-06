let scrollobj = {}
window.onscroll = scrollPosition

function scrollPosition()
{
    scrollobj = {
        x: window.pageXOffset,
        y: window.pageYOffset
    }
    let product_image = document.querySelector('.product_image');
    if(scrollobj.y > 260){
        product_image.style.marginTop = 0;
        product_image.classList.add('active_single_product_image')
    }else{
        product_image.classList.remove('active_single_product_image')
    }

    if(scrollobj.y > (document.querySelector('#get_height').offsetHeight - 200)){
        product_image.classList.remove('active_single_product_image')
        product_image.style.marginTop = ((document.querySelector('#get_height').offsetHeight - (document.querySelector('#mainCarousel').offsetHeight + document.querySelector('#navCarousel').offsetHeight))) + 'px'
    }


}


// Fancybox
Fancybox.bind('[data-fancybox="gallery"]', {
    caption: function (fancybox, carousel, slide) {
        return (
        `${slide.index + 1} / ${carousel.slides.length} <br />` + slide.caption
        );
    },
});

const mainCarousel = new Carousel(document.querySelector("#mainCarousel"), {
    Dots: false,
});

const navCarousel = new Carousel(document.querySelector("#navCarousel"), {
    Sync: {
        target: mainCarousel,
    },
    Dots: false,
    Navigation: false,
    infinite: false,
    center: true,
    slidesPerPage: 1,
});
