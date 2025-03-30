import "./bootstrap";
import imagesLoaded from 'imagesloaded';
import Masonry from 'masonry-layout';
import PhotoSwipeLightbox from "photoswipe/lightbox";
import "photoswipe/dist/photoswipe.css";

// Masonry
const grid = document.querySelector('.masonry-grid');
if (grid) {
    let msnry;

    imagesLoaded(grid, () => {
        msnry = new Masonry(grid, {
            columnWidth: '.grid-sizer',
            itemSelector: '.grid-item',
            percentPosition: true,
        });
    });
}

// Lightbox
const lightbox = new PhotoSwipeLightbox({
    gallery: "#gallery",
    children: "a",
    pswpModule: () => import("photoswipe"),
});

lightbox.init();
